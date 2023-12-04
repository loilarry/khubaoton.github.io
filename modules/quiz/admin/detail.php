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
 
$info_id = $nv_Request->get_int( 'info_id', 'get', 0 );
 
$sql = 'SELECT * FROM ' . TABLE_QUIZ_NAME . '_info WHERE info_id='. $info_id;
$result = $db->query( $sql );

$xtpl = new XTemplate( 'detail.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'URL_BACK', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main' );
$xtpl->assign( 'URL_XLS', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=xls' );
$xtpl->assign( 'QUESTION', $quiz_config['cauphu'] );

while( $loop = $result->fetch() )
{
	// $loop['link'] =  NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&info_id='.$loop['info_id'];
	// $xtpl->assign( 'link_del', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=del_info&info_id=' . $loop['info_id'] . '&token=' . md5( $loop['info_id'] . $global_config['sitekey'] . session_id() ) );
 	$loop['token'] = md5( $global_config['sitekey'] . session_id() . $loop['info_id'] );
		
	if( ( $loop['endtime'] - $loop['begintime'] ) < 60 )
	{
		$loop['time'] = $loop['endtime'] - $loop['begintime'] . ' giây';
	}
	else
	{
		$phut = ( int )( ( $loop['endtime'] - $loop['begintime'] ) / 60 );
		$giay = ( $loop['endtime'] - $loop['begintime'] ) % 60;
		$loop['time'] = $phut . 'phút ' . $giay . ' giây';
	}
	$xtpl->assign( 'LOOP', $loop );
	$xtpl->parse( 'main.loop' );
}

$cauphu = $db->query( 'SELECT answer FROM ' . TABLE_QUIZ_NAME . '_sublist WHERE info_id='. $info_id  )->fetchColumn();
$xtpl->assign( 'CAUPHU', $cauphu );
 
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';