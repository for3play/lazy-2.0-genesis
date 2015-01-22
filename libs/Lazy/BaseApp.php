<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;

use Lazy\Routing;
use Lazy\TemplateRender;
use Lazy\Render;
use Lazy\Session;

/**
 * BaseApp is the base controller class for the Lazy framework.
 * Do not use BaseApp directly. Instead, use its child class [[\App]] which you can replace to
 * customize methods of BaseApp.
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class BaseApp
{
    use Debug;
    private static $instance;
    private static $currentURI;
    private static $templateRender;
    private static $routes;
    private static $_session;
    private static $fullRoute;
    private static $fileName;
    private static $routeInfo;
    private static $path;
    private static $siteURL;
    private static $uri;
    private static $templateConfig = [
        'templateDir'=>'theme/html/', #default directory for main template
        'templateFile'=>'index.tpl', #default file for template
        'contentsPath'=>'contents', #default path for the contents files
        'defaultContentsFile'=>'default', #load default content file
        'defaultTemplateExtension'=>'.htm', #default extension for HTML templates
        'defaultContentsFolder'=>'default', #default contents folder
        'default404File'=>'404', #404 file
        'mode'=>'STD', #STD - standard display, API - API mode, BLANK - uses blank template
        'theme'=>'DEFAULT' #use template - to be implemented
    ];
    private static $route;
    public static $settings;

    public function __construct()
    {
    }

    protected function __clone()
    {
    }

    protected function __wakeup()
    {
    }

    /**
     * Returns a string representing the current version of the Lazy framework.
     * @return string the version of Lazy framework
    */
    public static function getVersion()
    {
        return '2.0.0-beta';
    }


    /**
     * Creates a new object using the given configuration.
     *
     * Below are some usage examples:
     *
     * ```php
     * // create an object using a class name
     * $object = App::getInstance();
     *
     * // create an object using a configuration array
     * $object = App::getInstance(Array(), Array());
     *
     *
     * @param array|array
     *
     * - a configuration array: settings
     * - a configuration array: templateConfig
     *   The callable should return a new instance of the object being created.
     *
     * @return object the created object
     */

    public static function getInstance($settings=null, $templateConfig=null)
    {
           if (!(is_null($templateConfig))) self::$templateConfig = array_replace(self::$templateConfig, $templateConfig);
        if (!(is_null($settings))) self::$settings=$settings;
        if (!isset(self::$instance)) {
            self::$instance = new BaseApp;
        }
        return self::$instance;
    }

    /**
     * late binding for template configuration
     * @param array $templateConfig template configuration array
     */
    public function setConfig($templateConfig)
    {
        if (!(is_null($templateConfig))) self::$templateConfig = array_replace(self::$templateConfig, $templateConfig);
    }

    public function start()
    {
        $this::$routes = new Routing;
        self::$routeInfo=$this::$routes->info();
        self::$fullRoute=$this::$routes->routes();
        self::$route = $this->check_file(self::$fullRoute);
        self::$_session = new Session;
        self::$route['uri'] = ltrim(self::$routeInfo['uri'], '/');
        $this->init_templates();
        $this->load_files(self::$route['path'], self::$route['fileName']);
    }

    /**
     * checks if both .HTM and/or .PHP files exist
     * @param  array $routes route information based on URI
     * @return array path and filename of the current loaded file. returns 404.htm if no files can be found
     */
    private function check_file($routes)
    {
        $templateConfig['contentsPath'] = rtrim($templateConfig['contentsPath'], '/');
        $templateConfig['defaultContentsFolder'] = rtrim($templateConfig['defaultContentsFolder'], '/');
        $path='';
        $fileName='';
        $path1 = join('/', $routes);
        $last_file = array_pop($routes);
        $path2 = join('/', $routes);
        $path1=self::$templateConfig['contentsPath'].'/'.$path1;
        $path2=self::$templateConfig['contentsPath'].'/'.$path2;
        $path=self::$templateConfig['contentsPath'].'/'.self::$templateConfig['defaultContentsFolder'];
        $fileName=self::$templateConfig['defaultContentsFile'];
        if ($path1!=self::$templateConfig['contentsPath'].'/') {
            if ((file_exists($path1.'/'.self::$templateConfig['defaultContentsFile'].'.htm')||(file_exists($path1.'/'.self::$templateConfig['defaultContentsFile'].'.php')))) {
                $path=$path1;
                $fileName=self::$templateConfig['defaultContentsFile'];
            } elseif ((file_exists($path2.'/'.$last_file.'.htm')||(file_exists($path2.'/'.$last_file.'.php')))) {
                $path=$path2;
                $fileName=$last_file;
            } elseif ((file_exists($path2.'/'.self::$templateConfig['defaultContentsFolder'].'/'.$last_file.'.htm')||(file_exists($path2.'/'.self::$templateConfig['defaultContentsFolder'].'/'.$last_file.'.php')))) {
                $path=self::$templateConfig['contentsPath'].'/'.self::$templateConfig['defaultContentsFolder'];
                $fileName=$last_file;
            } else {
                $path=self::$templateConfig['contentsPath'].'/'.self::$templateConfig['defaultContentsFolder'];
                $fileName=self::$templateConfig['default404File'];
            }
        }
        $path = str_replace('//', '/', $path);
        self::$path=$path;
        self::$fileName=$fileName;
        return ['path'=>$path, 'fileName'=>$fileName];
    }

    /**
     * include PHP files for render
     * @param  string $path path of include file
     * @param  string $fileName filename of PHP file to include
     * @return void
     */
    private function load_files($lf_path, $lf_fileName)
    {
        $app = static::getInstance();
        $itx = self::$templateRender->getTemplates();
        $_contents = &$itx['_contents'];
        $_theme = &$itx['_theme'];
        $_session = &self::$_session;
        include_once(self::$templateConfig['contentsPath'].'/global.php');
        include_once($lf_path.'/global.php');
        include_once($lf_path.'/'.$lf_fileName.'.php');
    }

    /**
     * initialize base templates
     * @return void
     */
    private function init_templates()
    {
        $set_static = new Render('', '');
        $set_static::$settings = self::$settings;
        $set_static::$templateConfig = self::$templateConfig;
        $set_static::$path = self::$path;
        $set_static::$fileName = self::$fileName;
        $set_static::$route = self::$route;
        self::$templateRender = new TemplateRender(self::$templateConfig, self::$settings, self::$path, self::$fileName);
    }

    /**
     * execute application renderer
     * @return display
     */
    public function run()
    {
        self::$templateRender->renderTemplates();
    }

    /**
     * output array object as json and disable HTML templates
     * @param  array $json array object
     * @return display
     */
    public function json_encode($json)
    {
        self::$templateRender->getTemplates()['_contents']->setBlank();
        self::$templateRender->getTemplates()['_theme']->setBlank();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

}
