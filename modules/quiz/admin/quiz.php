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

$data = array(
	'question_id' => 0,
	'question' => '',
	);
 
for( $i = 0; $i < 4; ++$i )
{
	$data['title_' . $i] = '';
	$data['list_id_' . $i] = 0;
	$data['active_' . $i] = 0;
}

$error = array();

$data['question_id'] = $nv_Request->get_int( 'question_id', 'get,post', 0 );

if( $data['question_id'] > 0 )
{
	$data = $db->query( 'SELECT * FROM ' . TABLE_QUIZ_NAME . '_question WHERE question_id=' . $data['question_id'] )->fetch();

	$result = $db->query( 'SELECT * FROM ' . TABLE_QUIZ_NAME . '_list where question_id=' . $data['question_id'] . ' ORDER BY answer ASC ' );
	$a = 0;
	while( $row = $result->fetch() )
	{
		$rows[$a] = $row;
		++$a;
	}
	for( $i = 0; $i < 4; ++$i )
	{
		$data['title_' . $i] = $rows[$i]['title'];
		$data['list_id_' . $i] = $rows[$i]['list_id'];
		$data['active_' . $i] = $rows[$i]['active'];
	}
	$caption = $lang_module['question_edit'];

}
else
{
	$caption = $lang_module['question_add'];
}

if( $nv_Request->get_int( 'save', 'post' ) == 1 )
{

	$data['question_id'] = $nv_Request->get_int( 'question_id', 'post', 0 );
	$data['question'] = $nv_Request->get_string( 'question', 'post', '', 1 );
	$data['answer'] = $nv_Request->get_title( 'answer', 'post', '', 1 );
 
	for( $i = 0; $i < 4; ++$i )
	{
		$data['title_' . $i] = $nv_Request->get_title( 'title_' . $i, 'post', '', 1 );
		$data['list_id_' . $i] = $nv_Request->get_title( 'list_id_' . $i, 'post', '', 1 );
		$data['active_' . $i] = $nv_Request->get_title( 'active_' . $i, 'post', '', 1 );
 
	}
	
	if( empty( $data['question'] ) )
	{
		$error['question'] = $lang_module['question_error_question'];
	}

	if( ! empty( $error ) )
	{
		$error['warning'] = $lang_module['question_error_warning'];
	}
	if( empty( $error ) )
	{
 
		for( $i = 0; $i < 4; ++$i )
		{
			if( $i == toNum( $data['answer'] ) ) $data['active'] = 1;
			else  $data['active'] = 0;
 
		}
 
		if( $data['question_id'] == 0 )
		{

			$stmt = $db->prepare( 'INSERT INTO ' . TABLE_QUIZ_NAME . '_question SET question =:question' );
			$stmt->bindParam( ':question', $data['question'], PDO::PARAM_STR );
			$stmt->execute();
			if( $data['question_id'] = $db->lastInsertId() )
			{

				for( $i = 0; $i < 4; ++$i )
				{
					if( $i == toNum( $data['answer'] ) ) $data['active' . $i] = 1;
					else  $data['active' . $i] = 0;

					$data['answer_' . $i] = toAlpha( $i );
 
					if( $data['list_id_' . $i] == 0 )
					{
						$sth = $db->prepare( 'INSERT INTO ' . TABLE_QUIZ_NAME . '_list SET 
						question_id = ' . intval( $data['question_id'] ) . ', 
						active = ' . intval( $data['active' . $i] ) . ',
						answer = :answer, 
						title = :title' );
					}
					else
					{
						$sth = $db->prepare( 'UPDATE ' . TABLE_QUIZ_NAME . '_list SET 
						question_id=' . intval( $data['question_id'] ) . ', 
						active = ' . intval( $data['active' . $i] ) . ',
						answer = :answer, 
						title = :title WHERE list_id =' . $data['list_id_' . $i] );
					}

					$sth->bindParam( ':answer', $data['answer_' . $i], PDO::PARAM_STR );
					$sth->bindParam( ':title', $data['title_' . $i], PDO::PARAM_STR );
					if( ! $sth->execute() )
					{
						$error[] = $lang_module['error_answer_save'];
					}
					$sth->closeCursor();
				}

				$nv_Request->set_Session( $module_data . '_success', $lang_module['question_insert_success'] );
				nv_insert_logs( NV_LANG_DATA, $module_name, 'Add A question', 'question_id: ' . $data['question_id'], $admin_info['userid'] );
			}
			else
			{
				$error['warning'] = $lang_module['question_error_save'];
			}
			$stmt->closeCursor();
		}
		else
		{

			$stmt = $db->prepare( 'UPDATE ' . TABLE_QUIZ_NAME . '_question SET question =:question WHERE question_id=' . $data['question_id'] );
			$stmt->bindParam( ':question', $data['question'], PDO::PARAM_STR );
			if( $stmt->execute() )
			{

				for( $i = 0; $i < 4; ++$i )
				{
					if( $i == toNum( $data['answer'] ) ) $data['active' . $i] = 1;
					else  $data['active' . $i] = 0;
					
					$data['answer_' . $i] = toAlpha( $i );
					if( $data['list_id_' . $i] == 0 )
					{
						$sth = $db->prepare( 'INSERT INTO ' . TABLE_QUIZ_NAME . '_list SET 
						question_id = ' . intval( $data['question_id'] ) . ', 
						active = ' . intval( $data['active' . $i] ) . ',
						answer = :answer, 
						title = :title' );
					}
					else
					{
						$sth = $db->prepare( 'UPDATE ' . TABLE_QUIZ_NAME . '_list SET 
						question_id=' . intval( $data['question_id'] ) . ', 
						active = ' . intval( $data['active'] ) . ',
						answer = :answer, 
						title = :title WHERE list_id =' . $data['list_id_' . $i] );
					}

					$sth->bindParam( ':answer', $data['answer_' . $i], PDO::PARAM_STR );
					$sth->bindParam( ':title', $data['title_' . $i], PDO::PARAM_STR );
					if( ! $sth->execute() )
					{
						$error[] = $lang_module['error_answer_save'];
					}
					$sth->closeCursor();
				}
				$nv_Request->set_Session( $module_data . '_success', $lang_module['rows_update_success'] );
				nv_insert_logs( NV_LANG_DATA, $module_name, 'Edit A question', 'question_id: ' . $data['question_id'], $admin_info['userid'] );
			}
			else
			{
				$error['warning'] = $lang_module['question_error_save'];
			}
			$stmt->closeCursor();
		}

		if( empty( $error ) )
		{
			nv_del_moduleCache( $module_name );
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=listquiz' );
			die();
		}

	}

}

$xtpl = new XTemplate( "quiz.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'TEMPLATE', $global_config['site_theme'] );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'CAPTION', $caption );
$xtpl->assign( 'CANCEL', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
$xtpl->assign( 'TOKEN', md5( md5( $nv_Request->session_id ) . $global_config['sitekey'] ) );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'DATA', $data );
for( $i = 0; $i < 4; ++$i )
{
	if( $data['active_' . $i] == 1 ) $a = ' checked="checked"';
	else  $a = " ";
	$xtpl->assign( 'answer_' . $i, $a );
}
if( isset( $error['question'] ) )
{
	$xtpl->assign( 'error_question', $error['question'] );
	$xtpl->parse( 'main.error_question' );
}

if( isset( $error['warning'] ) && empty( $filter_keyword ) )
{
	$xtpl->assign( 'error_warning', $error['warning'] );
	$xtpl->parse( 'main.error_warning' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );
include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
