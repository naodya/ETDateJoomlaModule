<?php
/*------------------------------------------------------------------------
# mod_toetdate - Ethiopian Date Module
# ------------------------------------------------------------------------
# Author: Naod Yeheyes
# Copyright: Copyright (C) 2012 naodya.com. All Rights Reserved.
# License: - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.naodya.com
# Technical Support:  email:naodya@gmail.com
-------------------------------------------------------------------------*/
 
// no direct access
defined('_JEXEC') or die;
 

require_once(dirname(__FILE__).'/helper.php');

$dateformat=$params->get('selectdateformat');	

$etdate=modToEtDateHelper::getEtDate($dateformat);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require(JModuleHelper::getLayoutPath('mod_toetdate'));
