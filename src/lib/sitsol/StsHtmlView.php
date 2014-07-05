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

// interface IView {
// 	public function render();
// }

class StsHtmlView implements IView {
	
	private $_tpl = null;	// filename used as main template 
	private $_content = null; // filename used for content display  
	private $_viewModel = null;			// every view has a viewmodel 
	private $_base_url = null;
	
	private $_error404 = "404.html";


	/* ***** FIELDS & CONSTRUCTORS ********** */

	public function __construct()
	{
		// caching ???
	}

	/* ***** GETTERS - SETTERS ********** */ 
	public function set_base_url($value)
	{
		$this->_base_url = $value;
	}

	public function get_content()
	{
		return $this->_content;
	}

	public function set_content($value)
	{
		$this->_content = $value;
	}

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

	public function set_404($value)
	{
		$this->_error404 = $value;
	}

	public function get_404($value)
	{
		return $this->_error404;
	}

	/* ***** PUBLIC FUNCTIONS ********** */
	public function render()
	{
		$model = null;
		$content = null;
		$base_url = $this->_base_url;

		if ($this->_viewModel != null) 
			$model=$this->_viewModel;

		if ($this->_content != null && is_file(VIEWS_PATH . "/" . $this->_content))
		{
			$content = VIEWS_PATH . "/" . $this->_content;
			if ($this->_tpl != null && is_file(VIEWS_PATH . "/" . $this->_tpl))
				include(VIEWS_PATH . "/" . $this->_tpl);
			else
				include($content);
		} else 
			include(PUBLIC_PATH . "/" . $this->_error404);
		
		
		
	}
}


?>
