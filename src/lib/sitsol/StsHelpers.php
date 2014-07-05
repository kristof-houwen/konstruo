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

 
 // HELPER FUNCTIONS
class StsHelpers {

	public static function startsWith($haystack, $needle)
	{
	    //$length = strlen($needle);
	    // return (substr($haystack, 0, $length) === $needle);
	    return strncmp($haystack, $needle, strlen($needle)) === 0;
	}

	public static function endsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }

	    return (substr($haystack, -$length) === $needle);
	}
}

 ?>