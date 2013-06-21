<?php

/* **************************************************************************************************************************************************
 * 
 *  Copyright (C) 2013 by Kristof Houwen, Belgium.
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
 *  Company:    SitSol webdesign
 *  E-mail:		kristof(at)sitsol.be
 *  Url:		www.sitsol.be
 * 
 *  Project:    SitSol Construct
 *  Version:	0.1             
 *
 * *****************************************************************************************************************************************************/


class StsController {
	
	private $_view = null;
	private  $_registry = null;
	private $_tpl = null;
	
	protected $viewbag = array();

	// property op aan te geven of de controller afgeschermd moet worden van de buitenwereld
	// TODO: beter uitwerken van de beveiligings module
	private $_isProtected = false;

	// public function __construct($registry) 
	// {
	// 	$this->set_registry($registry);
	// }

	public function set_tpl($value) 
	{
		$this->_tpl = $value;
	}
	
	public function set_registry($value)
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
	public function view($content, $model = null, $tpl = null) {
		if ($this->_view == null)
			$this->_view = new StsHtmlView();

		// set tpl and model
		if ($tpl != null)
			$this->_view->set_tpl($tpl);
		else
			$this->_view->set_tpl($this->_tpl);

		if ($model != null)
			$this->_view->set_viewModel($model);

		$this->_view->set_base_url("http://" . $this->_registry["base_url"] . "/");
		$this->_view->set_content($content);
		return $this->_view;
	}

	/**
	 * this method must be called from every actionmethod to return a JSON view
	 *
	 */
	public function json($content) {
		$this->_view = new StsJsonView($content);
		$this->_view->set_base_url("http://" . $this->_registry["base_url"] . "/");
		return $this->_view;
	}
}



?>
