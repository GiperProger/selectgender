<?php
/**
* Copyright (c) 2015, Pryadkin Sergey <GiperProger@gmail.com>
* All rights reserved.

* ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
* and is licensed under Oxwall Store Commercial License.
* Full text of this license can be found at http://www.oxwall.org/store/oscl
*/

/**
* @author Pryadkin Sergey <GiperProger@gmail.com>
* @package ow_plugins.selectgender.classes
* @since 1.0
*/



class SELECTGENDER_CLASS_EventHandler
{
    /**
     * Singleton instance.
     *
     * @var SELECTGENDER_CLASS_EventHandler
     */
    private static $classInstance;
    
    private $disMaleToMaleProfile;
    private $disMaleToFemaleProfile;
    private $disFemaleToFemaleProfile;

    private $onlySameSexCanSeePhoto;        
    private $onlyDifferentSexCanSeePhoto;

    private $redirectGuestToJoin;

    /**
     * Returns an instance of class (singleton pattern implementation).
     *
     * @return SELECTGENDER_CLASS_EventHandler
     */
    public static function getInstance()
    {
        if ( self::$classInstance === null )
        {
            self::$classInstance = new self();
        }

        return self::$classInstance;
    }

    private function __construct()
    {
        $config = OW::getConfig();
       
        $this->disMaleToMaleProfile = $config->getValue('selectgender', 'disMaleToMaleProfile');
        $this->disMaleToFemaleProfile = $config->getValue('selectgender', 'disMaleToFemaleProfile');
        $this->disFemaleToFemaleProfile = $config->getValue('selectgender', 'disFemaleToFemaleProfile');

        $this->onlySameSexCanSeePhoto = $config->getValue('selectgender', 'onlySameSexCanSeePhoto');
        $this->onlyDifferentSexCanSeePhoto = $config->getValue('selectgender', 'onlyDifferentSexCanSeePhoto');

        
        $this->redirectGuestToJoin = $config->getValue('selectgender', 'guestRedirectToJoin');
        
    }
    
    public function init()
    {
        OW::getEventManager()->bind('base.questions_field_add_fake_questions', array($this, 'addFakeQuestions'));
        OW::getEventManager()->bind(OW_EventManager::ON_AFTER_ROUTE, array($this, "onAfterRout"));
        OW::getEventManager()->bind("class.get_instance.JoinForm", array($this, "onAfterGetSKADATE_CLASS_JoinFormInstance"), 999);
        OW::getEventManager()->bind("class.get_instance.USEARCH_CLASS_MainSearchForm", array($this, "onAfterGetUSEARCH_CTRL_SearchInstance"));
        OW::getEventManager()->bind("class.get_instance.USEARCH_CMP_QuickSearch", array($this, "onAfterGetUSEARCH_CMP_QuickSearchInstance"));
        OW::getEventManager()->bind('base.query.content_filter', array($this, 'photoGetPhotoList'));
        
    }
    
    public function onAfterGetUSEARCH_CTRL_SearchInstance(OW_Event $event)
    {
        $params = $event->getParams();
        
        if ( !empty($params['className']))
        {
            $event->setData(new SELECTGENDER_CLASS_MainSearchForm($params['arguments'][0]));
        }
    }
    
    public function onAfterGetUSEARCH_CMP_QuickSearchInstance(OW_Event $event)
    {
        $params = $event->getParams();
        
        if ( !empty($params['className']))
        {
           $event->setData(new SELECTGENDER_CMP_QuickSearch());
        }
    }
    
    public function addFakeQuestions( OW_Event $event )
    { 
        $params = $event->getParams();        

        if ( !empty($params['name']) && ($params['name'] == 'sex' || $params['name'] == 'match_sex') )
        {

            $event->setData(false);
        }
        
    }
    
    public function onAfterRout(OW_Event $event)
    {
        $handlerAtr = OW::getRequestHandler()->getHandlerAttributes();
        

        if($handlerAtr['controller'] == 'BASE_CTRL_ComponentPanel' && $handlerAtr['action'] == 'profile')
        {
           if( !OW::getUser()->isAuthenticated() && $this->redirectGuestToJoin )
           {
              OW::getApplication()->redirect((OW::getRouter()->urlForRoute('base_join', array('type' => $_POST['type']))));
           }

        }
        
        if($handlerAtr['controller'] == 'BASE_CTRL_ComponentPanel' && $handlerAtr['action'] == 'profile')
        {

            if(OW::getPluginManager()->getPlugin('skadate'))
            {
                $this->checkProfileSkadate($handlerAtr);
            }

            else
            {
                $this->checkProfileOxwall($handlerAtr);
            }

        }
            
    }
    
    private function checkProfileSkadate($handlerAtr)
    {

        $profileUserName = empty($handlerAtr['params']['username']) ? false : $handlerAtr['params']['username'];
        $profileUserId = BOL_UserService::getInstance()->findByUsername($profileUserName)->id;
        $currentId = OW::getUser()->getId();

        if($profileUserId == $currentId)
        {
            return;
        }

        $userSex = BOL_QuestionService::getInstance()->getQuestionData(array($profileUserId, $currentId), array('sex'));
           
        if( $this->disMaleToMaleProfile && $userSex[$profileUserId]['sex'] == 1 && $userSex[$currentId]['sex'] == 1 )
        {
            OW::getApplication()->redirect((OW::getRouter()->urlForRoute('selectgender_not_for_your_sex', array('type' => $_POST['type']))));
        }

        if( $this->disFemaleToFemaleProfile && $userSex[$profileUserId]['sex'] == 2 && $userSex[$currentId]['sex'] == 2 )
        {
            OW::getApplication()->redirect((OW::getRouter()->urlForRoute('selectgender_not_for_your_sex', array('type' => $_POST['type']))));
        }

        if( $this->disMaleToFemaleProfile && ($userSex[$profileUserId]['sex'] != $userSex[$currentId]['sex']) )
        {
             OW::getApplication()->redirect((OW::getRouter()->urlForRoute('selectgender_not_for_your_sex', array('type' => $_POST['type']))));
        }         
        
    }

    private function checkProfileOxwall($handlerAtr)
    {
        printVar($handlerAtr);
        exit;
    }
    
    public function onAfterGetSKADATE_CLASS_JoinFormInstance(OW_Event $event)
    {
        $params = $event->getParams();
        
        if ( !empty($params['className']))
        {
            $event->setData(new SELECTGENDER_CLASS_JoinForm($params['arguments'][0]));
        
            return $event->getData();
        }        
        
    }
    
    public function photoGetPhotoList( BASE_CLASS_QueryBuilderEvent $event )
    {
        
        if(!OW::getUser()->isAuthenticated())
        {
            return;
        }


        if(OW::getPluginManager()->getPlugin('skadate'))
        {
            $this->photoFiltrSkadate($event);
        }

        else
        {
            $this->photoFiltrOxwall($event);
        }

        
    }

    private function photoFiltrSkadate($event)
    {

        $params = $event->getParams();
        $aliases = $params['tables'];
        $currentId = OW::getUser()->getId();

        $sex = BOL_QuestionService::getInstance()->getQuestionData(array($currentId), array('sex'));

        if( $this->onlyDifferentSexCanSeePhoto )
        {
            $join = ' INNER JOIN `' . BOL_QuestionDataDao::getInstance()->getTableName() . '` AS `bqdt` ON(`' . $aliases['content'] . '`.`userId` = `bqdt`.`userId`
                AND `bqdt`.`questionName` = \'sex\'
                AND (`bqdt`.`intValue` != '.$sex[$currentId]['sex'].' OR `' . $aliases['content'] . '`.`userId` = '.$currentId.' )) ';
            $params = array(
                'sex' => $sex[$currentId]['sex'],
                'currentId' => $currentId
            );

            $event->addJoin($join);
        }

        if( $this->onlySameSexCanSeePhoto )
        {
            $join = ' INNER JOIN `' . BOL_QuestionDataDao::getInstance()->getTableName() . '` AS `bqdt` ON(`' . $aliases['content'] . '`.`userId` = `bqdt`.`userId`
                AND `bqdt`.`questionName` = \'sex\'
                AND (`bqdt`.`intValue` = '.$sex[$currentId]['sex'].' OR `' . $aliases['content'] . '`.`userId` = '.$currentId.' )) ';
            $params = array(
                'sex' => $sex[$currentId]['sex'],
                'currentId' => $currentId
            );

            $event->addJoin($join);
        }
    }
    
}