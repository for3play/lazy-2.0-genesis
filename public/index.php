<?php
ob_start();
$settings=[];
$templateConfig=[];
require_once('config.php');
use Lazy\App;

$app = App::getInstance($settings, $templateConfig);
$app->start();
$app->run();

ob_end_flush();
