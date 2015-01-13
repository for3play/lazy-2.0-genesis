<?php

$qry = new Lazy\DataController;
$fileName = $app::$route['fileName'];
$path = $app::$route['path'];
$_contents->setVariable($app::$route);

$fileNamePHP = $path.'/'.$fileName.'.php';
$fileNameHTM = $path.'/'.$fileName.'.htm';
$readmeFile = $path.'/'.$fileName.'.md';

$PHPContents = trim(str_replace('<?php','', file_get_contents($fileNamePHP, false)));
$readmeRender = new Lazy\Render($path, $fileName.'.md');
$readmeRender->setVariable('codePHP', $PHPContents);
$readme = $parsedown->text($readmeRender->get());
$_theme->setVariable('readme', $readme);
$_theme->setVariable('readme_file', $readmeFile);
