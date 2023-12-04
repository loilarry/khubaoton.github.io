<?php

/**
 * @Project NUKEVIET 4.x
 * @Author PHAN TAN DUNG <phantandung92@gmail.com>
 * @Copyright (C) 2017 OpenSource
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/11/2017
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

if (!nv_function_exists('nv_iframe_blocks')) {
    /**
     * nv_block_config_iframe_blocks()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_iframe_blocks($module, $data_block, $lang_block)
    {
        $html = '';
        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['url'] . ':</label>';
        $html .= '	<div class="col-sm-18"><input class="form-control" type="text" name="config_url" value="' . $data_block['url'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['autowidth'] . ':</label>';
        $html .= '	<div class="col-sm-18"><div class="checkbox"><label><input type="checkbox" name="config_autowidth" value="1"' . (empty($data_block['autowidth']) ? '' : ' checked="checked"') . '/></label></div></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['width'] . ':</label>';
        $html .= '	<div class="col-sm-5"><input class="form-control" type="text" name="config_width" value="' . $data_block['width'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['height'] . ':</label>';
        $html .= '	<div class="col-sm-5"><input class="form-control" type="text" name="config_height" value="' . $data_block['height'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['scrollbar'] . ':</label>';
        $html .= '	<div class="col-sm-18"><div class="checkbox"><label><input type="checkbox" name="config_scrollbar" value="1"' . (empty($data_block['scrollbar']) ? '' : ' checked="checked"') . '/></label></div></div>';
        $html .= '</div>';
        return $html;
    }

    /**
     * nv_block_config_iframe_blocks_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_iframe_blocks_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['url'] = $nv_Request->get_string('config_url', 'post', 0);
        $return['config']['autowidth'] = $nv_Request->get_int('config_autowidth', 'post', 0);
        $return['config']['width'] = $nv_Request->get_int('config_width', 'post', 0);
        $return['config']['height'] = $nv_Request->get_int('config_height', 'post', 0);
        $return['config']['scrollbar'] = $nv_Request->get_int('config_scrollbar', 'post', 0);
        return $return;
    }

    /**
     * nv_iframe_blocks()
     *
     * @param mixed $block_config
     * @return
     */
    function nv_iframe_blocks($block_config)
    {
        return '<iframe id="blockiframe' . $block_config['bid'] . '" name="blockiframe' . $block_config['bid'] . '" src="' . $block_config['url'] . '"' . (empty($block_config['autowidth']) ? 'width="' . $block_config['width'] . '"' : '') . ' height="' . $block_config['height'] . '" style="border:none;' . (empty($block_config['scrollbar']) ? 'overflow:hidden;' : '') . (!empty($block_config['autowidth']) ? 'width:100%;' : '') . '"' . (empty($block_config['scrollbar']) ? ' scrolling="no"' : '') . ' frameborder="0" allowTransparency="true"></iframe>';
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_iframe_blocks($block_config);
}
