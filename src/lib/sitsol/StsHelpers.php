<?php 
/* **************************************************************************************************************************************************
 * 
 *
 *  Copyright (C) 2012 by Kristof Houwen, 8800 Roeselare.
 *  All rights reserved.
 *
 *  This source code is the proprietary confidential property of Kristof Houwen, and is provided to licensee solely for documentation and
 *  educational purposes. Reproduction, publication, or distribution in any form to any party other than the licensee is strictly prohibited.
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
 *  Project:    SitSol framework
 *  Version:	0.1           
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