<?php
require_once('../StsApp.php');

$app = new StsApp();
$app->init();
$app->start();
$app->dispose();
?>
