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
 
if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
 
//$page_title = $lang_module['rows'];

	
if( ACTION_METHOD == 'delete' )
{
	$info = array();

	$question_id = $nv_Request->get_int( 'question_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $global_config['sitekey'] . session_id() ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $global_config['sitekey'] . session_id() . $question_id ) )
	{
		$del_array = array( $question_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();

		$a = 0;
		foreach( $del_array as $question_id )
		{
			$sql='SELECT question_id FROM '. TABLE_QUIZ_NAME .'_question WHERE question_id=' . $question_id;
			$result = $db->query( $sql );
			list( $question_id ) = $result->fetch( 3 );
			if( $db->exec( 'DELETE FROM ' . TABLE_QUIZ_NAME . '_question WHERE question_id = ' . ( int )$question_id ) )
			{	
				 
				$db->exec( 'DELETE FROM ' . TABLE_QUIZ_NAME . '_list WHERE question_id = ' . ( int )$question_id );
 	
				$info['id'][$a] = $question_id;

				$_del_array[] = $question_id;

				++$a;
			}
		}

		$count = sizeof( $_del_array );

		if( $count )
		{
 
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_question', implode( ', ', $_del_array ), $admin_info['userid'] );

			nv_del_moduleCache( $module_name );

			$info['success'] = $lang_module['question_delete_success'];
		}
		 

	}
	else
	{
		$info['error'] = $lang_module['question_error_security'];
	}

	echo json_encode( $info );
	exit();

}
 
$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );
 
$data['question'] = $nv_Request->get_string( 'question', 'get', '' );
 
$sql = TABLE_QUIZ_NAME . '_question q INNER JOIN '. TABLE_QUIZ_NAME .'_list l ON (q.question_id = l.question_id) WHERE l.active = 1';

if( ! empty( $data['question'] ) )
{
	$sql .= " AND question LIKE '" . $db->dblikeescape( $data['question'] ) . "%'";
}

$num_items = $db->query('SELECT COUNT(*) FROM ' . $sql )->fetchColumn();

$sort = $nv_Request->get_string( 'sort', 'get', '' );

$order = $nv_Request->get_string( 'order', 'get' ) == 'asc' ? 'asc' : 'desc';

$sort_data = array( 'question' );

$order2 = ( $order == 'desc' ) ? 'asc' : 'desc';

if( isset( $sort ) && in_array( $sort, $sort_data ) )
{

	$sql .= ' ORDER BY ' . $sort;
}
else
{
	$sql .= ' ORDER BY q.question_id';
}

if( isset( $order ) && ( $order == 'desc' ) )
{
	$sql .= ' DESC';
}
else
{
	$sql .= ' ASC';
}

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '='. $op .'&amp;sort=' . $sort . '&amp;order=' . $order . '&amp;per_page=' . $per_page;
$result = $db->query( 'SELECT q.question_id, q.question, l.title, l.answer FROM ' . $sql . ' LIMIT ' . ( $page - 1 ) * $per_page.', '. $per_page );

$array = array();

while( $rows = $result->fetch() )
{
	$array[] = $rows;
}
 
$xtpl = new XTemplate( "listquiz.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'THEME', $global_config['site_theme'] );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'DATA', $data );
$xtpl->assign( 'TOKEN', md5( $global_config['sitekey'] . session_id() ) );
// $xtpl->assign( 'URL_SEARCH', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=quiz&amp;action=add' );
// $xtpl->assign( 'URL_TITLE', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=title&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
// $xtpl->assign( 'URL_LEV', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=lev&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
// $xtpl->assign( 'URL_DATE_ADDED', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=date_added&amp;order=' . $order2 . '&amp;per_page=' . $per_page );

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );

	$xtpl->parse( 'main.success' );

	$nv_Request->unset_request( $module_data . '_success', 'session' );

} 
 
if( ! empty( $array ) )
{
	$a = 1;
	foreach( $array as $item )
	{
		
		$item['class'] = ( $a % 2 ) ? 'class="second"' : ''; 
		
 		$item['token'] = md5( $global_config['sitekey'] . session_id() . $item['question_id'] );
		
		$item['edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=quiz&action=edit&token=' . $item['token'] . '&question_id=' . $item['question_id'];

		$xtpl->assign( 'LOOP', $item );
 

		$xtpl->parse( 'main.loop' );
		++$a;
	}

}

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );

if( ! empty( $generate_page ) )
{

	$xtpl->assign( 'GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';