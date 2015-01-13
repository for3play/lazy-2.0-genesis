<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;

/**
 * Application logging class for the Lazy Framework.
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class Log
{
	public static $fileName;
	public static $filePath;

	public function __construct($filePath=null, $fileName=null)
	{
		if (isset($fileName)) self::$fileName=$fileName;
		if (isset($filePath)) self::$filePath=$filePath;
	}

	public function append($string)
	{
		#echo  self::$filePath.'/'.self::$fileName;
		file_put_contents(self::$filePath.'/'.self::$fileName, $string, FILE_APPEND | LOCK_EX);
	}

	public function createFile($file)
	{

	}

}
