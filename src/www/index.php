<?php

$realpath = realpath(dirname(__FILE__));
$posLastSlash = strrpos($realpath, "/");

define ('SITE_PATH', $realpath);
define('APP_PATH', substr($realpath, 0, $posLastSlash));

require_once(APP_PATH . '/lib/sitsol/StsApp.php');

$app = new StsApp();
$app->init();
$app->start();
$app->dispose();

?>
