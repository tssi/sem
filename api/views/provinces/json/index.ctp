<?php 
	$response = array('meta'=>$meta,'data'=>$provinces);
	echo $this->Api->encodeData($response);
?>