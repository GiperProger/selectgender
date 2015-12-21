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
 * @package ow_plugins.selectgender.controllers
 * @since 1.0
 */
class SELECTGENDER_CTRL_Admin extends ADMIN_CTRL_Abstract
{

    public function index()
    {
        $language = OW::getLanguage();

        $form = new SELECTGENDER_CLASS_SettingsForm();
        $this->addForm($form);
             
        //$form->getElement('sandboxMode')->setValue(OW::getConfig()->getValue('smsverification', 'sandboxMode'));
        $form->getElement('disMaleToMaleProfile')->setValue(OW::getConfig()->getValue('selectgender', 'disMaleToMaleProfile'));
        $form->getElement('disMaleToFemaleProfile')->setValue(OW::getConfig()->getValue('selectgender', 'disMaleToFemaleProfile'));
        $form->getElement('disFemaleToFemaleProfile')->setValue(OW::getConfig()->getValue('selectgender', 'disFemaleToFemaleProfile'));
       
        $form->getElement('sameSexPhotoView')->setValue(OW::getConfig()->getValue('selectgender', 'sameSexPhotoView'));
        $form->getElement('oppositeSexPhotoView')->setValue(OW::getConfig()->getValue('selectgender', 'oppositeSexPhotoView'));
        
        $form->getElement('opositeMatchSexJoin')->setValue(OW::getConfig()->getValue('selectgender', 'opositeMatchSexJoin'));
        $form->getElement('sameMatchSexJoin')->setValue(OW::getConfig()->getValue('selectgender', 'sameMatchSexJoin'));
        
        $form->getElement('opositeMatchSexSearch')->setValue(OW::getConfig()->getValue('selectgender', 'opositeMatchSexSearch'));
        $form->getElement('sameMatchSexSearch')->setValue(OW::getConfig()->getValue('selectgender', 'sameMatchSexSearch'));
        
        $form->getElement('guestRedirectToJoin')->setValue(OW::getConfig()->getValue('selectgender', 'guestRedirectToJoin'));
        

        if ( OW::getRequest()->isPost() && $form->isValid($_POST) )
        {
            $values = $form->getValues();

            OW::getConfig()->saveConfig ('selectgender', 'disMaleToMaleProfile', $values['disMaleToMaleProfile']);
            OW::getConfig()->saveConfig ('selectgender', 'disMaleToFemaleProfile', $values['disMaleToFemaleProfile']);
            OW::getConfig()->saveConfig ('selectgender', 'disFemaleToFemaleProfile', $values['disFemaleToFemaleProfile']);
            
            OW::getConfig()->saveConfig ('selectgender', 'sameSexPhotoView', $values['sameSexPhotoView']);
            OW::getConfig()->saveConfig ('selectgender', 'oppositeSexPhotoView', $values['oppositeSexPhotoView']);
            
            OW::getConfig()->saveConfig('selectgender', 'opositeMatchSexJoin', $values['opositeMatchSexJoin']);
            OW::getConfig()->saveConfig('selectgender', 'sameMatchSexJoin', $values['sameMatchSexJoin']);
            
            OW::getConfig()->saveConfig('selectgender', 'opositeMatchSexSearch', $values['opositeMatchSexSearch']);
            OW::getConfig()->saveConfig('selectgender', 'sameMatchSexSearch', $values['sameMatchSexSearch']);
            
            OW::getConfig()->saveConfig('selectgender', 'guestRedirectToJoin', $values['guestRedirectToJoin']);

            OW::getFeedback()->info($language->text('selectgender', 'settings_updated'));
            $this->redirect();
        }
        
        $this->setPageHeading(OW::getLanguage()->text('selectgender', 'config_page_heading'));
       
    }
    
}



