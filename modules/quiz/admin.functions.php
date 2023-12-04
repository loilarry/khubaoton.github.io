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

if( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );
 
define( 'TABLE_QUIZ_NAME', NV_PREFIXLANG . '_' . $module_data );  

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) ); 

$allow_func = array( 'main', 'xls', 'info', 'quiz', 'top', 'listquiz', 'setting',  'detail' );

$quiz_config = $module_config[$module_name];
 
function toAlpha( $data )
{
	$alphabet = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );
	$alpha_flip = array_flip( $alphabet );
	if( $data <= 25 )
	{
		return $alphabet[$data];
	} elseif( $data > 25 )
	{
		$dividend = ( $data + 1 );
		$alpha = '';
		$modulo;
		while( $dividend > 0 )
		{
			$modulo = ( $dividend - 1 ) % 26;
			$alpha = $alphabet[$modulo] . $alpha;
			$dividend = floor( ( ( $dividend - $modulo ) / 26 ) );
		}
		return $alpha;
	}

}

function toNum( $data )
{
	$alphabet = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );
	$alpha_flip = array_flip( $alphabet );
	$return_value = -1;
	$length = strlen( $data );
	for( $i = 0; $i < $length; $i++ )
	{
		$return_value += ( $alpha_flip[$data[$i]] + 1 ) * pow( 26, ( $length - $i - 1 ) );
	}
	return $return_value;
}
 
define( 'NV_IS_FILE_ADMIN', true );