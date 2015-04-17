<?php
/**
*	Recursive function to build a list of pages and subpages
*
*	@version:	0.1.3
*	@date:		2012-01-10
*	@author:	RuudE, Dietrich Roland Pehlke (last)
*	@package:	Websitebaker - Modules: jmstv_picker
*	@state:		@dev
*
*
*/

/**
 *	prevent this file from being accessed directly
 */
if(!defined('WB_PATH')) die(header('Location: ../../index.php'));

if (!function_exists("build_pagelist2")) {
	function build_pagelist2($parent,$this_page, &$links) {
		global $database;
		
		$table_p = TABLE_PREFIX."pages";
		$table_s = TABLE_PREFIX."sections";
		
		if ( $query_section_id = $database->query("SELECT s.section_id,s.module,p.link,p.page_title,p.page_id,p.level FROM ".$table_s." s join ".$table_p." p on (s.page_id = p.page_id) WHERE p.parent = ".$parent." order by p.position")) {
			while($res = $query_section_id->fetchRow( MYSQL_ASSOC )) {
				if ($res['page_id'] != $this_page) {
					$links[$res['section_id']] = $res['section_id'].'|'.str_repeat("  -  ",$res['level']).$res['page_title'].'	-	section: '.$res['module'];
				} else {
					$links[$res['section_id']] = '|'.str_repeat("  -  ",$res['level']).$res['page_title'].'	-	section:'.$res['module'];
				}
				build_pagelist2($res['page_id'],$this_page, $links);
			}
		}
	}
}
?>