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

if( ! defined( 'NV_IS_MOD_QUIZ' ) ) die( 'Stop!!!' );

/**
 * nv_theme_quiz_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_quiz_main( $array_data, $khoa_array, $info )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

	$xtpl = new XTemplate( $op . ".tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'info', $info );

	foreach( $khoa_array as $num => $khoa )
	{
		$sl = ( $khoa == $num ) ? " selected=\"selected\"" : "";
		$xtpl->assign( 'sl', $sl );
		$xtpl->assign( 'khoa', $khoa );
		$xtpl->parse( 'main.loop' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}
 