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

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['setting'];

$savesetting = $nv_Request->get_int( 'savesetting', 'post', 0 );
if( ! empty( $savesetting ) )
{
	$array_config = array();
	$array_config['per_page'] = $nv_Request->get_int( 'per_page', 'post', 20 );
	$array_config['title'] = $nv_Request->get_string( 'title', 'post', '' );
	$array_config['cauphu'] = $nv_Request->get_string( 'cauphu', 'post', '' );
	$time_test = $nv_Request->get_title( 'time_test', 'post', '' );

	if( ! empty( $time_test ) and preg_match( "/^([0-9]{1,2})\\/([0-9]{1,2})\/([0-9]{4})$/", $time_test, $m ) )
	{
		$phour = $nv_Request->get_int( 'phour', 'post', 0 );
		$pmin = $nv_Request->get_int( 'pmin', 'post', 0 );
		$array_config['time_test'] = mktime( $phour, $pmin, 0, $m[2], $m[1], $m[3] );
	}
	else
	{
		$array_config['time_test'] = NV_CURRENTTIME;
	}
	unset($m);
	$time_out = $nv_Request->get_title( 'time_out', 'post', '' );

	if( ! empty( $time_out ) and preg_match( "/^([0-9]{1,2})\\/([0-9]{1,2})\/([0-9]{4})$/", $time_out, $m ) )
	{
		$phour1 = $nv_Request->get_int( 'phour1', 'post', 0 );
		$pmin1 = $nv_Request->get_int( 'pmin1', 'post', 0 );
		$array_config['time_out'] = mktime( $phour1, $pmin1, 0, $m[2], $m[1], $m[3] );
	}
	else
	{
		$array_config['time_out'] = NV_CURRENTTIME;
	}
	
	
	//$array_config['time_test'] = $nv_Request->get_title( 'time_test', 'post', '' );
	// $array_config['setcomm'] = $nv_Request->get_int( 'setcomm', 'post', 0 );
	// $array_config['catchalpha'] = $nv_Request->get_int( 'catchalpha', 'post', 0 );
	// $array_config['status'] = $nv_Request->get_int( 'status', 'post', 0 );
	// $array_config['facecomm'] = $nv_Request->get_int( 'facecomm', 'post', 0 );
	
	foreach( $array_config as $config_name => $config_value )
	{
		$db->query( "REPLACE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES('" . NV_LANG_DATA . "', " . $db->quote( $module_name ) . ", " . $db->quote( $config_name ) . ", " . $db->quote( $config_value ) . ")" );
	}
	//$xxx->closeCursor();

	nv_del_moduleCache( 'settings' );
	nv_del_moduleCache( $module_name );
	Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op . "&rand=" . nv_genpass() );
	die();
}

$my_head = "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . NV_BASE_SITEURL . "js/jquery/jquery.autocomplete.css\" />\n";
$my_head .= "<link type=\"text/css\" href=\"" . NV_BASE_SITEURL . "js/ui/jquery.ui.core.css\" rel=\"stylesheet\" />\n";
$my_head .= "<link type=\"text/css\" href=\"" . NV_BASE_SITEURL . "js/ui/jquery.ui.theme.css\" rel=\"stylesheet\" />\n";
$my_head .= "<link type=\"text/css\" href=\"" . NV_BASE_SITEURL . "js/ui/jquery.ui.datepicker.css\" rel=\"stylesheet\" />\n";

$my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/jquery/jquery.autocomplete.js\"></script>\n";
$my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/ui/jquery.ui.core.min.js\"></script>\n";
$my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/ui/jquery.ui.datepicker.min.js\"></script>\n";
$my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/language/jquery.ui.datepicker-" . NV_LANG_INTERFACE . ".js\"></script>\n";

$xtpl = new XTemplate( "settings.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'DATA', $module_config[$module_name] );

// So bai viet tren mot trang
for( $i = 5; $i <= 60; ++ $i )
{
	$xtpl->assign( 'PER_PAGE', array( "key" => $i, "title" => $i, "selected" => $i == $module_config[$module_name]['per_page'] ? " selected=\"selected\"" : "" ) );
	$xtpl->parse( 'main.per_page' );
}

$tdate = date( "H|i", $module_config[$module_name]['time_test'] );
$time_test = date( "d/m/Y", $module_config[$module_name]['time_test'] );
list( $phour, $pmin ) = explode( "|", $tdate );


$xtpl->assign( 'time_test', $time_test);
$select = "";
for( $i = 0; $i <= 23; ++$i )
{
	$select .= "<option value=\"" . $i . "\"" . ( ( $i == $phour ) ? " selected=\"selected\"" : "" ) . ">" . str_pad( $i, 2, "0", STR_PAD_LEFT ) . "</option>\n";
}
$xtpl->assign( 'phour', $select );


$select = "";
for( $i = 0; $i < 60; ++$i )
{
	$select .= "<option value=\"" . $i . "\"" . ( ( $i == $pmin ) ? " selected=\"selected\"" : "" ) . ">" . str_pad( $i, 2, "0", STR_PAD_LEFT ) . "</option>\n";
}
$xtpl->assign( 'pmin', $select );




$tdate1 = date( "H|i", $module_config[$module_name]['time_out'] );
$time_out = date( "d/m/Y", $module_config[$module_name]['time_out'] );
list( $phour1, $pmin1 ) = explode( "|", $tdate1 );


$xtpl->assign( 'time_out', $time_out);
$select = "";
for( $i = 0; $i <= 23; ++$i )
{
	$select .= "<option value=\"" . $i . "\"" . ( ( $i == $phour1 ) ? " selected=\"selected\"" : "" ) . ">" . str_pad( $i, 2, "0", STR_PAD_LEFT ) . "</option>\n";
}
$xtpl->assign( 'phour1', $select );


$select = "";
for( $i = 0; $i < 60; ++$i )
{
	$select .= "<option value=\"" . $i . "\"" . ( ( $i == $pmin1 ) ? " selected=\"selected\"" : "" ) . ">" . str_pad( $i, 2, "0", STR_PAD_LEFT ) . "</option>\n";
}
$xtpl->assign( 'pmin1', $select );



$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';