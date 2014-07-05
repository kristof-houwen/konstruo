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


class StsAutoloader
{
	private static $_pathToSearch = array();
	private static $_cache = array();
	
	public static function load_class($className)
	{
		if (self::$_cache[$className]) {
			include self::$_cache[$className];
		} else {
			$file = self::search_file($className);
			if (!is_null($file)) {
				include $file;
			} else {
				throw new Exception('Class ' . $className . ' not found.');
			}
		}
		
	}
	
	static function search_file($fileName)
	{
		foreach(self::$_pathToSearch as $path) {
			if (is_file($path . "/" . $fileName . ".php")) {
				self::add_to_cache($fileName, $path . "/" . $fileName . ".php");
				return $path . "/" . $fileName . ".php";
			}
		}
		return null;
	}
	
	public static function add_path_to_search($path)
	{
		if (is_dir($path)) {
			array_push(self::$_pathToSearch, $path);
		}
	}
	
	private static function add_to_cache($className, $fileName){
		if (isset($_SESSION['autoloader_path'])) {
			$_SESSION['autoloader_path'][$className] = $fileName;
		} else {
			self::$_cache[$className] = $fileName;
			$_SESSION['autoloader_path'] = self::$_cache;
		}
		
	}

}

?>
