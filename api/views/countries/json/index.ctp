<?php 
	$response = array('meta'=>$meta,'data'=>$countries);
	echo $this->Api->encodeData($response);
?>