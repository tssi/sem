<?php 
	$response = array('meta'=>$meta,'data'=>$cities);
	echo $this->Api->encodeData($response);
?>