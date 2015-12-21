<?php

/**
 * Copyright (c) 2015, Pryadkin Sergey <GiperProger@gmail.com>
 * All rights reserved.

 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
 * and is licensed under Oxwall Store Commercial License.
 * Full text of this license can be found at http://www.oxwall.org/store/oscl
 */


$path = OW::getPluginManager()->getPlugin('selectgender')->getRootDir() . 'langs.zip';
OW::getLanguage()->importPluginLangs($path, 'selectgender');

OW::getPluginManager()->addPluginSettingsRouteName('selectgender', 'selectgender_admin');
$config = OW::getConfig();

$config->addConfig('selectgender', 'disMaleToMaleProfile', '');
$config->addConfig('selectgender', 'disMaleToFemaleProfile', '');
$config->addConfig('selectgender', 'disFemaleToFemaleProfile', '');


$config->addConfig('selectgender', 'sameSexPhotoView', '');
$config->addConfig('selectgender', 'oppositeSexPhotoView', '');


$config->addConfig('selectgender', 'opositeMatchSexJoin', '');
$config->addConfig('selectgender', 'sameMatchSexJoin', '');

$config->addConfig('selectgender', 'opositeMatchSexSearch', '');
$config->addConfig('selectgender', 'sameMatchSexSearch', '');

$config->addConfig('selectgender', 'guestRedirectToJoin', '');




