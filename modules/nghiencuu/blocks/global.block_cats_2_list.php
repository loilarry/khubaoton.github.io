<?php

/**
 * TMS Content Management System
 * @version 4.x
 * @author Tập Đoàn TMS Holdings <contact@tms.vn>
 * @copyright (C) 2009-2021 Tập Đoàn TMS Holdings. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://tms.vn
 */
if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_news_cats_2_list' ) )
{
	function nv_block_config_news_cats_2_list( $module, $data_block, $lang_block )
	{
		global $site_mods, $nv_Cache;

		$html = '<div>';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['catid'] . ':</label>';
		$sql = 'SELECT catid, title, lev FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat ORDER BY sort ASC';
		$list = $nv_Cache->db( $sql, '', $module );
        $html .= '<div class="col-sm-18">';
		foreach( $list as $l )
		{
			$xtitle_i = '';

			if( $l['lev'] > 0 )
			{
				for( $i = 1; $i <= $l['lev']; ++$i )
				{
					$xtitle_i .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
			}
			$html .= $xtitle_i . '<label><input type="checkbox" name="config_catid[]" value="' . $l['catid'] . '" ' . ( ( in_array( $l['catid'], $data_block['catid'] ) ) ? ' checked="checked"' : '' ) . '</input>' . $l['title'] . '</label><br />';
		}
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
		$html .= '<div class="col-sm-18"><input type="text" class="form-control w200" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></div>';
		$html .= '</div>';
		
		$html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['title_length'] . '</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_title_length" size="5" value="' . $data_block['title_length'] . '"/></div>';
        $html .= '</div>'; 

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['hometext_length'] . '</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_hometext_length" size="5" value="' . $data_block['hometext_length'] . '"/></div>';
        $html .= '</div>'; 
		$html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Chiều cao hình:</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_height" size="5" value="' . $data_block['height'] . '"/></div>';
        $html .= '</div>'; 

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Kích thước 640:</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_d640" size="5" value="' . $data_block['d640'] . '"/>1 điền 24, 2 điền 12, 3 điền 8, 4 điền 6, 6 điền 2</div>';
        $html .= '</div>'; 
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Kích thước 768:</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_d768" size="5" value="' . $data_block['d768'] . '"/>1 điền 24, 2 điền 12, 3 điền 8, 4 điền 6, 6 điền 2</div>';
        $html .= '</div>'; 
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Kích thước 1024:</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_d1024" size="5" value="' . $data_block['d1024'] . '"/>1 điền 24, 2 điền 12, 3 điền 8, 4 điền 6, 6 điền 2</div>';
        $html .= '</div>'; 
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Kích thước 1124:</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_d1124" size="5" value="' . $data_block['d1124'] . '"/>1 điền 24, 2 điền 12, 3 điền 8, 4 điền 6, 6 điền 2</div>';
        $html .= '</div>'; 
		
		return $html;
	}

	function nv_block_config_news_cats_2_list_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['catid'] =$nv_Request->get_array( 'config_catid', 'post', array() );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		$return['config']['title_length'] = $nv_Request->get_string( 'config_title_length', 'post', 0 );
		$return['config']['hometext_length'] = $nv_Request->get_string( 'config_hometext_length', 'post', 0 );
				$return['config']['height'] = $nv_Request->get_int('config_height', 'post', 0);
        $return['config']['d640'] = $nv_Request->get_int('config_d640', 'post', 0);
        $return['config']['d768'] = $nv_Request->get_int('config_d768', 'post', 0);
        $return['config']['d1024'] = $nv_Request->get_int('config_d1024', 'post', 0);
        $return['config']['d1124'] = $nv_Request->get_int('config_d1124', 'post', 0);
		return $return;
	}

	function nv_block_news_cats_2_list( $block_config )
	{
		global $nv_Cache, $module_array_cat, $module_info, $site_mods, $module_config, $global_config, $db;
		$module = $block_config['module'];
		$show_no_image = $module_config[$module]['show_no_image'];
		$blockwidth = $module_config[$module]['blockwidth'];
		$blockheight = $module_config[$module]['blockheight'];
		if( empty( $block_config['catid'] ) ) return '';

		$catid = implode(',',$block_config['catid']);
		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/news/glocal.block_cats_2_list.tpl' ) )
		{
			$block_theme = $global_config['module_theme'];
		}
		else
		{
			$block_theme = 'default';
		}
		$xtpl = new XTemplate( 'glocal.block_cats_2_list.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/news' );
		$xtpl->assign( 'CONFIG', $block_config);

		$n = 0;
		$sql = 'SELECT catid, title FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat WHERE catid IN ( '.$catid.' ) ORDER BY sort ASC' ;
		$result = $db->query( $sql );
		while( $data = $result->fetch( ) )
		{
			$n++;
			if($n==1)
			{
				$data['active'] = 'active';
			}

			$data['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $module_array_cat[$data['catid']]['alias'] . $global_config['rewrite_exturl'];
			$xtpl->assign( 'CAT_INFO', $data);
			$db->sqlreset()
			->select( 'COUNT(*)' )
			->from( NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_' . $data['catid'] )
			->where( 'status= 1' );
			
			$num_items = $db->query( $db->sql() )->fetchColumn();
			
			if($num_items > 0)
			{
				

				$db->sqlreset()
					->select( 'id, catid, title, alias, homeimgfile, homeimgthumb, hometext, publtime' )
					->from( NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_' . $data['catid'] )
					->where( 'status= 1' )
					->order( 'publtime DESC' )
					->limit( $block_config['numrow'] );
				$list = $nv_Cache->db( $db->sql(), '', $module );

				if( ! empty( $list ) )
				{	$i=1;
					foreach( $list as $l )
					{
						$l['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $module_array_cat[$l['catid']]['alias'] . '/' . $l['alias'] . '-' . $l['id'] . $global_config['rewrite_exturl'];
						if( $l['homeimgthumb'] == 1 )
						{
							$l['thumb'] = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $l['homeimgfile'];
						}
						elseif( $l['homeimgthumb'] == 2 )
						{
							$l['thumb'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $l['homeimgfile'];
						}
						elseif( $l['homeimgthumb'] == 3 )
						{
							$l['thumb'] = $l['homeimgfile'];
						}
						elseif( ! empty( $show_no_image ) )
						{
							$l['thumb'] = NV_BASE_SITEURL . $show_no_image;
						}
						else
						{
							$l['thumb'] = '';
						}
						$l['catid'] = $data['catid'];
						$l['blockwidth'] = $blockwidth;
						$l['blockheight'] = $blockheight;
						$l['time'] = nv_date('d/m/Y', $l['publtime']);
                   		$l['title'] =  $l['title'];
                 		$l['title_clean'] = nv_clean60( $l['title'], $block_config['title_length'] );
                 	    $l['hometext_clean'] = strip_tags($l['hometext']);
                	    $l['hometext_clean'] = nv_clean60($l['hometext_clean'], $block_config['hometext_length'], true);

						$xtpl->assign( 'ROW', $l );
						 if($i==1)
                    	{$xtpl->parse( 'main.cat_info.top' );}
                  		  else { $xtpl->parse( 'main.cat_info.loop' );}
                   	 ++$i;
					}
					

				}
				$xtpl->parse( 'main.cat_info' );

			}
		}

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}
if( defined( 'NV_SYSTEM' ) )
{
	global $nv_Cache, $site_mods, $module_name, $global_array_cat, $module_array_cat;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{
		if( $module == $module_name )
		{
			$module_array_cat = $global_array_cat;
			unset( $module_array_cat[0] );
		}
		else
		{
			$module_array_cat = array();
			$sql = 'SELECT catid, parentid, title, alias, viewcat, subcatid, numlinks, description, status, keywords, groups_view FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat ORDER BY sort ASC';
			$list = $nv_Cache->db( $sql, 'catid', $module );
			foreach( $list as $l )
			{
				$module_array_cat[$l['catid']] = $l;
				$module_array_cat[$l['catid']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
			}
		}
		$content = nv_block_news_cats_2_list( $block_config );
	}
}