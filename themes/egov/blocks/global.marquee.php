<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 17 Sep 2014 14:20:47 GMT
 */

if( !defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv4_block_header' ) )
{
	function nv_block_header_config( $module, $data_block, $lang_block )
	{
		$html = '';
		$html .= '<tr>';
		$html .= '	<td>' . $lang_block['content'] . '</td>';
		$html .= '	<td><textarea name="config_content" class="form-control">' . $data_block['content'] . '</textarea></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '	<td>' . $lang_block['direction'] . '</td>';
		$html .= '<td><select name="config_direction" class="form-control w200">';
		$se = $data_block['direction'] == 'top' ? 'selected="selected"' : '';
		$html .= '<option value="top" ' . $se . '>' . $lang_block['direction_top'] . '</option>';
		$se = $data_block['direction'] == 'bottom' ? 'selected="selected"' : '';
		$html .= '<option value="bottom" ' . $se . '>' . $lang_block['direction_bottom'] . '</option>';
		$se = $data_block['direction'] == 'left' ? 'selected="selected"' : '';
		$html .= '<option value="left" ' . $se . '>' . $lang_block['direction_left'] . '</option>';
		$se = $data_block['direction'] == 'right' ? 'selected="selected"' : '';
		$html .= '<option value="right" ' . $se . '>' . $lang_block['direction_right'] . '</option>';
		$html .= '</select></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '	<td>' . $lang_block['scroll'] . '</td>';
		$html .= '	<td><input name="config_scroll" class="form-control w200" value="' . $data_block['scroll'] . '" /></td>';
		$html .= '</tr>';

		return $html;
	}

	function nv_block_header_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config']['content'] = $nv_Request->get_textarea( 'config_content', '', '<br />' );
		$return['config']['scroll'] = $nv_Request->get_int( 'config_scroll', 'post', '1' );
		$return['config']['direction'] = $nv_Request->get_title( 'config_direction', 'post', 'left' );
		return $return;
	}

	function nv4_block_header( $block_config )
	{
		global $global_config, $db, $site_mods, $module_name, $my_head;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.marquee.tpl' ) )
		{
			$block_theme = $global_config['module_theme'];
		}
		elseif( file_exists( NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.marquee.tpl' ) )
		{
			$block_theme = $global_config['site_theme'];
		}
		else
		{
			$block_theme = 'default';
		}

		if( ! defined( 'MARQUEE' ) and file_exists( NV_ROOTDIR . '/themes/' . $block_theme . '/js/marquee.js' ) )
		{
			$my_head .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . 'themes/' . $block_theme . '/js/marquee.js"></script>';
			define( 'MARQUEE', true );
		}

		$xtpl = new XTemplate( 'global.marquee.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks' );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'TEMPLATE', $block_theme );
		$xtpl->assign( 'DATA', $block_config );

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	$content = nv4_block_header( $block_config );
}