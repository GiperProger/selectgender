<?php

/**
 * Copyright (c) 2015, Pryadkin Sergey <GiperProger@gmail.com>
 * All rights reserved.

 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
 * and is licensed under Oxwall Store Commercial License.
 * Full text of this license can be found at http://www.oxwall.org/store/oscl
 */

$config = OW::getConfig();

$config->deleteConfig();

$config->deleteConfig('selectgender', 'disMaleToMaleProfile');
$config->deleteConfig('selectgender', 'disMaleToFemaleProfile');
$config->deleteConfig('selectgender', 'disFemaleToFemaleProfile');


$config->deleteConfig('selectgender', 'sameSexPhotoView');
$config->deleteConfig('selectgender', 'oppositeSexPhotoView');


$config->deleteConfig('selectgender', 'opositeMatchSexJoin');
$config->deleteConfig('selectgender', 'sameMatchSexJoin');

$config->deleteConfig('selectgender', 'opositeMatchSexSearch');
$config->deleteConfig('selectgender', 'sameMatchSexSearch');

$config->deleteConfig('selectgender', 'guestRedirectToJoin');

