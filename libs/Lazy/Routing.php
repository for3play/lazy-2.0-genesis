<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;

/**
 * Routing class for the Lazy Framework. This reads from the URI and parses it to be passed to the BaseApp Controller
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class Routing
{
    public static $routes;
    public $basePath;
    public static $uri;
    public $hostName;
    public static $folderURI;


    /**
     * Creates a new object using the given configuration.
     *
     * usage $obj = new Routing
     *
     * @return object the created object
     */

    public function __construct()
    {
        $this->hostName = $_SERVER['HTTP_HOST'];
        $this->basePath = implode('/', array_slice(explode('/', str_replace('//','/', $_SERVER['SCRIPT_NAME'])), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->basePath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        self::$folderURI = trim($uri, '/');
        self::$uri = '/' . self::$folderURI;
        self::$routes = $this->routes();
    }

    /**
     * @return array of routes of the current URL
     */
    public function routes()
    {
        $routes = [];
        $routes_array = explode('/', self::$uri);
        foreach ($routes_array as $route) {
            if (trim($route) != '') {
                array_push($routes, $route);
            }
        }
        self::$routes = $routes;
        return $routes;
    }

    /**
     * @return array of host and route information of the current URL
     */
    public function info()
    {
        $info = ['hostName'=>$this->hostName, 'basePath'=>$this->basePath, 'uri'=>self::$uri, 'route'=>self::$routes];
        return $info;
    }


}
