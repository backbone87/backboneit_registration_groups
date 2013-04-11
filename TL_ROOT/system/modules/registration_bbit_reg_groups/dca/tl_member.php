<?php

if(TL_MODE != 'FE') {
	return;
}

$arrGroupsField = &$GLOBALS['TL_DCA']['tl_member']['fields']['groups'];
$arrGroupsField['options_callback'] = array('RegistrationGroups', 'getGroupOptions');
$arrGroupsField['save_callback'] = (array) $arrGroupsField['save_callback'];
array_unshift($arrGroupsField['save_callback'], array('RegistrationGroups', 'saveGroups'));
