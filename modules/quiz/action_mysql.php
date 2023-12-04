<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @Blog http://dangdinhtu.com
 * @Developers http://developers.dangdinhtu.com/
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Mon, 27 Apr 2015 00:00:00 GMT
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
/* $sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows";
*/
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_question";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_list";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_info";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_person";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sublist";

$sql_create_module = $sql_drop_module;

/* $sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (
rid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
infoid mediumint(8) unsigned NOT NULL DEFAULT '0',
qid mediumint(8) unsigned NOT NULL DEFAULT '0',
ans varchar(1) NOT NULL DEFAULT '',
dapan varchar(1) NOT NULL DEFAULT '',
PRIMARY KEY (rid)
) ENGINE=MyISAM";
*/

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_question (
	question_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	question text NOT NULL,
	PRIMARY KEY (question_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sublist (
	sublist_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	info_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	question tinyint(1) unsigned NOT NULL DEFAULT '0',
	answer text NOT NULL,
	PRIMARY KEY (sublist_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_list (
	list_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	question_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	answer varchar(1) NOT NULL,
	title varchar(255) NOT NULL,
	active tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (list_id),
	KEY question_id (question_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_info (
	info_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	alias varchar(255) NOT NULL,
	full_name varchar(255) NOT NULL,
	birthday varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	telephone varchar(255) NOT NULL,
	address varchar(255) NOT NULL,
	work_unit varchar(255) NOT NULL,
	outcome tinyint(3) unsigned NOT NULL DEFAULT '0',
	begintime int(11) unsigned NOT NULL,
	endtime int(11) unsigned NOT NULL,
	session varchar(255) NOT NULL,
	PRIMARY KEY (info_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_person (
	person_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	info_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	question_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	answer char(1) NOT NULL,
	PRIMARY KEY (person_id),
	KEY question_id (question_id)
) ENGINE=MyISAM";
 
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'per_page', '30')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'time_test', '" . NV_CURRENTTIME . "')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'time_out', '" . ( NV_CURRENTTIME + 86400 * 30 ) . "')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'title', 'Tiêu đề dự thi')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'cauphu', 'Câu hỏi tự luận')";
