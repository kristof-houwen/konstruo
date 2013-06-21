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

	class StsBase {
		/* *** CODE TO USE PRIVATES AS PROPERTIES *********** */
		private $data = array();

		public function __set($key, $value) {
			$this->data[$key] = $value;
		}

		public function __get($key) {
			if (array_key_exists($key, $this->data)) {
				return $this->data[$key];
			}

			$trace = debug_backtrace();
			trigger_error(
				'Undefined property via __get(): ' . $key .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'],
				E_USER_NOTICE);
			return null;
		}

		public function __isset($key) {
			return isset($this->data[$key]);
		}

		public function __unset($key) {
			unset($this->data[$key]);
		}

		/** ************************************************** */


	}


?>
