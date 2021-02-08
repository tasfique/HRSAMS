<?php
	$filename =  basename($_GET["file"]);
	$filepath = 'files/' . $filename;
	if(!empty($filename) && file_exists($filepath)){
        header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");
		readfile($filepath);
		exit;
	}
	else{
		echo '<script>alert("There is no File to Download.")</script>';
		echo '<a href="javascript:history.go(-1)">CLICK HERE TO GO BACK...</a>';
	}
?>