<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2011 VINADES.,JSC. All rights reserved
 * @Createdate 12/1/2011, 11:17
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

if ( ! function_exists( 'nv_tracuu_dichvucong' ) )
{
   function nv_tracuu_dichvucong()
    {
        global $global_config, $my_head, $lang_global, $module_name, $op, $nv_Request;

        if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/blocks/global.tracuu_dichvucong.tpl" ) )
        {
            $block_theme = $global_config['module_theme'];
        } 
		elseif ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/blocks/global.tracuu_dichvucong.tpl" ) )
        {
            $block_theme = $global_config['site_theme'];
        }
        else
        {
            $block_theme = "default";
        }

        $xtpl = new XTemplate( "global.tracuu_dichvucong.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/blocks" );
		
        $xtpl->parse( 'js' );
        $content = $xtpl->text( 'js' );
		
        return $content;
    }
}

$content = nv_tracuu_dichvucong();

?>