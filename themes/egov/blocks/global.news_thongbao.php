<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_block_news_thongbao')) {
    /**
     * @param string $module
     * @param array $data_block
     * @param array $lang_block
     * @return string
     */
    function nv_block_config_news_thongbao($module, $data_block, $lang_block)
    {
        global $nv_Cache, $site_mods, $nv_Request;

        // Xuất nội dung khi có chọn module
        if ($nv_Request->isset_request('loadajaxdata', 'get')) {
            $module = $nv_Request->get_title('loadajaxdata', 'get', '');

            $html = '<div class="form-group">';
            $html .= '<label class="control-label col-sm-6">' . $lang_block['catid'] . ':</label>';
            $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat WHERE status=1 OR status=2 ORDER BY sort ASC';
            $list = $nv_Cache->db($sql, '', $module);
            $html .= '<div class="col-sm-18"><div class="checkbox">';
            foreach ($list as $l) {
                $xtitle_i = '';

                if ($l['lev'] > 0) {
                    for ($i = 1; $i <= $l['lev']; ++ $i) {
                        $xtitle_i .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    }
                }
                $html .= $xtitle_i . '<div><label><input type="checkbox" name="config_catid[]" value="' . $l['catid'] . '" ' . ((in_array($l['catid'], $data_block['catid'])) ? ' checked="checked"' : '') . '>' . $l['title'] . '</label></div>';
            }
            $html .= '</div></div>';
            $html .= '</div>';
            $html .= '<div class="form-group">';
            $html .= '<label class="control-label col-sm-6">' . $lang_block['title_length'] . ':</label>';
            $html .= '<div class="col-sm-9"><input type="text" class="form-control" name="config_title_length" value="' . $data_block['title_length'] . '"/></div>';
            $html .= '</div>';
            $html .= '<div class="form-group">';
            $html .= '<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
            $html .= '<div class="col-sm-9"><input type="text" class="form-control" name="config_numrow" value="' . $data_block['numrow'] . '"/></div>';
            $html .= '</div>';
            $html .= '<div class="form-group">';
            $html .= '<label class="control-label col-sm-6">' . $lang_block['showtooltip'] . ':</label>';
            $html .= '<div class="col-sm-18">';
            $html .= '<div class="checkbox"><label><input type="checkbox" value="1" name="config_showtooltip" ' . ($data_block['showtooltip'] == 1 ? 'checked="checked"' : '') . ' /></label></div>';
            $tooltip_position = array(
                'top' => $lang_block['tooltip_position_top'],
                'bottom' => $lang_block['tooltip_position_bottom'],
                'left' => $lang_block['tooltip_position_left'],
                'right' => $lang_block['tooltip_position_right']
            );
            $html .= '<span class="text-middle pull-left">' . $lang_block['tooltip_position'] . '&nbsp;</span><select name="config_tooltip_position" class="form-control w100 pull-left">';
            foreach ($tooltip_position as $key => $value) {
                $html .= '<option value="' . $key . '" ' . ($data_block['tooltip_position'] == $key ? 'selected="selected"' : '') . '>' . $value . '</option>';
            }
            $html .= '</select>';
            $html .= '&nbsp;<span class="text-middle pull-left">' . $lang_block['tooltip_length'] . '&nbsp;</span><input type="text" class="form-control w100 pull-left" name="config_tooltip_length" size="5" value="' . $data_block['tooltip_length'] . '"/>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="form-group">';
            $html .= '<label class="control-label col-sm-6">' . $lang_block['show_type'] . ':</label>';
            $html .= '<div class="col-sm-18"><select name="config_show_type" class="form-control">';

            for ($i = 0; $i <= 1; $i ++) {
                $html .= '<option value="' . $i . '"' . ($i == $data_block['show_type'] ? ' selected="selected"' : '') . '>' . $lang_block['show_type' . $i] . '</option>';
            }

            $html .= '</select></div>';
            $html .= '</div>';

            nv_htmlOutput($html);
        }

        $html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['selectmod'] . ':</label>';
        $html .= '<div class="col-sm-9">';
        $html .= '<select name="config_selectmod" class="form-control">';
        $html .= '<option value="">--</option>';

        foreach ($site_mods as $title => $mod) {
            if ($mod['module_file'] == 'news') {
                $html .= '<option value="' . $title . '"' . ($title == $data_block['selectmod'] ? ' selected="selected"' : '') . '>' . $mod['custom_title'] . '</option>';
            }
        }

        $html .= '</select>';

        $html .= '
        <script type="text/javascript">
        $(\'[name="config_selectmod"]\').change(function() {
            var mod = $(this).val();
            var file_name = $("select[name=file_name]").val();
            var module_type = $("select[name=module_type]").val();
            var blok_file_name = "";
            if (file_name != "") {
                var arr_file = file_name.split("|");
                if (parseInt(arr_file[1]) == 1) {
                    blok_file_name = arr_file[0];
                }
            }
            if (mod != "") {
                $.get(script_name + "?" + nv_name_variable + "=" + nv_module_name + \'&\' + nv_lang_variable + "=" + nv_lang_data + "&" + nv_fc_variable + "=block_config&bid=" + bid + "&module=" + module_type + "&selectthemes=" + selectthemes + "&file_name=" + blok_file_name + "&loadajaxdata=" + mod + "&nocache=" + new Date().getTime(), function(theResponse) {
                    $("#block_config").append(theResponse);
                });
            }
        });
        $(function() {
            $(\'[name="config_selectmod"]\').change();
        });
        </script>
        ';

        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    function nv_block_config_news_thongbao_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['selectmod'] = $nv_Request->get_title('config_selectmod', 'post', '');
        $return['config']['catid'] = $nv_Request->get_typed_array('config_catid', 'int', 'post', array());
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 0);
        $return['config']['title_length'] = $nv_Request->get_int('config_title_length', 'post', 20);
        $return['config']['showtooltip'] = $nv_Request->get_int('config_showtooltip', 'post', 0);
        $return['config']['tooltip_position'] = $nv_Request->get_string('config_tooltip_position', 'post', 0);
        $return['config']['tooltip_length'] = $nv_Request->get_string('config_tooltip_length', 'post', 0);
        $return['config']['show_type'] = $nv_Request->get_int('config_show_type', 'post', 0);
        return $return;
    }

    function nv_block_news_thongbao($block_config)
    {
        global $site_mods;

        $block_config['module'] = $block_config['selectmod'];
        $module = $block_config['module'];

        if (isset($site_mods[$module])) {
            global $global_array_cat, $module_name, $db, $global_config, $nv_Cache, $module_config;

            $module_array_cat = array();
            $module_data = $site_mods[$module]['module_data'];
            $module_upload = $site_mods[$module]['module_upload'];
            $show_no_image = $module_config[$module]['show_no_image'];
            $blockwidth = $module_config[$module]['blockwidth'];

            if (empty($block_config['catid'])) {
                return '';
            }

            // Xác định danh sách chuyên mục
            if ($module_name == $module) {
                $module_array_cat = $global_array_cat;
            } else {
                $sql = 'SELECT catid, parentid, title, alias, viewcat, subcatid, numlinks, description, status, keywords, groups_view FROM  ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE status=1 OR status=2 ORDER BY sort ASC';
                $list = $nv_Cache->db($sql, 'catid', $module);
                if (!empty($list)) {
                    foreach ($list as $l) {
                        $module_array_cat[$l['catid']] = $l;
                        $module_array_cat[$l['catid']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
                    }
                }
            }

            if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.news_thongbao.tpl')) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.news_thongbao.tpl')) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = 'default';
            }

            include NV_ROOTDIR . '/themes/' . $block_theme . '/language/' . NV_LANG_INTERFACE . '.php';

            $xtpl = new XTemplate('global.news_thongbao.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
            $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
            $xtpl->assign('TEMPLATE', $block_theme);
            $xtpl->assign('LANG', $lang_module);

            foreach ($block_config['catid'] as $catid) {
                if (isset($module_array_cat[$catid])) {
                    $db->sqlreset()
                        ->select('id, catid, title, alias, homeimgfile, homeimgthumb, hometext, publtime, external_link')
                        ->from(NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_' . $catid)
                        ->where('status= 1')
                        ->order('publtime DESC')
                        ->limit($block_config['numrow']);

                    $list = $nv_Cache->db($db->sql(), '', $module);
                    if (!empty($list)) {
                        $xtpl->assign('CATINFO', $module_array_cat[$catid]);

                        foreach ($list as $l) {
                            $l['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $module_array_cat[$l['catid']]['alias'] . '/' . $l['alias'] . '-' . $l['id'] . $global_config['rewrite_exturl'];
                            if ($l['homeimgthumb'] == 1) {
                                $l['thumb'] = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $l['homeimgfile'];
                            } elseif ($l['homeimgthumb'] == 2) {
                                $l['thumb'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $l['homeimgfile'];
                            } elseif ($l['homeimgthumb'] == 3) {
                                $l['thumb'] = $l['homeimgfile'];
                            } elseif (!empty($show_no_image)) {
                                $l['thumb'] = NV_BASE_SITEURL . $show_no_image;
                            } else {
                                $l['thumb'] = '';
                            }

                            $l['blockwidth'] = $blockwidth;

                            $l['hometext_clean'] = strip_tags($l['hometext']);
                            $l['hometext_clean'] = nv_clean60($l['hometext_clean'], $block_config['tooltip_length'], true);

                            if (!$block_config['showtooltip']) {
                                $xtpl->assign('TITLE', 'title="' . $l['title'] . '"');
                            }

                            $l['title_clean'] = nv_clean60($l['title'], $block_config['title_length']);

                            if ($l['external_link']) {
                                $l['target_blank'] = 'target="_blank"';
                            }

                            $xtpl->assign('ROW', $l);
                            if (!empty($l['thumb'])) {
                                $xtpl->parse('main.loopcat' . $block_config['show_type'] . '.loop.img');
                            }
                            $xtpl->parse('main.loopcat' . $block_config['show_type'] . '.loop');
                        }
                        $xtpl->parse('main.loopcat' . $block_config['show_type']);
                    }
                }
            }

            if ($block_config['showtooltip']) {
                $xtpl->assign('TOOLTIP_POSITION', $block_config['tooltip_position']);
                $xtpl->parse('main.tooltip');
            }

            $xtpl->parse('main');
            return $xtpl->text('main');
        }
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_news_thongbao($block_config);
}
