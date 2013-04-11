<?php

$strPalette = &$GLOBALS['TL_DCA']['tl_module']['palettes']['registration'];
$strPalette = str_replace(',editable', ',editable,bbit_reg_groups', $strPalette);
unset($strPalette);

$GLOBALS['TL_DCA']['tl_module']['fields']['bbit_reg_groups'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['tl_module']['bbit_reg_groups'],
	'exclude'	=> true,
	'inputType'	=> 'checkbox',
	'foreignKey'=> 'tl_member_group.name',
	'eval'		=> array(
		'multiple'	=> true,
		'tl_class'	=> 'clr',
	),
);
