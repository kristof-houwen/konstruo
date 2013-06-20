<?php

class StsController {
	
	private $_view = null;
	private  $_registry = null;

	protected $masterTpl = null;
	protected $contentTpl = null;
	protected $viewbag = array();

	// property op aan te geven of de controller afgeschermd moet worden van de buitenwereld
	// TODO: beter uitwerken van de beveiligings module
	private $_isProtected = false;

	public function __construct($registry) 
	{
		$this->set_registry($registry);
	}

	/* ***** Getters and setters ***********/
	public function set_masterTpl($value) 
	{
		$this->masterTpl = $value;
	}

	public function set_contentTpl($value) 
	{
		$this->contentTpl = $value;
	}
	
	protected function set_registry($value)
	{
		$this->_registry = $value;
	}

	public function get_registry()
	{
		return $this->_registry;
	}

	public function get_isProtected()
	{
		return $this->_isProtected;
	}
	
	public function set_isProtected($value)
	{
		$this->_isProtected = $value;
	}

	/* ***** controller methods ************** */

	/**
	 * this method must be called from every actionmethod to return a HTML view
	 *
	 */
	public function view($model = null, $contentTemplate = null, $masterTemplate = null) {
		if ($this->_view == null)
			$this->_view = new StsHtmlView();

		// assign vars to smarty in view
		if ($viewbag != null && count($viewbag) > 0) {
			foreach ($viewbag as $key => $value)
				$this->_view->addVar($key, $value);
		}

		// assign template known in controller as master template
		$this->_view->set_masterTemplate($this->masterTpl);
		$this->_view->set_contentTemplate($this->contentTpl);

		// override the defaults with supplied parameters
		if ($masterTemplate != null)
			$this->_view->set_masterTemplate($masterTemplate);
		if ($contentTemplate != null)
			$this->_view->set_contentTemplate($contentTemplate);
		if ($model != null)
			$this->_view->set_viewModel($model);
		
		return $this->_view;
	}
}



?>
