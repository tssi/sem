<?php
class AppError extends ErrorHandler {
	function invalidEndpoint($params){
		$code ='403';
		$message = sprintf('Invalid Endpoint');
		$this->fetchError($code,$message);
	}
	function dataNotSet($params){
		$code ='402';
		$message = sprintf('Data not set');
		$this->fetchError($code,$message);
	}
	function emptyRecord($params){
		$code ='404';
		$message = sprintf('Empty Record Found');
		$this->fetchError($code,$message);
	}
	function noResults($params){
		$code ='404';
		$message = sprintf('No results found for "'.$params['keyword'].'".');
		$this->fetchError($code,$message);
	}
	protected function fetchError($code,$message){
		$this->controller->set(compact('code','message'));
		$this->controller->layout='json/default';
		$this->_outputMessage('json/default');
	}
	
}
?>