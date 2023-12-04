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

if( ! defined( 'NV_IS_MOD_QUIZ' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

// $list_question = array();

// $numq = $db->query( 'SELECT COUNT(*) FROM ' . TABLE_QUIZ_NAME . '_question LIMIT 0, ' . $quiz_config['per_page'] )->fetchColumn();

// $result = $db->query( 'SELECT * FROM ' . TABLE_QUIZ_NAME . '_question ORDER BY RAND() ASC LIMIT 0, ' . $quiz_config['per_page'] );
// $a = 0;
// $count = 0;
// while( $row = $result->fetch() )
// {
	// ++$a;
	// $list_question[$a] = $row;
	// ++$count;
// }
// $list = array();
// foreach( $list_question as $i => $l )
// {
	// $sql = 'SELECT list_id, question_id, answer, title, active FROM ' . TABLE_QUIZ_NAME . '_list where question_id=' . $l['question_id'] . ' ORDER BY answer ASC';
	// $result = $db->query( $sql );
	// $array_content = array();
	// while( list( $list_id, $question_id, $answer, $title, $active ) = $result->fetch( 3 ) )
	// {
		// $array_content[] = array(
			// 'list_id' => $list_id,
			// 'question_id' => $question_id,
			// 'answer' => $answer,
			// 'title' => $title,
			// 'active' => $active );
	// }
	// $list[$i]['content'] = $array_content;
// }

if( ! defined( 'SHADOWBOX' ) )
{
	$my_head .= '<link type=\'text/css\' rel=\'Stylesheet\' href=\'' . NV_BASE_SITEURL . 'js/shadowbox/shadowbox.css\' />';
	$my_head .= '<script type=\'text/javascript\' src=\'' . NV_BASE_SITEURL . 'js/shadowbox/shadowbox.js\'></script>';
	$my_head .= '<script type=\'text/javascript\'>Shadowbox.init({ handleOversize: \'drag\',onClose: function(){ window.location.reload(); } });</script>';
	define( 'SHADOWBOX', true );
}
$xtpl = new XTemplate( 'main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'TEMPLATE', $module_info['template'] );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'PROCESS', NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=process' );
$xtpl->assign( 'TOKEN', md5( $global_config['sitekey'] . $client_info['session_id'] ) );
//$xtpl->assign( 'NUMQ', $count );
$xtpl->assign( 'SESSION', session_id() );

// $data = array();
// $data['full_name'] = $nv_Request->get_title( 'full_name', 'post', '', 1 );
// $data['birthday'] = $nv_Request->get_title( 'birthday', 'post', '', 1 );
// $data['email'] = $nv_Request->get_title( 'email', 'post', '' );
// $data['telephone'] = $nv_Request->get_title( 'telephone', 'post', '', 1 );
// $data['address'] = $nv_Request->get_title( 'address', 'post', '', 1 );
// $data['work_unit'] = $nv_Request->get_title( 'work_unit', 'post', '', 1 );

$info = '';
$content_file = NV_ROOTDIR . '/' . NV_DATADIR . '/' . NV_LANG_DATA . '_' . $module_data . '_info.txt';
if( file_exists( $content_file ) )
{
	$info = file_get_contents( $content_file );
	//$info = nv_editor_br2nl( $info );
}

// if( ! empty( $list ) )
// {
	// $a = 1;
	// foreach( $list as $i => $question )
	// {

		// $xtpl->assign( 'QUESTION', $question );
		// $xtpl->assign( 'STT', $a );
		// $question = $question['content'];
		// if( ! empty( $question ) )
		// {
			// $t = 0;
			// foreach( $question as $q )
			// {
				// $q['t'] = $t;
				// $xtpl->assign( 'Q', $q );
				// $xtpl->parse( 'main.loopq.list' );
				// ++$t;
			// }
		// }
		// $xtpl->parse( 'main.loopq' );
		// ++$a;
	// }
// }

$xtpl->assign( 'info', $info );
$xtpl->parse( 'main' );
$contents .= $xtpl->text( 'main' );
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
