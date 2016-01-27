<?php 
	$response = array('meta'=>$meta,'data'=>$citizenships);
	echo $this->Api->encodeData($response);
?>