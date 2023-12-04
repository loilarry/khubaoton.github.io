<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2021 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 17 Jun 2021 00:32:33 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$array_except_flood_site = [];
$array_except_flood_site['127.0.0.1'] = ['ip6' => 0, 'mask' => "//", 'begintime' => 1588734706, 'endtime' => 0];
$array_except_flood_site['::1'] = ['ip6' => 1, 'mask' => "::1/0", 'begintime' => 1623889953, 'endtime' => 0];

$array_except_flood_admin = [];
