
<?php 
/* **************************************************************************************************************************************************
 * 
 *  Copyright (C) 2014 by Kristof Houwen, Belgium.
 *  All rights reserved.
 *
 *  Licensed under the European Union Public Licence (EUPL), Version 1.1 (the "License"); you may not use this file except in compliance
 *  with the License. You may obtain a copy of the License at
 *
 *	http://joinup.ec.europa.eu/software/page/eupl/licence-eupl
 *
 *  THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 *  MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 *  WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 *  OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 *  Author:		Kristof Houwen
 *  Company:    
 *  E-mail:		khouwen@gmail.com
 *  Url:		
 * 
 *  Project:    Konstruo
 *  Version:	0.5           
 *
 * *****************************************************************************************************************************************************/

require_once('Autoloader.php');

class App {
	private $_controllerName;
	private $_actionName;
	private $_routes;		// array of StsRoute objects
	//private $_params = array();
	private $_registry = null;  // used to hold 'global' vars

	public function __construct()
	{
		ob_start();
		session_start();

		/* security see http://phpsec.org/projects/guide/4.html  */
		if (!isset($_SESSION['initiated']))
		{
			session_regenerate_id();
			$_SESSION['initiated'] = true;
		}
	}

	// read the config.ini file(s)
	public function init() 
	{
		//$this->loadInterfaces();
		$this->readConfig();
		spl_autoload_register(array('Autoloader', 'load_class'));
		
		//$this->readRoutes();
	}

	// start the webapp (call router, create controller, call action, render view)	
	public function start() 
	{
		// testen van de router
		$router = new Router($this->_registry);
		$router->processUri();
		$reflect  = new ReflectionClass($router->get_controller());			
		$instance = $reflect->newInstanceArgs();
		$instance->set_registry($this->_registry);
		// do we need te be authenticated?
		if ($instance->get_isProtected()) {
			if (!$this->securityCheck()) {
				// we need to redirect and show login screen
				$login = new LoginController();
				$view = $login->index();
				$this->output($view);
				return;
			}
		}

		$action = $router->get_action();

		if (!$reflect->hasMethod($action))
			$action = isset($this->_registry["default_action"]) ? $this->_registry["default_action"] : 'index';

		$args = $router->get_args();

		$view = $instance->$action($args);
		$this->output($view);
	}

	// clean up an close the webapp
	public function dispose() 
	{
		ob_flush();
	}

	/* ***** Private helper methods ********** */
	private function output(IView $view)
	{
		if ($view == null)
			throw new Exception('No valid view is found');
		$view->render();
	}
	
	private function readConfig()
	{
		$config = parse_ini_file(APP_PATH . '/config.ini', true);
		// get all sections
		$db_section = $config['database'];
		$paths_section = $config['path'];
		$siteinfo_section = $config['site_info'];
		$autoload_section = $config['autoload'];
		
		// database settings
		foreach($db_section as $key => $value){
			$this->_registry[$key] = $value;
		}
		
		// paths
		foreach($paths_section as $key => $value) {
			define(strtoupper($key) . '_PATH', APP_PATH . $value);
		}
		
		// site info
		foreach($siteinfo_section as $key => $value){
			$this->_registry[$key] = $value;
		}
		
		// autoload
		foreach($autoload_section as $key => $value){
			Autoloader::add_path_to_search(APP_PATH . $value);	
		}
		
	}

	private function securityCheck()
	{
        if (isset($_SESSION['account'])){
                return true;
         }
        return false;
    }

	private function readRoutes()
	{
		$routes = parse_ini_file(APP_PATH . '/routes.ini', true);
		
		foreach ($routes as $name_route => $item) {
			$r = new StsRoute();
			
			foreach ($item as $key => $value) {

				switch ($key) {
					case 'url':
						$r->url = $value;
						break;
					case 'controller':
						$r->controller = $value;
						break;
					case 'action':
						$r->action = $value;
						break;
				}
			}
			$this->_routes[$name_route] = $r;	
		}
	}

/** obsolete ***
	private function loadInterfaces()
	{
		$directory = APP_PATH . "/lib/sitsol/interfaces";

		/// create an array to hold directory list
	    $results = array();

	    // create a handler for the directory
	    $handler = opendir($directory);

	    // open directory and walk through the filenames
	    while ($file = readdir($handler)) {

	      // if file isn't this directory or its parent, add it to the results
	      if ($file != "." && $file != "..") {
	        $results[] = $file;
	      }

	    }

	    // tidy up: close the handler
	    closedir($handler);

	    // loop and include_once
	    foreach ($results as $key => $value) {
	    	include_once($directory . "/" . $value);
	    }

	}
***** */
}




?>
