<?php 
include "php-excel/php-excel.class.php";
include "function.php";

//create temporary folder for multiple file
create_folder('temp_folder');

//create example multiple file excel
create_excel('file 1');
create_excel('file 2');
create_excel('file 3');
create_excel('file 4');
create_excel('file 5'); 

//create file zip from folder
create_zip('temp_folder');

function create_zip($resource){
	$zip_name = 'multiple-download.zip';
	$zip  	  = new ZipArchive;
	if ($zip->open($zip_name, ZipArchive::CREATE) === TRUE)
	{ 
		$dir = scandir($resource);
		unset($dir[0]);
		unset($dir[1]); 
		foreach ($dir as $filename) { 
				$zip->addFile($resource.'/'.$filename, $filename); 
		} 
	    $zip->close(); 
	}
	force_dowload($zip_name);

	//Delete all temporary file
	delete_files($zip_name);
	delete_files($resource);
}

function create_excel($file_name)
{
	$xls 	= new Excel_XML;
	$data   = array(); 
	$data[] = array('NO','NAME');
	$data[] = array('1','BUDI');
	$data[] = array('2','ANI');


	$xls->addWorksheet('ALL NAME', $data);
	$xls->writeWorkbook($file_name.'.xls','temp_folder/'); 
}
?>