<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;
use Lazy\Render;


/**
 * TemplateRender is the application template controller class for the Lazy framework. It extends the Render class of the lazy Library.
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class TemplateRender
{
	protected static $_theme;
	protected static $_contents;
	private static $contentsPath;
	private static $contentsFile;
	private static $templateConfig;
	private static $settings;

	public function __construct($templateConfig, $settings, $path, $fileName)
	{
		self::$templateConfig = $templateConfig;
		self::$settings = $settings;
		self::$contentsPath=$path;
		self::$contentsFile=$fileName.self::$templateConfig['defaultTemplateExtension'];
		self::loadMainTemplate();
		self::loadContentsTemplate();
	}

	private static function loadMainTemplate()
	{
		self::$_theme = new Render(rtrim(self::$templateConfig['templateDir'], '/'), self::$templateConfig['templateFile']);
	}

	private static function loadContentsTemplate()
	{
		self::$_contents = new Render(self::$contentsPath, self::$contentsFile);
	}

	private static function postMeta()
	{
		$array = ['PAGE_TITLE', 'META_DESCRIPTION', 'META_KEYWORDS'];
		foreach ($array as $key) {
			if (self::$_contents->blockExists($key)) {
				self::$_contents->setCurrentBlock($key);
				self::$_contents->setVariable('PH_'.strtolower($key),'');
				self::$_contents->parseCurrentBlock();
				self::$_theme->setVariable($key,trim(self::$_contents->get($key)));
				self::$_contents->replaceBlock($key,' ');
			}
		}
	}

	public function renderTemplates()
	{
		self::postMeta();
		@self::$_theme->setVariable('CONTENTS', self::$_contents->get());
		@self::$_theme->show();
	}

	public static function getTemplates()
	{
		return ['_theme'=>&self::$_theme,'_contents'=>&self::$_contents];
	}

}
