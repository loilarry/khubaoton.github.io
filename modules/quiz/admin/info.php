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

$page_title = $lang_module['info'];

if( defined( 'NV_EDITOR' ) )
{
	require_once ( NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php' );
}
$content_file = NV_ROOTDIR . '/' . NV_DATADIR . '/' . NV_LANG_DATA . '_' . $module_data . '_info.txt';

$intro_pay = "";
if( file_exists( $content_file ) )
{
	$intro_pay = file_get_contents( $content_file );
	$intro_pay = nv_editor_br2nl( $intro_pay );
}

if( $nv_Request->get_int( 'saveintro', 'post', 0 ) == 1 )
{
	$intro_pay = $nv_Request->get_string( 'intro_pay', 'post', '' );
	$intro_pay = defined( 'NV_EDITOR' ) ? nv_nl2br( $intro_pay, '' ) : nv_nl2br( nv_htmlspecialchars( strip_tags( $intro_pay ) ), '<br />' );
	file_put_contents( $content_file, $intro_pay );
}

if( defined( 'NV_EDITOR' ) and function_exists( 'nv_aleditor' ) )
{
	$edits = nv_aleditor( 'intro_pay', '100%', '300px', $intro_pay );
}
else
{
	$edits = "<textarea style=\"width: 100%\" name=\"intro_pay\" id=\"intro_pay\" cols=\"20\" rows=\"15\">" . $intro_pay . "</textarea>";
}

$xtpl = new XTemplate( "info.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'edit_intro_pay', $edits );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';