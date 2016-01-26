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
	var $components = array('RequestHandler','Session');
	var $helpers = array('Html','Form','Api');
	function beforeFilter() {
		if ($this->RequestHandler->ext === 'json'){
			$this->RequestHandler->setContent('json', 'application/json');
			//Configure::write('debug', 0);
			$endpoint = $this->RequestHandler->params['controller'];
			$__Class = Inflector::classify($endpoint);
			$Endpoint = &ClassRegistry::init($__Class);
			$conf = array();
			//Pagination config
			$page = isset($_GET['page'])?$_GET['page']:1;
			$limit = $conf['limit'] = isset($_GET['limit'])?$_GET['limit']:null;
			$recursive =  -1;
			$offset = $conf['offset'] = $page&&$limit?($page-1)*$limit:null;
			//Pagination count
			$count_conf = $conf;
			unset($count_conf['limit']);
			unset($count_conf['offset']);
			$count = $Endpoint->find('count',$count_conf);
			$last = $limit?ceil($count/$limit):1;
			$next = $page < $last ? $page + 1:null;
			$prev = $page>1?$page - 1:null;
			//Meta Data
			$meta = array();
			$page_url = null;
			$meta['title'] = $__Class;
			$meta['next'] = $next? $page_url.$next:null;
			$meta['prev'] = $prev? $page_url.$prev:null;
			$meta['last'] = $page_url.$last;
			$meta['items'] = $count;
			$meta['pages'] = $last;
			//Set up paginate
			$paginate = array();
			$paginate['page'] = $page;
			$paginate['cache'] = 'default';
			if($limit) $paginate['limit']=$limit;
			if($recursive) $paginate['recursive']=$recursive;
			$this->paginate = array($__Class => $paginate);
			$this->set(compact('meta'));
		}
		return parent::beforeFilter();
	}
}
