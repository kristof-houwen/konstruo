<?php

$realpath = realpath(dirname(__FILE__));
$posLastSlash = strrpos($realpath, "/");

define ('PUBLIC_PATH', $realpath);
define('APP_PATH', substr($realpath, 0, $posLastSlash));

require_once(APP_PATH . '/lib/konstruo/App.php');
$app = new App();
$app->init();
$app->start();
$app->dispose();

?>
