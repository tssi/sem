<?php 
	$response = array('meta'=>$meta,'data'=>$yearLevels);
	echo $this->Api->encodeData($response);
?>