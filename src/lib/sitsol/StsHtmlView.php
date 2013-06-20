<?php

interface IView {
	public function render();
}

class StsHtmlView implements IView {
	
	private $_tpl = null;	// filename used for content display  
	private $_viewModel = null;			// every view has a viewmodel 
	
	private $_error404 = "error/error404.html";


	/* ***** FIELDS & CONSTRUCTORS ********** */

	public function __construct()
	{
		// caching ???
	}

	/* ***** GETTERS - SETTERS ********** */ 
	public function get_tpl() 
	{
		return $this->_tpl;
	}

	public function set_tpl($value)
	{
		$this->_tpl = $value;
	}

	public function get_viewModel()
	{
		return $this->_viewModel;
	}

	public function set_viewModel($value)
	{
		$this->_viewModel = $value;
	}

	/* ***** PUBLIC FUNCTIONS ********** */
	public function render()
	{
		$model = null;
		if ($this->_viewModel != null) {
			$model=$this->_viewModel;
		}
		
		if ($this->_tpl != null && is_file(VIEWS_PATH . "/" . $this->_tpl))
			include(VIEWS_PATH . "/" . $this->_tpl);
		else 
			include(VIEWS_PATH . "/" . $this->_error404);
	}
}


?>
