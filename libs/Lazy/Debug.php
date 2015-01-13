<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;

/**
 * Debugging trait for the Lazy Framework. Can be used to display runtime and logical errors as well as the configuration settings for the app.
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

trait Debug
{
	public function __construct()
	{
	}

	/**
	 * Display debug information for current app
	 * @return void
	 */
	public static function info()
	{
		$debugInfo = array('settings'=>static::$settings, 'config'=>static::$templateConfig, 'routeInfo'=>static::$routeInfo);
		echo json_encode($debugInfo, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}

	/**
	 * display error message and exit current code execution
	 * @param  string $code error code
	 * @param  string $message error message
	 * @param  string $string optional error message
	 * @param  boolean $break not yet implemented
	 * @return void
	 */
	public static function error($code, $message, $string=null, $break=true)
	{
		$error = array('status'=>'error', 'error'=>$code, 'message'=>$message, 'code'=>$string);
		header('Content-Type: application/json');
		echo json_encode($error, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
		die();
	}

	/**
	 * display message and exit current code execution
	 * @param  string $message
	 * @return void
	 */
	public static function show($message)
	{
		echo $message;
		die();
	}


}

