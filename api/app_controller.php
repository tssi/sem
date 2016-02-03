<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $components = array('RequestHandler','Session','Api');
	var $helpers = array('Html','Form','Session');
	function redirect($config){
		if($this->RequestHandler->isAjax()){
			$message = $this->Session->read('Message.flash.message');
			if($message) $this->Session->write('meta.message',$message);
			$this->beforeRender();
		}else{
			return parent::redirect($config);
		}
	}
	function beforeRender(){
		if($this->RequestHandler->isAjax()||$this->RequestHandler->ext=='json'){
			header('Content-Type: application/json');
			$meta = $this->Session->read('meta');
			$meta['code'] = '200';
			$response = array('meta'=>$meta);
			if($this->params['action']=='index'||$this->params['action']=='view'){
				$endpoint = $this->params['controller'];
				if($this->params['action']=='view'){
					$endpoint =  Inflector::singularize($endpoint);
				}
				$dataField = Inflector::variable($endpoint);
				if(isset($this->viewVars[$dataField])){
					$response['data'] = $this->viewVars[$dataField];
				}else{
					return $this->cakeError('emptyRecord',array('id'=>null));
				}
			}else if($this->params['action']=='add'||$this->params['action']=='edit'){
				$modelClass = $this->modelClass;
				$this->data[$modelClass]['id'] = $this->$modelClass->id;
				$response['data'] = $this->data;
			}
			echo $this->encodeData($response);
			$this->_stop();
		}else{
			return parent::beforeRender();
		}
	}
	protected function encodeData($response) {
	  if(isset($response['data'])){
		  $endpoint = $this->params['controller'];
		  $__Class = Inflector::classify($endpoint);
		  $__data = array();
		  if($this->action=='index'){
			  foreach($response['data'] as $key=>$value){
				  array_push($__data,$value[$__Class]);
			  }
		  }else{
			  $__data = $response['data'][$__Class];
		  }
		  $response['data']=$__data;
		  if($response['data']==null)
			return $this->cakeError('emptyRecord',array('id'=>null));
	 }
	 return json_encode($response);
  }
}
