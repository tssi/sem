<?php
class ApiHelper extends AppHelper {
  public function encodeData($data) {
	  $endpoint = $this->params['controller'];
	  $__Class = Inflector::classify($endpoint);
	  $__data = array();
	  foreach($data['data'] as $key=>$value){
		  array_push($__data,$value[$__Class]);
	  }
	  $data['data']=$__data;
    return json_encode($data);
  }
}
?>