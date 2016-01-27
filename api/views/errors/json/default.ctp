<?php
	header('HTTP/1.1 '.$code.' '.$message);
	$meta['message'] = $message;
	$response = array('meta'=>$meta);
	echo json_encode($response);
?>