<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;

require_once(__DIR__.'../../Pear/HTML/Template/ITX.php');

/**
 * Render is the HTML template controller class for the Lazy framework. It extends the HTML_Template_ITX class of the PEAR Library.
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class Render extends \HTML_Template_ITX
{
	public static $settings;
	public static $templateConfig;
	public static $path;
	public static $fileName;
	public static $route;
	private static $blankTemplate = '{CONTENTS}';
	private static $missingTemplate = 'Template Not Found.<hr>{CONTENTS}';

	public function __construct($filePath, $fileName)
	{
		if (strlen($fileName) > 0){
			$this->setHTML($filePath, $fileName);
			$this->replaceDefaults();
		}
	}

	private function replaceDefaults()
	{
		$arrayMerged = array_merge(self::$settings, self::$templateConfig, self::$route);
		foreach ($arrayMerged as $key=>$value) {
			$this->setVariable($key, $value);
		}
		$this->setVariable('CONTENTS_PATH', self::$path);
		$this->setVariable('CONTENTS_FILENAME', self::$fileName);
		$this->setVariable('HTML_IT_TEMPLATE_BLANK_PLACEHOLDER',''); #override to display contents even if no replacements occured.
		$currURL = self::$route['uri'];
		if ($currURL == '') {
			$currURL = 'default';
		}
		$currURL = 'URL-'.str_replace('/', '.', $currURL);
		$this->setVariable($currURL, 'url-active');
	}

	public function setBlank()
	{
		$this->setTemplate(self::$blankTemplate);
	}

	public function setHTML($filePath, $fileName)
	{
		$this->HTML_Template_ITX($filePath);
		if ($this->loadTemplatefile($fileName, true, true)) {
		} else {
			$this->setTemplate(self::$missingTemplate);
		}
	}

	public function parseArray($array)
	{
		foreach ($array as $key=>$value) {
			$this->setVariable($key, $value);
		}
	}

}
