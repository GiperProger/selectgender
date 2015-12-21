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

class SELECTGENDER_CLASS_SettingsForm extends Form
{
    public function __construct()
    {
        parent::__construct('settings-form');

        $lang = OW::getLanguage();

        $disMaleToMaleProfile = new CheckboxField('disMaleToMaleProfile');
        $disMaleToMaleProfile->setLabel($lang->text('selectgender', 'dis_male_to_male_profile'));
        $this->addElement($disMaleToMaleProfile);
        
        $disMaleToFemaleProfile = new CheckboxField('disMaleToFemaleProfile');
        $disMaleToFemaleProfile->setLabel($lang->text('selectgender', 'dis_male_to_female_profile'));
        $this->addElement($disMaleToFemaleProfile);
        
        $disMaleToMaleProfile = new CheckboxField('disFemaleToFemaleProfile');
        $disMaleToMaleProfile->setLabel($lang->text('selectgender', 'dis_female_to_female_profile'));
        $this->addElement($disMaleToMaleProfile);
        
        $onlyDifferentSexCanSeePhoto = new CheckboxField('oppositeSexPhotoView');
        $onlyDifferentSexCanSeePhoto->setLabel($lang->text('selectgender', 'opposite_sex_photo_view'));
        $this->addElement($onlyDifferentSexCanSeePhoto);
        
        $onlySameSexCanSeePhoto = new CheckboxField('sameSexPhotoView');
        $onlySameSexCanSeePhoto->setLabel($lang->text('selectgender', 'same_sex_photo_view'));
        $this->addElement($onlySameSexCanSeePhoto);
        
        $opositeMatchSexJoin = new CheckboxField('opositeMatchSexJoin');
        $opositeMatchSexJoin->setLabel($lang->text('selectgender', 'oposite_match_sex_join'));
        $this->addElement($opositeMatchSexJoin);
        
        $sameMatchSexJoin = new CheckboxField('sameMatchSexJoin');
        $sameMatchSexJoin->setLabel($lang->text('selectgender', 'same_match_sex_join'));
        $this->addElement($sameMatchSexJoin);
        
        $opositeMatchSexSearch = new CheckboxField('opositeMatchSexSearch');
        $opositeMatchSexSearch->setLabel($lang->text('selectgender', 'oposite_match_sex_search'));
        $this->addElement($opositeMatchSexSearch);
        
        $sameMatchSexSearch = new CheckboxField('sameMatchSexSearch');
        $sameMatchSexSearch->setLabel($lang->text('selectgender', 'same_match_sex_search'));
        $this->addElement($sameMatchSexSearch);
        
        $guestRedirectToJoin = new CheckboxField('guestRedirectToJoin');
        $guestRedirectToJoin->setLabel($lang->text('selectgender', 'guest_redirect_to_join'));
        $this->addElement($guestRedirectToJoin);
        

        
        // submit
        $submit = new Submit('save');
        $submit->setValue($lang->text('selectgender', 'btn_save'));
        $this->addElement($submit);
        
    }
    
}