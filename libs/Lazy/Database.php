<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;
use Exception;

/**
 * Database connection class for the Lazy Framework.
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class Database extends \PDO
{
	use Debug;
	public function __construct()
	{
		try {
			$dsn = 'mysql'.':dbname='.DB_DBNAME.";host=".DB_HOSTNAME;
			parent::__construct($dsn, DB_USERNAME, DB_PASSWORD);
			$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		} catch (Exception $e) {
		    Debug::error('Connection Settings', $e->getMessage(), '');
		}
	}


}

