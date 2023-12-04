<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2011 VINADES.,JSC. All rights reserved
 * @Createdate 12/1/2011, 11:17
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

if ( ! function_exists( 'nv_lich_phat_song' ) )
{
   function nv_lich_phat_song()
    {
        global $global_config, $my_head, $lang_global, $module_name, $op, $nv_Request;

        if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/blocks/global.lich_phat_song.tpl" ) )
        {
            $block_theme = $global_config['module_theme'];
        } 
		elseif ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/blocks/global.lich_phat_song.tpl" ) )
        {
            $block_theme = $global_config['site_theme'];
        }
        else
        {
            $block_theme = "default";
        }

		if( file_exists( NV_ROOTDIR . "/themes/" . $block_theme . "/css/block.lich_phat_song.css" ) )
		{
			$my_head .= '<link rel="StyleSheet" href="' . NV_BASE_SITEURL . 'themes/' . $block_theme . '/css/block.lich_phat_song.css" type="text/css" />';
		}
		
        $xtpl = new XTemplate( "global.lich_phat_song.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/blocks" );
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
        $xtpl->assign( 'URL_LOAD', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op . "&getlichphatsong=1&kenh=" );
        $xtpl->assign( 'DAY', nv_date( "d/m/Y" ) );
		
		if( $nv_Request->isset_request( 'getlichphatsong', 'get' ) )
		{
			$kenh = filter_text_input( 'kenh', 'get', 'VTV1' );
			$url = 'http://vtv.vn/LichPS/GetLichPhatsong?nam=' . date('Y') . '&thang=' . date('n') . '&ngay=' . date('j') . '&kenh=' . $kenh;
			$cache_file = NV_LANG_DATA . "_block_lich_phat_song.cache";

			$array = array();
			$load_new = false;
			$now_date = mktime( 0, 0, 0, date('n'), date('j'), date('Y') );
			
			if ( ( $cache = nv_get_cache( $cache_file ) ) != false )
			{
				
				$array = unserialize( $cache );
				if( ! isset( $array[$kenh] ) or ( $array['time'] < ( $now_date - 86400 ) ) )
				{
					$load_new = true;
				}
				
				if( $array['time'] < ( $now_date - 86400 ) )
				{
					nv_deletefile( NV_ROOTDIR . "/" . NV_CACHEDIR . "/" . $cache_file, true );
				}
			}
			else
			{
				$load_new = true;
			}
			
			if( $load_new )
			{
				$array['time'] = $now_date;
				$array[$kenh] = file_get_contents( $url );
				
				$cache = serialize( $array );
				nv_set_cache( $cache_file, $cache );
			}
			
			$xtpl->assign( 'DATA', $array[$kenh] );
			$xtpl->parse( 'main' );
			die( $xtpl->text( 'main' ) );
		}
		
        $xtpl->parse( 'js' );
        $content = $xtpl->text( 'js' );
		
        return $content;
    }
}

$content = nv_lich_phat_song();

?>