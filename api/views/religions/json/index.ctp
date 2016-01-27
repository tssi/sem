<?php 
	$response = array('meta'=>$meta,'data'=>$religions);
	echo $this->Api->encodeData($response);
?>