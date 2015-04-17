<?php

/**
 *	
 *	@category		modules
 *	@package		timebased_picker ( formerly: jmstv_picker )
 *	@author			Ruud Eisinga, Evaki, Dietrich Roland Pehlke (last)';
 *	@license		http://www.gnu.org/licenses/gpl.html
 *	@requirements	PHP 5.2.2 and higher
 *
 *	0.5.4	2012-01-15	- Add admin-test to the save.php.
 *
 *	0.5.3	2012-01-14	- Bugfix inside view.php - testing the conditions for "over - midnight",
 *						  e.g. saturday is allowed from 23.00 o'clock up to 6.00 o'clock in the
 *						  next morning.
 *						- Update header-info inside view.php.
 *						- Remove some typos in the languagefiles.
 *						- Bugfix inside save.php if no weekday is selected.
 *
 *	0.5.2	2012-01-13	- Bugfix inside the install.php.
 *						- Add upgrade.php to the project.
 *
 *	0.5.1	2012-01-13	- Add weekdays to the db-table, interface, language-files and in the
 *						  view.php conditions.
 *
 *	0.5.0	2012-01-13	- Rename project to "timebased picker" - as this one is not for the 
 *						  german act "JugendMedien-schutzverordnung" only.
 *						- New Version, as WB/L* can handle thoose ones since years!
 *
 *	0.4.0	2012-01-13	- Minor bugfix inside view.php - restore "old" section_id.
 *						- Add two fields to the db-table for "display head section "and 
 *						  "inactive-section" (-id).
 *						- Additional language-keys.
 *						- Additions inside the install.php
 *						- Remove obsolete "on.html" and "off.html" files.
 *						- Recode view.php.
 *
 *	0.3.5	2012-01-12	- Actual header informations and module-description.
 *						- Bugfix for the correct time comparesion in the view.php.
 *						- Bugfix for correct css-tag of the target-section-modules.
 *						- Add frontend.js of the target-section, if the file exists.
 *
 *	0.3.4	2012-01-11	- Bugfix for the frontend.css implatation.
 * 
 *	0.3.3	2012-01-11	- Bugfix for the search
 *						- Minimal english translations.
 *						- Some code-changes inside the view.php.
 *						- Add guid to the module.
 *				
 *	0.3.2	2012-01-10	- Bugfix for the correct time-calculation.
 *
 *	0.3.1	2012-01-10	- Bugfixes and minor code changes.
 *						- Rename function build_pagelist to build_pagelist2 to avoid conflicts
 *						  within another section-picker section on the same page.
 *				  
 *	0.3.0	2012-01-09	- Massive recoding inside view.php.
 *						- Add language-files for EN and DE.
 *						- Add language-subfolders for the on-/off- html warning files.
 *						- Add db-fields for "time_start", "time_end" and "timezone".
 *						- Add selections to the backend-interface.
 *						- Add new fields to the save.php.
 *						- Add placeholder to the htm-warning files for the times.
 *
 */

$module_directory	= 'timebased_picker';
$module_name		= 'Timebased Picker';
$module_function	= 'page';
$module_version		= '0.5.4';
$module_platform	= '2.8.2';
$module_author		= 'Ruud Eisinga, Evaki, Dietrich Roland Pehlke (last)';
$module_license		= 'GNU General Public License';
$module_description	= 'Timebased section-picker (e.g. for the german act "JMStV (§§ 8 ff. JMStV)"). Based on module "section_picker" of Ruud Eisinga.';
$module_guid		= "D43DEC03-5DC8-4578-9698-EDCFDF7B8F67";

?>