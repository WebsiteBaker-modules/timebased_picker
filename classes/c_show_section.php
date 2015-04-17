<?php

/**
 *	class to display a given section.
 *
 *
 */
class c_show_section
{

	private $db = NULL;
	
	public function __construct(&$db_handel) {
	
		$this->db = $db_handel;
		
	}
	
	public function print_section( &$aSection_id=0 ) {
		global $section_id;
		global $database;
		global $wb;
		global $TEXT;
		global $HEADING;
		
		$query_sec = $this->db->query("SELECT `section_id`,`module` FROM `".TABLE_PREFIX."sections` WHERE `section_id` = '".$aSection_id."'");

		if($query_sec->numRows() > 0) {
			$section = $query_sec->fetchRow( MYSQL_ASSOC );
			$old_section_id = $section_id;
			$section_id = $section['section_id']; 
			$module = $section['module'];
			
			/**
			 *	Looking for frontend.css
			 *
			 */
			$temp_path = WB_PATH.'/modules/'.$module.'/frontend.css';
			if (file_exists($temp_path)) {
				echo "\n\n<link rel=\"stylesheet\" type=\"text/css\" href='".WB_URL."/modules/".$module."/frontend.css' />\n";
			}
			
			/**
			 *	Looking for frontend.js
			 *
			 */
			$temp_path = WB_PATH.'/modules/'.$module.'/frontend.js';
			if (file_exists($temp_path)) {
				echo "\n<script src=\"".WB_URL."/modules/".$module."/frontend.js\" type=\"text/javascript\"></script>\n";
			}
	
			require(WB_PATH.'/modules/'.$module.'/view.php');

			$section_id = $old_section_id;
		}
	}

}
?>