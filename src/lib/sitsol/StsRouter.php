<?php
/* **************************************************************************************************************************************************
 * 
 *
 *  Copyright (C) 2010 by Kristof Houwen, 8800 Roeselare.
 *  All rights reserved.
 *
 *  This source code is the proprietary confidential property of Kristof Houwen, and is provided to licensee solely for documentation and
 *  educational purposes. Reproduction, publication, or distribution in any form to any party other than the licensee is strictly prohibited.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 *  MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 *  WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 *  OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 *  Author:		Kristof Houwen
 *  Company:    SitSol webdesign
 *  E-mail:		kristof(at)sitsol.be
 *  Url:		www.sitsol.be
 * 
 *  Project:    SitSol internal framework
 *  Version:	0.1             10/11/2011
 *
 * *****************************************************************************************************************************************************/

/** TODO ******** 

we kunnen een routes.ini file maken en daarin de routes definiëren die we wensen te gebruiken

[blog_route]
url = "blog/article/{id}"
controller = "BlogController"
action = "article"

[default_route]
path = "{controller}/{action}/{args}"
defaultController = "Homecontroller"
defaultAction = "index"

We kunnen dan de verkregen uri na de rt vergelijken met alle routes of we een string tegenkomen die bv. start met de bovenste
De default_route is verplicht en moet als laatste staan, die is de rout die altijd wordt aangenomen als de andere routes niet overeenkomen

******************* */

/** 
 * Takes the incoming URI and routes to the correct controller and action method
 *
 */
class StsRouter {
	
	private $_uri;
	private $_controllerName;
	private $_actionName;
	private $_args = array();
	
	private $_defaultController = 'HomeController';
	private $_defaultAction = 'index';
	
	private $_registry;
	
	public function __construct($registry)
	{
		$this->set_registry($registry);
		$this->_uri = strtolower((empty($_GET['rt'])) ? '' : $_GET['rt']);
	}
	
	/* ***** Getter & setters ********** */
	public function get_controller()
	{
		if (!empty($this->_controllerName) && is_file(CONTROLLER_PATH . '/' . $this->_controllerName . '.php'))
			return $this->_controllerName;
		return $this->_defaultController;
	}
	
	public function get_action()
	{
		if (!empty($this->_actionName))
			return $this->_actionName;
		return $this->_defaultAction;
	}
	
	public function get_args()
	{
		return $this->_args;
	}
	
	public function set_registry($value)
	{
		$this->_registry = $value;
		$this->setParams();
	}
	
	/* ***** Public methods ********* */
	public function processUri()
	{ 
		try {
			if (empty($this->_uri))
			 	return;
			
			$urlParts = explode('/', $this->_uri);
			
			$this->_controllerName = ucfirst(trim($urlParts[0]));
			if (!empty($this->_controllerName))
				$this->_controllerName = $this->_controllerName . 'Controller';
			
			$this->_actionName = trim($urlParts[1]);
			
			// all other parts of the uri are parameters
			$j = 0;
			reset($urlParts);
			for ($i = 2; $i < count($urlParts); $i++) {
				$this->_args[$j] = $urlParts[$i];
				$j++;
			}
		} catch (Exception $e) { 
			echo 'ERROR: Cannot process uri ' . $this->uri . '<br />'; 
		}
	}
	
	/* ***** Private helper methods ********** */
	private function setParams()
	{
		if ($this->_registry != null) {
			//$this->_defaultController = isset($this->_registry["default_controller"]) ? $this->_registry["default_controller"] : 'HomeController';
			//$this->_defaultAction = isset($this->_registry["default_action"]) ? $this->_registry["default_action"] : 'index';
			$this->_defaultController = isset($this->_registry->default_controller) ? $this->_registry->default_controller : 'HomeController';
			$this->_defaultAction = isset($this->_registry->default_action) ? $this->_registry->default_action : 'index';
			
		}
	}
}


?>



