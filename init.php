<?php

/**
 * Copyright (c) 2015, Pryadkin Sergey <GiperProger@gmail.com>
 * All rights reserved.

 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
 * and is licensed under Oxwall Store Commercial License.
 * Full text of this license can be found at http://www.oxwall.org/store/oscl
 */


$userSearchCtrl = OW::getPluginManager()->getPlugin('selectgender')->getCtrlDir() . "search.php";
require_once $userSearchCtrl;

SELECTGENDER_CLASS_EventHandler::getInstance()->init();
$router = OW::getRouter();
$router->addRoute(new OW_Route('selectgender_admin', 'admin/selectgender', 'SELECTGENDER_CTRL_Admin', 'index'));
$router->addRoute(new OW_Route('selectgender_not_for_your_sex','selectgender/not_for_your_sex','SELECTGENDER_CTRL_Controller', 'newRedirect'));

