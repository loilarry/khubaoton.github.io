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

$json = array();

if( $nv_Request->isset_request( 'load', 'get,post' ) )
{
	$xtpl = new XTemplate( "load_de.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE', $module_file );
	$info_id = 0;
	$token = $nv_Request->get_string( 'token', 'get,post', '' );
	if( $quiz_config['time_test'] <= NV_CURRENTTIME )
	{
		if( $quiz_config['time_out'] > NV_CURRENTTIME )
		{
			if( $token == md5( $global_config['sitekey'] . $client_info['session_id'] ) )
			{
				$full_name = $nv_Request->get_title( 'full_name', 'get,post', '' );
				$email = $nv_Request->get_title( 'email', 'get,post', '' );
				$birthday = $nv_Request->get_title( 'birthday', 'get,post', '' );
				$address = $nv_Request->get_title( 'address', 'get,post', '' );
				$telephone = $nv_Request->get_title( 'telephone', 'get,post', '' );
				$work_unit = $nv_Request->get_title( 'work_unit', 'get,post', '' );
				
				$alias = strtolower( change_alias( $full_name ) );
								
				if( $full_name != "" )
				{
 
					$numbermax = $db->query( 'SELECT COUNT(*) FROM ' . TABLE_QUIZ_NAME . '_info WHERE alias='. $db->quote( $alias ) .' AND telephone ='. $db->quote( $telephone ) )->fetchColumn();
					
					//file_put_contents( NV_ROOTDIR . '/logs/numbermax.log', '.$sql." \r\n", FILE_APPEND );
					if( $numbermax < 6 )
					{
						$stmt = $db->prepare( 'INSERT INTO '. TABLE_QUIZ_NAME .'_info SET
							full_name=:full_name,
							alias=:alias,
							birthday=:birthday,
							email=:email,
							telephone=:telephone,
							address=:address,
							work_unit=:work_unit,
							outcome=0,
							begintime='. NV_CURRENTTIME .',
							endtime='. NV_CURRENTTIME .',
							session = :session' ); 
						$stmt->bindParam( ':full_name', $full_name, PDO::PARAM_STR );
						$stmt->bindParam( ':alias', $alias, PDO::PARAM_STR );
						$stmt->bindParam( ':birthday', $birthday, PDO::PARAM_STR );
						$stmt->bindParam( ':email', $email, PDO::PARAM_STR );
						$stmt->bindParam( ':telephone', $telephone, PDO::PARAM_STR );
						$stmt->bindParam( ':address', $address, PDO::PARAM_STR );
						$stmt->bindParam( ':work_unit', $work_unit, PDO::PARAM_STR );
						$stmt->bindParam( ':session', $nv_Request->session_id, PDO::PARAM_STR );
						$stmt->execute();
						if( $info_id = $db->lastInsertId() )
						{
  
							$json['success'] = 'Khởi tạo thí sinh thành công';
						}
						else
						{
							$json['error'] = 'Lỗi: Không lưu được thông tin vui lòng liên hệ ban quản trị về vấn đề này';

						}
					}
					else
					{
						$json['error'] = 'Theo thể lệ của cuộc thi, bạn chỉ được tham gia thi tối đa 5 lần (Thể lệ cuộc thi <a href="http://qui.edu.vn/timhieu55nam.html#first">bấm vào đây</a>)';
					}
				}
				else
				{
					$json['error'] = 'Lỗi: Họ tên không đưượ để trống';
				}
			}
			else
			{
				$json['error'] = 'Lỗi Bạn đang sử dụng một phầm mềm trái phép nào đó';

			}
		}
		else
		{
			$time_out = nv_date( 'd-m-Y h:i:s A', $quiz_config['time_out'] );
			$json['error'] = 'Thời gian gửi bài dự thi đã kết thúc lúc ' . $time_out;

		}
	}
	else
	{
		$time_test = nv_date( 'd-m-Y h:i:s A', $quiz_config['time_test'] );
		$json['error'] = 'Thời gian gửi bài dự thi bắt đầu vào ngày ' . $time_test ;

	}

	 

	if( isset( $json['success'] ) )
	{
 
		$list = array();

		
		$numq = $db->query( 'SELECT COUNT(*) FROM '. TABLE_QUIZ_NAME .'_question LIMIT 0, ' . $quiz_config['per_page'] )->fetchColumn();
		
		$query = $db->query( 'SELECT * FROM '. TABLE_QUIZ_NAME .'_question ORDER BY RAND() LIMIT 0, ' . $quiz_config['per_page'] );
		
		$a = 0;
		$count = 0;
		while( $row = $query->fetch() )
		{
			++$a;
			$list[$a] = $row;
			++$count;
		}

		foreach( $list as $i => $l )
		{
			$sql = 'SELECT list_id, question_id, answer, title, active FROM '. TABLE_QUIZ_NAME .'_list WHERE question_id=' . $l['question_id'] . ' ORDER BY RAND()';
			$result = $db->query( $sql );
			$array_content = array();
			while( list( $list_id, $question_id, $answer, $title, $active ) = $result->fetch( 3 ) )
			{
				$array_content[] = array(
					'list_id' => $list_id,
					'question_id' => $question_id,
					'answer' => $answer,
					'title' => $title,
					'active' => $active );
			}
			$list[$i]['content'] = $array_content;
		}

		$xtpl->assign( 'NUMQ', $count );
		$xtpl->assign( 'INFO_ID', $info_id );
		$xtpl->assign( 'TITLE', $quiz_config['title'] );
		$xtpl->assign( 'CAUPHU', $quiz_config['cauphu'] );

		if( ! empty( $list ) )
		{
			$a = 1;
			foreach( $list as $i => $question )
			{

				$xtpl->assign( 'QUESTION', $question );
				$xtpl->assign( 'STT', $a );
				$question = $question['content'];
				if( ! empty( $question ) )
				{
					$t = 0;
					foreach( $question as $q )
					{
						$q['t'] = $t;
						if( $t == 0 ) $q['v'] = 'a';
						elseif( $t == 1 ) $q['v'] = 'b';
						elseif( $t == 2 ) $q['v'] = 'c';
						elseif( $t == 3 ) $q['v'] = 'd';
						elseif( $t == 4 ) $q['v'] = 'e';

						$xtpl->assign( 'Q', $q );
						$xtpl->parse( 'main.info.loopq.list' );
						++$t;
					}
				}
				$xtpl->parse( 'main.info.loopq' );
				++$a;
			}
		}

		$xtpl->parse( 'main.info' );
	}
	else
	{

		$xtpl->assign( 'content', $tem[1] );
		$xtpl->parse( 'main.noneinfo' );
	}
	$xtpl->parse( 'main' );
	$json['content'] = $xtpl->text( 'main' );
	header( 'Content-Type: application/json' );
	echo json_encode( $json );
	exit();

}

if( $nv_Request->isset_request( 'show', 'get,post' ) )
{

	$info_id = $nv_Request->get_int( 'info_id', 'get,post', 0 );

	list( $number, $begintime, $endtime ) = $db->query( 'SELECT outcome, begintime, endtime FROM ' . TABLE_QUIZ_NAME . '_info WHERE info_id=' . intval( $info_id ) )->fetch( 3 );

	$sqlv = 'SELECT t1.question_id, t1.answer dapan, t2.question 
	FROM  ' . TABLE_QUIZ_NAME . '_person t1 
	INNER JOIN ' . TABLE_QUIZ_NAME . '_question t2 ON t1.question_id=t2.question_id 
	WHERE t1.info_id=' . intval( $info_id ) . ' 
	ORDER BY t1.person_id ASC';
	
	$query = $db->query( $sqlv );

	$list = array();
	$a = 0;
	$count = 0;
	while( $row = $query->fetch() )
	{
		++$a;
		$list[$a] = $row;
		++$count;

	}
	$dapandung = 0;
	//foreach( $list as $i => $l )
	//{

		foreach( $list as $i => $l )
		{

			$sql = 'SELECT list_id, question_id, answer, title, active FROM ' . TABLE_QUIZ_NAME . '_list where question_id=' . $l['question_id'] . ' ORDER BY answer ASC';
			$result = $db->query( $sql );
			$array_content = array();
			while( list( $list_id, $question_id, $answer, $title, $active ) = $result->fetch( 3 ) )
			{
				if( $l['dapan'] == $answer and $active == 1 )
				{
					++$dapandung;
				}
				$array_content[] = array(
					'list_id' => $list_id,
					'question_id' => $question_id,
					'answer' => $answer,
					'dapan' => $l['dapan'],
					'title' => $title,
					'active' => $active );
			}
			$list[$i]['content'] = $array_content;
		}

	//}

	$xtpl = new XTemplate( "dapan.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE', $module_file );
	$xtpl->assign( 'COUNT', $count );
	$xtpl->assign( 'DAPANDUNG', $number );
	$xtpl->assign( 'TITLE', $quiz_config['title'] );

	if( ( $endtime - $begintime ) < 60 ) $xtpl->assign( 'TIME', $endtime - $begintime . ' giây' );
	else
	{
		$phut = ( int )( ( $endtime - $begintime ) / 60 );
		$giay = ( $endtime - $begintime ) % 60;
		$xtpl->assign( 'TIME', $phut . 'phút ' . $giay . ' giây' );
	}
	if( ! empty( $list ) )
	{
		$a = 1;
		foreach( $list as $i => $question )
		{

			$xtpl->assign( 'QUESTION', $question );
			$xtpl->assign( 'STT', $a );
			$ques = $question['content'];
			if( ! empty( $ques ) )
			{

				$t = 0;
				foreach( $ques as $q )
				{
					if( $q['active'] == 1 )
					{
						$q['icon'] = "d.jpg";
						$q['color'] = 'style="color:#08d61c;font-weight:bold"';
					}
					elseif( $q['active'] != 1 and $question['dapan'] == $q['answer'] )
					{
						$q['icon'] = "checked.png";

					}
					elseif( $q['active'] != 1 and $question['dapan'] != $q['answer'] )
					{
						$q['icon'] = "uncheck.png";
					}

					if( $question['dapan'] == $q['answer'] and $q['active'] != 1 )
					{
						$q['throught'] = 'class="throught"';
					}
					else
					{
						$q['throught'] = "";
					}
					$q['t'] = $t;
					$xtpl->assign( 'Q', $q );
					$xtpl->parse( 'main.loopq.list' );
					++$t;
				}
			}
			$xtpl->parse( 'main.loopq' );
			++$a;
		}
	}
	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );
	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';

}

if( $nv_Request->isset_request( 'do', 'get,post' ) )
{
 
	$token = $nv_Request->get_string( 'token', 'post', '' );
	if( $quiz_config['time_test'] <= NV_CURRENTTIME )
	{
		if( $quiz_config['time_out'] > NV_CURRENTTIME )
		{
			if( $token == md5( $global_config['sitekey'] . $client_info['session_id'] ) )
			{
				$full_name = $nv_Request->get_title( 'full_name', 'post', '' );
				$email = $nv_Request->get_title( 'email', 'post', '' );
				$birthday = $nv_Request->get_title( 'birthday', 'post', '' );
				$address = $nv_Request->get_title( 'address', 'post', '' );
				$telephone = $nv_Request->get_title( 'telephone', 'post', '' );
				$work_unit = $nv_Request->get_title( 'work_unit', 'post', '' );
				$numq = $nv_Request->get_int( 'numq', 'post', 0 );
				$info_id = $nv_Request->get_int( 'info_id', 'post', 0 );
 
				if( $numq > 0 )
				{
					$endtime = NV_CURRENTTIME - 1;
					$stmt = $db->prepare( 'UPDATE '. TABLE_QUIZ_NAME .'_info SET
							full_name=:full_name,
							alias=:alias,
							birthday=:birthday,
							email=:email,
							telephone=:telephone,
							address=:address,
							work_unit=:work_unit,
							endtime='. intval( $endtime ) .' WHERE info_id=' . intval( $info_id ) . ' AND session=:session' ); 
					$stmt->bindParam( ':full_name', $full_name, PDO::PARAM_STR );
					$stmt->bindParam( ':alias', $alias, PDO::PARAM_STR );
					$stmt->bindParam( ':birthday', $birthday, PDO::PARAM_STR );
					$stmt->bindParam( ':email', $email, PDO::PARAM_STR );
					$stmt->bindParam( ':telephone', $telephone, PDO::PARAM_STR );
					$stmt->bindParam( ':address', $address, PDO::PARAM_STR );
					$stmt->bindParam( ':work_unit', $work_unit, PDO::PARAM_STR );
					$stmt->bindParam( ':session', $nv_Request->session_id, PDO::PARAM_STR );
 
					if( $stmt->execute() )
					{
						$stmt->closeCursor();
						$stmt = null;
						
						
						$dem = 0;
						for( $i = 1; $i <= $numq; ++$i )
						{
							$question_id = $nv_Request->get_int( 'question_id_' . $i, 'post', 0 );
							$dapan = $nv_Request->get_string( 'Cau' . $i, 'post', 0 );

							$sqlv = 'SELECT answer FROM ' . TABLE_QUIZ_NAME . '_list WHERE question_id=' . $question_id . ' AND active=1';
							$result = $db->query( $sqlv );
							$answer = $result->fetchColumn();
							
							$stmt = $db->prepare( 'INSERT INTO ' . TABLE_QUIZ_NAME . '_person SET 
							info_id = '. $info_id .',
							question_id = '. $question_id .',
							answer =:answer');
							$stmt->bindParam( ':answer', $dapan, PDO::PARAM_STR );
							if( $stmt->execute() )
							{
								if( $dapan == $answer )
								{
									$dem = $dem + 1;
								}
							}
							$stmt->closeCursor();
							$stmt = null;
						}
						
						$db->query( 'UPDATE ' . TABLE_QUIZ_NAME . '_info SET outcome=' . intval( $dem ) . ' WHERE info_id =' . $info_id );

						 
						$cauphu = $nv_Request->get_string( 'cauphu', 'post', '' );
							
						$stmt = $db->prepare( 'INSERT INTO ' . TABLE_QUIZ_NAME . '_sublist SET 
							info_id = '. $info_id .',
							question = 0,
							answer =:answer');
							
						$stmt->bindParam( ':answer', $cauphu, PDO::PARAM_STR );
						$stmt->execute();
 
						$contents = "OK[NV4]" . $info_id ;
					}
					else
					{
 
						$contents = "ERR[NV4]Lỗi: Không lưu được thông tin hoặc thông tin đăng ký không hợp lệ vui lòng liên hệ ban quản trị về vấn đề này";
					}
				}
				else
				{
					$contents = "ERR[NV4]Lỗi không tồn tại câu hỏi nào";
				}
			}
			else
			{
				$contents = "ERR[NV4]Lỗi Bạn đang sử dụng một phầm mềm trái phép nào đó";
			}
		}
		else
		{
			$time_out = nv_date( 'd-m-Y h:i:s A', $quiz_config['time_out'] );
			$contents = "ERR[NV4]Thời gian gửi bài dự thi đã kết thúc lúc " . $time_out . "";
		}
	}
	else
	{
		$time_test = nv_date( 'd-m-Y h:i:s A', $quiz_config['time_test'] );
		$contents = "ERR[NV4]Thời gian gửi bài dự thi bắt đầu vào ngày " . $time_test . "";
	}
	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
}
