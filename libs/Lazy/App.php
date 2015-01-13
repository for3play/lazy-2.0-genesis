<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;

/**
 * Main Application Class for the Lazy Framework
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class App extends BaseApp
{
	public function __call($method, $args)
	{
        if (isset($this->$method) === true) {
            $func = $this->$method; $func();
        }
    }
}
