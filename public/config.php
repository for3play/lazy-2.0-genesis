<?php
#error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
date_default_timezone_set('Asia/Manila');
define('URL', 'http://'.$_SERVER['HTTP_HOST'].str_replace('index.php', '', $_SERVER['PHP_SELF']));
define('INCLUDEPATH','../libs/');
#define('APP_ID', 'lazy2');

$settings=[
	'SITE_TITLE'=>'LAZY 2.0 (Genesis)',
	'PAGE_TITLE'=>'LAZY 2.0 (Genesis)',
	'META_DESCRIPTION'=>'LAZY 2.0 (Genesis)',
	'META_KEYWORDS'=>'LAZY 2.0 (Genesis)',
	'SITEURL'=>URL,
	'IMAGEPATH'=>URL.'images/'
];

$templateConfig=[
	'templateDir'=>'theme/html/', #default directory for main template
	'templateFile'=>'index.tpl', #default file for template
	'contentsPath'=>'contents/', #default path for the contents files
	'defaultContentsFile'=>'default', #load default content file
	'defaultTemplateExtension'=>'.htm', #default extension for HTML templates
	'defaultContentsFolder'=>'default', #default contents folder
	'default404File'=>'404', #404 file
	'mode'=>'STD', #STD - standard display, API - API mode, BLANK - uses blank template
	'theme'=>'DEFAULT' #use template - to be implemented
];

switch($_SERVER['HTTP_HOST']) {
	case 'localhost':
		define('DB_HOSTNAME','localhost');
		define('DB_USERNAME','root');
		define('DB_PASSWORD','mysql');
		define('DB_DBNAME','lazy_genesis');
		define('INCLUDEPATH','../libs/');
		break;

	case 'testbed':
		break;

	default:
		define('DB_HOSTNAME','localhost');
		define('DB_USERNAME','root');
		define('DB_PASSWORD','mysql');
		define('DB_DBNAME','lazy_genesis');
		define('INCLUDEPATH','../libs/');
		break;
}

function Autoload($class){
	if(file_exists(INCLUDEPATH.$class.'.php')) require_once(INCLUDEPATH.$class.'.php');
}
spl_autoload_register('Autoload');
include('libs/Parsedown/Parsedown.php');
