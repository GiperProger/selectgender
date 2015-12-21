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
 * @package ow_plugins.selectgender.components
 * @since 1.0
 */
class SELECTGENDER_CMP_QuickSearch extends OW_Component
{
    public function __construct()
    {
        parent::__construct();

        $form = OW::getClassInstance('SELECTGENDER_CLASS_QuickSearchForm', $this);
        $this->addForm($form);


        $config = OW::getConfig();

        $opositeMatchSexSearch = $config->getValue('selectgender', 'opositeMatchSexSearch');
        $sameMatchSexSearch = $config->getValue('selectgender', 'sameMatchSexSearch');
        $isUserRegister = OW::getUser()->isAuthenticated();

        if(OW::getUser()->isAuthenticated())
        {
            $userId = OW::getUser()->getId();
            $userSex = BOL_QuestionService::getInstance()->getQuestionData(array($userId), array('sex'));

            $jsParams = array(
                'isUserRegister' => $isUserRegister,
                'opositeMatchSexSearch' => $opositeMatchSexSearch,
                'sameMatchSexSearch' => $sameMatchSexSearch,
                'userSex' => $userSex[$userId]['sex']
            );

            $script = ' var quickSearch = new SELECTGENDER_QuickSearch(); quickSearch.init(' . json_encode($jsParams) . '); ';
            OW::getDocument()->addOnloadScript($script);
            OW::getDocument()->addScript(OW::getPluginManager()->getPlugin('selectgender')->getStaticJsUrl() . 'quickSearch.js');
        }


        $this->assign('form', $form);
        $this->assign('advancedUrl', OW::getRouter()->urlForRoute('users-search'));
        $this->assign('questions', USEARCH_BOL_Service::getInstance()->getQuickSerchQuestionNames());

        if(OW::getUser()->isAuthenticated())
        {
            $this->assign('userId', OW::getUser()->getId());
        }
    }
}
