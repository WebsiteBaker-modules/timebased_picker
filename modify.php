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

/**
 *	Load Language file
 */
$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );

require_once ('select_pages.php');

$table = TABLE_PREFIX.'mod_timebased_picker';
$sql_result = $database->query("SELECT * FROM `".$table."` WHERE `section_id` = '".$section_id."'");
$sql_row = $sql_result->fetchRow( MYSQL_ASSOC );

$target_section_id = $sql_row['target_section_id'];
$sel = ' selected="selected"';

$head_section_id = $sql_row['head_section_id'];
$inactive_section_id =  $sql_row['inactive_section_id'];
$weekdays = explode(",", $sql_row['weekdays']);

$links = array();
build_pagelist2(
	0,			// start
	$page_id,	// currend page id
	$links		// storrage - pass by reference
);

/**
 *	Build selects for the start- and end-time and the timezone.
 *
 */
$t = range(1,24);
$time_start_select = "\n\n<select name = 'time_start' id='time_start'>\n";
$time_end_select = "\n\n<select name = 'time_end' id='time_end'>\n";
foreach($t as $item) {
	
	$s = ($item == $sql_row['time_start']) ? " selected='selected'" : "";
	$time_start_select .= "<option value='".($item < 10 ? "0" : "").$item."' ".$s.">".$item.":00 ".$MOD_TIMEBASED_PICKER['TIME_HOUR_NAME']."</option>\n";
	
	$s = ($item == $sql_row['time_end']) ? " selected='selected'" : "";
	$time_end_select .= "<option value='".($item < 10 ? "0" : "").$item."' ".$s.">".$item.":00 ".$MOD_TIMEBASED_PICKER['TIME_HOUR_NAME']."</option>\n";
}
$time_start_select .= "</select>\n";
$time_end_select .= "</select>\n";

$timezones = array(
	"Pacific/Kwajalein",
	"Pacific/Samoa",
	"Pacific/Honolulu",
	"America/Anchorage",
	"America/Los_Angeles",
	"America/Phoenix",
	"America/Mexico_City",
	"America/Lima",
	"America/Caracas",
	"America/Halifax",
	"America/Buenos_Aires",
	"Atlantic/Reykjavik",
	"Atlantic/Azores",
	"Europe/London",
	"Europe/Berlin",
	"Europe/Kaliningrad",
	"Europe/Moscow",
	"Asia/Tehran",
	"Asia/Baku",
	"Asia/Kabul",
	"Asia/Tashkent",
	"Asia/Calcutta",
	"Asia/Colombo",
	"Asia/Bangkok",
	"Asia/Hong_Kong",
	"Asia/Tokyo",
	"Australia/Adelaide",
	"Pacific/Guam",
	"Etc/GMT+10",
	"Pacific/Fiji"
);

$time_zone_select = "\n<select name='time_zone' id='time_zone'>\n";
foreach($timezones as $item) {
	$s = ($item == $sql_row['time_zone']) ? " selected='selected'" : "";
	$time_zone_select .= "<option value='".$item."' ".$s.">".$item."</option>\n";
}
$time_zone_select .= "</select>\n";

/**
 *	FTAN for WB and leptoken for L*
 *
 */
$ftan_tag = ( true === method_exists($admin, "getFTAN") ) ? $admin->getFTAN() : "";
$leptoken_tag = ( isset( $_GET['leptoken']) ) ? "\n<input type='hidden' name='leptoken' value='".$_GET['leptoken']."' />\n" : "";
?>
<form name="select_section<?php echo $section_id; ?>" action="<?php echo WB_URL ?>/modules/timebased_picker/save.php" method="post">
<input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
<input type="hidden" name="section_id" value="<?php echo $section_id ?>" />
<?php echo $ftan_tag."\n".$leptoken_tag; ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><?php echo $TEXT['SECTION'].':' ?></td>
		<td>
			<select name="target_section_id_<?php echo $section_id; ?>" class="timebased_picker" />
				<option value="0"<?php echo $target_section_id=='0' ? $sel : '' ?>><?php echo $TEXT['PLEASE_SELECT']; ?></option>
				<?php foreach($links as $li) {
					$option_link = explode('|',$li);
					$disabled = $option_link[0] ? '':' disabled';
					echo "<option ".$disabled." value=\"".$option_link[0]."\" ".($target_section_id==$option_link[0] ? $sel : '').">".$option_link[1]."</option>\n";
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php echo $MOD_TIMEBASED_PICKER['TIME_START']; ?></td>
		<td><?php echo $time_start_select; ?></td>
	</tr>
	<tr>
		<td><?php echo $MOD_TIMEBASED_PICKER['TIME_END']; ?></td>
		<td><?php echo $time_end_select; ?></td>
	</tr>
	<tr>
		<td><?php echo $MOD_TIMEBASED_PICKER['TIME_ZONE']; ?></td>
		<td><?php echo $time_zone_select; ?></td>
	</tr>
	<tr>
		<td><?php echo $MOD_TIMEBASED_PICKER['WEEKDAYS']; ?></td>
		<td><?php 
		
		for($i=1;$i<=6; $i++) {
			echo "<input type='checkbox' name='weekdays[]' class='tbp' value='".$i."' ".(true === in_array( $i, $weekdays) ? "checked='checked'" : "")." /> ".$MOD_TIMEBASED_PICKER['WEEKDAYS_ABBR'][$i];
		}
		echo "<input type='checkbox' name='weekdays[]' class='tbp' value='0' ".(true === in_array( '0', $weekdays) ? "checked='checked'" : "")." /> ".$MOD_TIMEBASED_PICKER['WEEKDAYS_ABBR'][0];
		
		?></td>
	</tr>

	<tr>
		<td><?php echo $MOD_TIMEBASED_PICKER['ACTIVE_HEAD_SECTION']; ?></td>
		<td>
			<select name="head_section_id_<?php echo $section_id; ?>" class="timebased_picker" />
				<option value="0"<?php echo $head_section_id=='0' ? $sel : '' ?>><?php echo $TEXT['PLEASE_SELECT']; ?></option>
				<?php foreach($links as $li) {
					$option_link = explode('|',$li);
					$disabled = $option_link[0] != ""  ? '':' disabled';
					echo "<option ".$disabled." value=\"".$option_link[0]."\" ".($head_section_id==$option_link[0] ? $sel : '').">".$option_link[1]."</option>\n";
				} ?>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php echo $MOD_TIMEBASED_PICKER['INACTIVE-SECTION']; ?></td>
		<td>
			<select name="inactive_section_id_<?php echo $section_id; ?>" class="timebased_picker" />
				<option value="0"<?php echo $inactive_section_id=='0' ? $sel : '' ?>><?php echo $TEXT['PLEASE_SELECT']; ?></option>
				<?php foreach($links as $li) {
					$option_link = explode('|',$li);
					$disabled = $option_link[0] ? '':' disabled';
					echo "<option ".$disabled." value=\"".$option_link[0]."\" ".($inactive_section_id==$option_link[0] ? $sel : '').">".$option_link[1]."</option>\n";
				} ?>
			</select>
		</td>
	</tr>
</table>
<p></p>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left"><input type="submit" value="<?php echo $TEXT['SAVE'] ?>" style="width: 100px; margin-top: 5px;" /></td>
		<td align="right"><input type="button" value="<?php echo $TEXT['CANCEL'] ?>" onclick="javascript: window.location='index.php';" style="width: 100px; margin-top: 5px;" /></td>
	</tr>
</table>
</form>
<p></p>
