<?php 
	$response = array('meta'=>$meta,'data'=>$educLevels);
	echo $this->Api->encodeData($response);
?>