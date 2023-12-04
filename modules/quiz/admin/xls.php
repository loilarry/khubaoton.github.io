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

$save = $nv_Request->get_int( 'save', 'get,post', 0 );

if( $save == 1 )
{

		$sql = "SELECT SQL_CALC_FOUND_ROWS t1.*, t2.tendonvi
		FROM " . NV_PREFIXLANG . "_" . $module_data . "_info  as t1 
		INNER JOIN " . NV_PREFIXLANG . "_" . $module_data . "_donvi as t2
		ON t1.khoa=t2.dvid 
		ORDER BY t1.ketqua DESC, ABS( ( SELECT COUNT(*) FROM " . NV_PREFIXLANG . "_" . $module_data . "_info) - t1.dudoan ) ASC LIMIT 0 , 200";

		$result = $db->query( $sql );

		$i = 1;
		while ( $row = $result->fetch() )
		{
			if(($row['endtime'] - $row['begintime'])< 60)
			$row['thoigian'] =  $row['endtime'] - $row['begintime'].' giây';
			else
			{
				$phut = (int)(($row['endtime']-$row['begintime'])/60);
				$giay = ($row['endtime']-$row['begintime'])%60;
				$row['thoigian'] =  $phut.' phút '.$giay.' giây';
			}
			$array[] = array(
				"stt" => ++$i,
				"hoten" => nv_unhtmlspecialchars( $row['hoten']),
				"lop" => nv_unhtmlspecialchars( $row['lop']),
				"khoa" => nv_unhtmlspecialchars( $row['tendonvi'] ),
				"dienthoai" => nv_unhtmlspecialchars( $row['dienthoai'] ),
				"diachi" => nv_unhtmlspecialchars( $row['diachi'] ),
				"dudoan" => nv_unhtmlspecialchars( $row['dudoan'] ),
				"ketqua" => nv_unhtmlspecialchars( $row['ketqua']."/".$config['per_page'] ),
				"thoigian" => nv_unhtmlspecialchars( $row['thoigian'] ),
				
			);
		}
		
		/** Include PHPExcel */
		require_once (NV_ROOTDIR . "/includes/excel/PHPExcel.php");

		$Excel_Cell_Begin = 2; // Dong bat dau viet du lieu
		
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load(NV_ROOTDIR."/modules/".$module_file."/template_excel/danh_sach_tham_du.xlsx");

		$objWorksheet = $objPHPExcel->getActiveSheet();

		$page_title  ="DANH SÁCH THÍ SINH THAM DỰ CUỘC THI TÌM HIỂU 55 NĂM TRƯỜNG ĐẠI HỌC CÔNG NGHIỆP QUẢNG NINH";
		$objWorksheet->setTitle('danh_sach_tham_du');

		// Set page orientation and size
		$objWorksheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objWorksheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$objWorksheet->getPageSetup()->setHorizontalCentered(true);

		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, $Excel_Cell_Begin);

		// Tieu de
		$array_title = array( 'stt', 'hoten', 'lop', 'khoa', 'dienthoai', 'diachi', 'dudoan', 'ketqua' , 'thoigian' );

		$columnIndex = 0;
		foreach ($array_title as $key_lang)
		{
			$TextColumnIndex = PHPExcel_Cell::stringFromColumnIndex($columnIndex);
			$objWorksheet->getColumnDimension($TextColumnIndex)->setAutoSize(true);
			$objWorksheet->setCellValue($TextColumnIndex . $Excel_Cell_Begin, $lang_module[$key_lang]);
			$columnIndex++;
		}
		
		
	
		// Du lieu
		$array_key_data = array( 'stt', 'hoten', 'lop', 'khoa', 'dienthoai', 'diachi', 'dudoan', 'ketqua' , 'thoigian' );

		$pRow = $Excel_Cell_Begin;
		foreach ($array as $row)
		{
			$pRow++;
			$columnIndex = 0;

			foreach ($array_key_data as $key_data)
			{
				
				$TextColumnIndex = PHPExcel_Cell::stringFromColumnIndex($columnIndex);
				$objWorksheet->setCellValue($TextColumnIndex . $pRow, $row[$key_data]);
				$columnIndex++;
			}
		}

		$highestRow = $objWorksheet->getHighestRow(); // Tinh so dong du lieu
		$highestColumn = $objWorksheet->getHighestColumn(); // Tinh so cot du lieu

		//$objWorksheet->mergeCells('A1:' . $highestColumn . '1');
		$objWorksheet->setCellValue('A1', $page_title);
		//$objWorksheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$objWorksheet->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//$styleArray = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => 'FF000000'))));

		//$objWorksheet->getStyle('A' . $Excel_Cell_Begin . ':' . $highestColumn . $highestRow)->applyFromArray($styleArray); // Tao duong bao

		
		//Redirect output to a client's web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="danh_sach_tham_du.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit ;

}