<?php
/**
 * Routes Configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect(
			"/student_registration_form",
			array("controller"=>"reports","action"=>"student_registration_form")
	);
	Router::connect(
			"/info_sheet",
			array("controller"=>"reports","action"=>"student_inquiry_information_sheet")
	);
	Router::connect(
			"/enrollment_stats",
			array("controller"=>"reports","action"=>"enrollment")
	);
	App::import('Lib', 'Api.SlugRoute');
	//Custom API Routing
	Configure::write('Api.MASTER_ROUTES','educ_levels|system_defaults|modules');
	App::import('Vendor', 'Api.routes');
	
	
	Router::connect(
			"/reports/:action",
			array("controller"=>"reports", "[method]" => "POST")
	);

	Router::connect(
			"/reports/reg_form",
			array("controller"=>"reports", "[method]" => "GET", "action"=>"reg_form")
	);
	
	
	App::import('Lib', 'Api.SlugRoute');
	//Custom API Routing
	Configure::write('Api.MASTER_ROUTES','educ_levels|system_defaults|modules');
	App::import('Vendor', 'Api.routes');
