<?php
class AppError extends ErrorHandler {
	function emptyRecord($params){
		$code ='404';
		$message = sprintf('Empty Record Found');
		$this->fetchError($code,$message);
	}
	protected function fetchError($code,$message){
		$this->controller->set(compact('id','code','message'));
		$this->controller->layout='json/default';
		$this->_outputMessage('json/default');
	}
	
}
?>