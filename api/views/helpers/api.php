<?php
class ApiHelper extends AppHelper {
  public function encodeData($data) {
	  $endpoint = $this->params['controller'];
	  $__Class = Inflector::classify($endpoint);
	  $__data = array();
	  if($this->params['paging'][$__Class]['options']['recursive']==-1){
		  foreach($data['data'] as $key=>$value){
			  unset($value[$__Class]['created']);
			  unset($value[$__Class]['modified']);
			  unset($value[$__Class]['order']);
			  array_push($__data,$value[$__Class]);
		  }
	  }
	  $data['data']=$__data;
    return json_encode($data);
  }
}
?>