<?php

class ApiComponent extends Object {
	function initialize(&$controller, $settings = array()) {
        // saving the controller reference for later use
        $this->controller =& $controller;
    }
   function startup(&$controller) {
	  if ($this->controller->params['url']['ext'] === 'json'){
		  switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
				$this->apiGet($this->controller);
			break;
			case 'POST':
				$this->apiPost($this->controller);
			break;
			case 'DELETE':
				$this->apiDelete($this->controller);
			break;
		  }
	  }
   }
	function beforeRender(&$controller) {
		$meta = $this->controller->Session->read('meta');
		$this->controller->set(compact('meta'));
	}
   protected function apiGet(&$controller){
		$endpoint = $this->controller->params['controller'];
		$__Class = Inflector::classify($endpoint);
		$Endpoint = &ClassRegistry::init($__Class);
		$conf = array();
		//Pagination config
		$page = isset($_GET['page'])?$_GET['page']:1;
		$limit = $conf['limit'] = isset($_GET['limit'])?$_GET['limit']:null;
		$recursive =  -1;
		$offset = $conf['offset'] = $page?($page-1)*$limit:null;
		//Sorting
		$sort = isset($_GET['sort'])?$_GET['sort']:null;
		$direction = null;
		if($sort){
			switch($sort){
				case 'latest':
					$direction = 'desc';
				break;
				case 'oldest':
					$direction = 'asc';
				break;
			}
			$sort = 'modified';
		}
		//Filter
		$conditions = array();
		$blacklist = array('url','page','limit','offset','sort','order','created','modified');
		foreach($_GET as $field=>$value){
			if(!in_array($field,$blacklist)){
				array_push($conditions,array($__Class.'.'.$field=>$value));
			}
		}
		$conf['conditions']=$conditions;
		//Meta Data
		$meta = array();
		$page_url = null;
		$meta['message'] = Inflector::humanize($endpoint);
		switch($this->controller->action){
			case 'index':
				//Pagination count
				$count_conf = $conf;
				unset($count_conf['limit']);
				unset($count_conf['offset']);
				$count = $Endpoint->find('count',$count_conf);
				$last = $limit&&$limit!='less'?ceil($count/$limit):1;
				$next = $page < $last ? $page + 1:null;
				$prev = $page>1?$page - 1:null;
				$meta['message'] = 'List of '. $meta['message'];
				$meta['next'] = $next? $page_url.$next:null;
				$meta['prev'] = $prev? $page_url.$prev:null;
				$meta['last'] = $page_url.$last;
				$meta['items'] = $count;
				$meta['pages'] = $last;
				//Set up paginate
				$paginate = array();
				$paginate['page'] = $page;
				$paginate['cache'] = 'default';
				if($recursive) $paginate['recursive']=$recursive;
				if($conditions) $paginate['conditions']=$conditions;
				if($sort&&$direction) $paginate['order']=array($__Class.'.'.$sort=>$direction);
				$paginate['limit']=$limit?$limit:$count;
				$this->controller->paginate = array($__Class => $paginate);
				$paginate['limit']=$count;
			break;
			case 'view':
				$meta['message'] ='View '.Inflector::singularize($meta['message']).' '.$this->controller->params['id'];
			break;
		}
		$meta['epoch'] = time();
		$this->controller->Session->write('meta',$meta);
   }
   protected function apiPost(&$controller){
	   $endpoint = $this->controller->params['controller'];
	   $__Class = Inflector::classify($endpoint);
	   $input = file_get_contents('php://input');
	   $data = array($__Class=>json_decode($input,true));
	   $this->controller->data = $data;
	   $meta = array();
	   $page_url = null;
	   $meta['message'] = $__Class;
	   $meta['epoch'] = time();
	   $this->controller->Session->write('meta',$meta);
   }
    protected function apiDelete(&$controller){
	   $endpoint = $this->controller->params['controller'];
	   $__Class = Inflector::classify($endpoint);
	   $meta = array();
	   $page_url = null;
	   $meta['message'] = $__Class;
	   $meta['epoch'] = time();
	   $this->controller->Session->write('meta',$meta);
   }
 }

?>