<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;
use Lazy\Routing;

class Session implements \ArrayAccess
{
	private static $hostPath;
	protected static $uniqid;

	public function __construct()
    {
		session_start();
		$routes = new Routing;
		$routeInfo = $routes->info();
		self::$hostPath = $routeInfo['hostName'].$routeInfo['basePath'];
		if (!isset($_SESSION[self::$hostPath])) {
			$_SESSION[self::$hostPath]=uniqid();
		}
		self::$uniqid=$_SESSION[self::$hostPath];
		foreach ($_SESSION[self::$uniqid] as $key => $value) {
            $_SESSION[self::$uniqid][$key] = $value;
        }
        if (isset($_GET['session_clear'])){
            if ($_GET['session_clear']==1){
                $_SESSION[self::$uniqid] = null;
            } else {
                unset($_SESSION[self::$uniqid][$_GET['session_clear']]);
            }
        } else {

        }
    }

    public function __toString()
    {
        print_r($_SESSION[self::$uniqid]);
        return '';
    }

	public function offsetSet($offset, $data)
    {
        if ($offset === null) {
            $_SESSION[self::$uniqid][] = $data;
        } else {
            $_SESSION[self::$uniqid][$offset] = $data;
        }
    }

    public function offsetGet($offset)
    {
    	return $_SESSION[self::$uniqid][$offset];
    }

    public function offsetExists($offset)
    {
    	return isset($_SESSION[self::$uniqid][$offset]);
    }

    public function offsetUnset($offset)
    {
    	unset($_SESSION[self::$uniqid][$offset]);
    }





}
