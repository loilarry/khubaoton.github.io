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

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_top_quiz' ) )
{
	function nv_block_config_top_quiz( $module, $data_block, $lang_block )
	{
		global $site_mods;
		$html = "";
		$html .= "<tr>";
		$html .= "<td>" . $lang_block['numrow'] . "</td>";
		$html .= "<td><input type=\"text\" name=\"config_numrow\" size=\"5\" value=\"" . $data_block['numrow'] . "\"/></td>";
		$html .= "</tr>";
		return $html;
	}

	function nv_block_config_top_quiz_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['blockid'] = $nv_Request->get_int( 'config_blockid', 'post', 0 );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		return $return;
	}

	function nv_block_top_quiz( $block_config )
	{
		global $module_info, $site_mods, $db, $module_config;
		$module = $block_config['module'];
		$list = array();

		
		$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $site_mods[$module]['module_data'] . "_info ORDER BY outcome DESC LIMIT 0, " . $block_config['numrow'];
		$result = $db->query( $sql );
		while( $item = $result->fetch() )
		{
			$list[] = $item;
		}
		$i = 1;
		if( ! empty( $list ) )
		{
			if( file_exists( NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/quiz/block_top.tpl" ) )
			{
				$block_theme = $module_info['template'];
			}
			else
			{
				$block_theme = "default";
			}
			$xtpl = new XTemplate( "block_top.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/quiz" );
			$a=1;
			foreach( $list as $l )
			{
				if(!empty($l['hoten']))
				{
					$l['stt'] = $a;
 					$l['total'] = $module_config[$module]['per_page'];
					$xtpl->assign( 'loop', $l );
					$xtpl->parse( 'main.loop' );
					++$a;
				}
			}
			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}

}
if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{
		$content = nv_block_top_quiz( $block_config );
	}
}