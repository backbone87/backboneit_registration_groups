<?php

class RegistrationGroups extends Controller {
	
	public function getGroupOptions($objSource) {
		$arrGroupsField = &$GLOBALS['TL_DCA']['tl_member']['fields']['groups'];
		unset($arrGroupsField['allowedGroups']);
		
		$arrOptions = $this->getOptionsByForeignKey($arrGroupsField['foreignKey']);
		if(!($objSource instanceof ModuleRegistration)) {
			return $arrOptions;
		}
		
		$arrAllowed = deserialize($objSource->bbit_reg_groups, true);
		if(!$arrAllowed) {
			return $arrOptions;
		}
		
		$arrGroupsField['allowedGroups'] = $arrAllowed;
		return array_intersect_key($arrOptions, array_flip($arrAllowed));
	}
	
	public function saveGroups($varValue) {
		$arrAllowed = $GLOBALS['TL_DCA']['tl_member']['fields']['groups']['allowedGroups'];
		return $arrAllowed ? array_intersect(deserialize($varValue, true), $arrAllowed) : $varValue;
	}
	
	public function getOptionsByForeignKey($strForeignKey) {
		list($strTable, $strColumn) = explode('.', $strForeignKey, 2);
		$strQuery = <<<EOT
SELECT		id, $strColumn AS value
FROM		$strTable
WHERE		tstamp > 0
ORDER BY 	value
EOT;
		$objOptions = Database::getInstance()->query($strQuery);
		while($objOptions->next()) {
			$arrOptions[$objOptions->id] = $objOptions->value;
		}
		return (array) $arrOptions;
	}
	
	protected function __construct() {
		parent::__construct();
	}
	
	protected function __clone() {
	}
	
	private static $objInstance;
	
	public static function getInstance() {
		isset(self::$objInstance) || self::$objInstance = new self();
		return self::$objInstance;
	}
	
}
