<?php

	
define('SITE_PATH', realpath(dirname(__FILE__)));
define('ERROR404', 'error404.html');

require_once('StsBase.php');
require_once('lib/smarty/Smarty.class.php');

interface IViewEngine 
{
	public function get_smarty();
	public function set_smarty($value);
	public function renderHtmlView($template);
}

class StsViewEngine extends StsBase implements IViewEngine {
	/* ***** FIELDS & CONSTRUCTORS ********** */
	private $_smarty = null;

	public function __construct()
	{
		$this->_smarty = new Smarty();
		$this->_smarty->setTemplateDir(SITE_PATH . '/templates');
		$this->_smarty->setCompileDir(SITE_PATH . '/templates_c');
		$this->_smarty->setConfigDir(SITE_PATH . '/config');
		$this->_smarty->setCacheDir(SITE_PATH . '/cache');
	}

	/* ***** GETTERS - SETTERS ********** */ 
	public function get_smarty() { 
		return $this->_smarty;
	}
	public function set_smarty($value) { 
		$this->_smarty = $value;
	}


	/* ***** PUBLIC FUNCTIONS ********** */
	public function renderHtmlView($template)
	{	
		$tmplDir = $this->_smarty->getTemplateDir();
		if ($template == null || !is_file($tmplDir[0] . $template)) {
			$template = ERROR404;
		}
		$this->_smarty->display($template);
	}

}


?>
