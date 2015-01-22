<?php

if ($app::$route['fileName'] != 'default') {
	$_theme->setBlank();
}
$qry = new Lazy\DataController;

