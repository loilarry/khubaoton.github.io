<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES ., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Jan 10, 2011 6:04:30 PM
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

if (!nv_function_exists('nv_block_global_text_banner_gio')) {
    /**
     * nv_block_config_text_banner_gio()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_text_banner_gio($module, $data_block, $lang_block)
    {
        $html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['site_title'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" name="config_site_title" class="form-control" value="' . $data_block['site_title'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['site_description'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" name="config_site_description" class="form-control" value="' . $data_block['site_description'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<div class="col-sm-18 col-sm-offset-6"><div class="checkbox"><label><input type="checkbox" name="config_use_sitename" value="1"' . ($data_block['use_sitename'] ? ' checked="checked"' : '') . '/> ' . $lang_block['use_sitename'] . '</label></div></div>';
        $html .= '</div>';
        return $html;
    }

    /**
     * nv_block_config_text_banner_gio_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_text_banner_gio_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['site_title'] = $nv_Request->get_title('config_site_title', 'post', '');
        $return['config']['site_description'] = $nv_Request->get_title('config_site_description', 'post', '');
        $return['config']['use_sitename'] = $nv_Request->get_int('config_use_sitename', 'post', 0);
        return $return;
    }

    /**
     * nv_block_global_text_banner_gio()
     *
     * @param mixed $block_config
     * @return
     */
    function nv_block_global_text_banner_gio($block_config)
    {
        global $global_config;

        if (!empty($block_config['use_sitename'])) {
            $block_config['site_description'] = $global_config['site_name'];
        }

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.text_banner_gio.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.text_banner_gio.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('global.text_banner_gio.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('TEMPLATE', $block_theme);
        $xtpl->assign('CONFIG', $block_config);

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_global_text_banner_gio($block_config);
}
