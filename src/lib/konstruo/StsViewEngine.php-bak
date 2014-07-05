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
