<?php

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
