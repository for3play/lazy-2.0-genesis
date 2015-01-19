<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;
require_once(__DIR__.'../../Pear/Cache/Lite.php');

Class Cache extends \Cache_Lite
{
	public function __clone()
	{
	}

}
