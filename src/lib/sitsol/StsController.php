<?php

class StsController {
	
	private $_view = null;
	private  $_registry = null;

	protected $tpl = null;
	protected $viewbag = array();

	// property op aan te geven of de controller afgeschermd moet worden van de buitenwereld
	// TODO: beter uitwerken van de beveiligings module
	private $_isProtected = false;

	public function __construct($registry) 
	{
		$this->set_registry($registry);
	}

	public function set_tpl($value) 
	{
		$this->tpl = $value;
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
	public function view($model = null, $tpl = null) {
		if ($this->_view == null)
			$this->_view = new StsHtmlView();

		// set tpl and model
		if ($tpl != null)
			$this->_view->set_tpl($tpl);
		if ($model != null)
			$this->_view->set_viewModel($model);

		return $this->_view;
	}
}



?>
