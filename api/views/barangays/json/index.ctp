<?php 
	$response = array('meta'=>$meta,'data'=>$barangays);
	echo $this->Api->encodeData($response);
?>