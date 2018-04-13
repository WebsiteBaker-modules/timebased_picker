<?php

/**
 *	
 *	@category		modules
 *	@package		timebased_picker ( formerly: jmstv_picker )
 *	@author			Ruud Eisinga, Evaki, Dietrich Roland Pehlke (last)';
 *	@license		http://www.gnu.org/licenses/gpl.html
 *	@requirements	PHP 5.2.2 and higher
 *
 */

/**
 *	prevent this file from being accessed directly
 */
if(!defined('WB_PATH')) die(header('Location: ../../index.php'));

$table = TABLE_PREFIX ."mod_timebased_picker";
$database->query("INSERT INTO `".$table."` (`page_id`, `section_id`, `target_section_id`) VALUES ('".$page_id."','".$section_id."', '0')");

?>
