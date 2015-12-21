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

class SELECTGENDER_CTRL_Controller extends OW_ActionController
{
    public function newRedirect()
    {         
        $language = OW::getLanguage();
        
        $this->assign('upgradeToView', $language->text( "selectgender", "access_denided_text" ));
    }
    
    public function toSignin()
    {
        throw new AuthenticateException();
    }
    
    
    
    
}

