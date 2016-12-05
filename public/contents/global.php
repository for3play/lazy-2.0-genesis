<?php
$route = $app::$route;
$folderURI = $route['uri'];

if (strlen($folderURI)==0) {
	$nav = 'default';
	$folderURI = '../../';
} else {
	$nav = $folderURI;
}

$readmeFile = str_replace('//','/', 'contents/'.$folderURI.'/README.md');

$readme = '';

$parsedown = new Parsedown;

if (file_exists($readmeFile)) {
	$readmeRender = new Lazy\Render('contents/'.$folderURI, 'README.md');
	$readmeRender->setVariable($route);
	$readme = $parsedown->text($readmeRender->get());
} else {
	$readmeFile = 'None';
}

$phpFile = $route['path'].'/'.$route['fileName'].'.php';
if (!file_exists($phpFile)){
	$phpFile = 'None';
}

$_theme->setVariable('readme', $readme);
$_theme->setVariable('readme_file', $readmeFile);
$_theme->setVariable('php_file', $phpFile);
