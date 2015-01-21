<?php
/**
 * @link local
 * @copyright Open Source License
 * @license No license yet
 */

namespace Lazy;
use Exception;
use \Lazy\Session;
use \Lazy\Cache;

/**
 * Database Model class for the Lazy Framework
 * @author Macky Mac <for3play@gmail.com>
 * @since 1.0
 */

class DataController extends Database
{
	public $tableName;
	public $result;
	public $schema;
	public $resultMsg;
	public $errors;
	private $sql;
	private $tableSchema;
	private $numArray;
	private $status;
	private $post;
	private $tableFields;
	private $tablePrefix;
	private $qry;
	private static $db_cache;
	#private static $_session;

	use Debug;
	public function __construct()
	{
		parent::__construct();
		$this->numArray = array('float', 'bigint', 'int', 'tinyint', 'smallint', 'integer', 'real', 'double', 'decimal', 'numeric');
		$this->initCache();
	}

	protected function __clone()
	{

	}

	public function query($sql)
	{
		$sql = mysql_real_escape_string($sql);
		try {
			return parent::query($sql);
		} catch (Exception $e) {
		   Debug::error('SQL Statement', $e->getMessage(), $sql);
		}
	}

	public function exec($sql)
	{
		try {
			$sql = mysql_real_escape_string($sql);
			$count=parent::exec($sql);
			$opKey = strtolower(strstr(ltrim($sql), ' ', true));
			switch($opKey) {
				case 'insert':
					$this->resultMsg=array('status'=>'success', 'action'=>'insert', 'lastid'=>parent::lastInsertId());
					break;
				case 'update':
					$this->resultMsg=array('status'=>'success', 'action'=>'update', 'affected_rows'=>$count);
					break;
			}
			return $result;
		} catch (Exception $e) {
		    Debug::error('SQL Statement', $e->getMessage(), $sql);
		}
	}

	public function execSQL()
	{
		try {
			$sql = mysql_real_escape_string($this->prepSQL);
			$this->qry = parent::prepare($sql);
			$this->qry->execute($this->tableFields);
			$opKey = strtolower(strstr(ltrim($this->prepSQL), ' ', true));
			switch($opKey) {
				case 'insert':
					$this->resultMsg=array('status'=>'success', 'action'=>'insert', 'lastid'=>parent::lastInsertId());
					break;
				case 'update':
					$this->resultMsg=array('status'=>'success', 'action'=>'update');
					break;
			}
			return $result;
		} catch (Exception $e) {
		    Debug::error('SQL Statement', $e->getMessage(), $sql);
		}
	}

	public function getRecords($sql, $paging=null, $jsonFormat=false)
	{
		if (is_null($sql)) Debug::show('Empty SQL Statement. usage: $obj->getRecords(sql_statement, optional page_array(recPerPage=>#, currPage=>currentPage)');
		$sql = preg_replace( '/\s+/', ' ', $sql);
		$resultSet = array();
		if (!is_null($paging)) {
			$currPage = (is_numeric($paging['currPage'])) ? $paging['currPage'] : 1;
			$recPerPage = $paging['recPerPage'];
			$sqlSuffix = split(' FROM ', $sql, 2)[1];
			$sqlCount = 'SELECT COUNT(*) as count FROM '.$sqlSuffix;
			if(strpos(strtolower($sqlCount), 'group by')) $sqlCount = 'SELECT COUNT(*) as count FROM ('.$sqlCount.') as tbl_temp';
			$totalRecords = (int)$this->query($sqlCount)->fetchAll()[0]['count'];
			$totalPages = ceil(($totalRecords/$recPerPage));
			$sql.=' LIMIT '.($currPage-1)*$recPerPage.','.$recPerPage;
		}
		$sql = mysql_real_escape_string($sql);
		$rowSet = $this->query($sql)->fetchAll();
		$rowCount = count($rowSet);
		$info = array('totalRecords'=>$totalRecords, 'recordCount'=>$rowCount, 'currentPage'=>$currPage, 'totalPages'=>$totalPages);
		$resultSet['info'] = $info;
		$resultSet['data'] = $rowSet;
		return $resultSet;
	}

	public function getRecord($sql, $jsonFormat=false)
	{
		$sql = mysql_real_escape_string($sql);
		$resultSet = $this->query($sql)->fetchAll()[0];
		if (count($resultSet)) {
			return $resultSet;
		} else {
			return false;
		}

	}

	private function getSchema()
	{
		$db_schema = array();
		if (is_null($this->tableName)) Debug::error('No Assigned Table','Assign tablename: $DataModel->tableName = &quot;&lt;table name&gt&quot;');
		$db_schema = unserialize(self::$db_cache->get('DB_SCHEMA'));
		if (!(is_null($db_schema[$this->tableName]))) {
			$this->schema = $db_schema[$this->tableName];
		} else {
			$sql = 'DESCRIBE '.$this->tableName;
			$this->schema = $this->query($sql)->fetchAll();
			$db_schema[$this->tableName] = $this->schema;
			self::$db_cache->save(serialize($db_schema), 'DB_SCHEMA');

		}
	}

	public function validateFields($post, $tableName, $prefix, $tranType, $addValid=null)
	{
		$this->tableName = $tableName;
		$this->getSchema();
		$this->status = 'success';
		$this->errors = array();
		$this->tableFields = array();
		$fields='';
		$sql = '';
		$this->tablePrefix = $prefix;
		foreach($this->schema as $scheme) {
			$error = '';
			$errorMessage = '';
			$type = (strpos($scheme['Type'], '(',0)) ? substr($scheme['Type'], 0, strpos($scheme['Type'], '(')) : $scheme['Type'];
			$field = str_replace($prefix, '', $scheme['Field']);
			$value = $post[$field];

			if ($scheme['Key']!='PRI'&&$scheme['Type']!='timestamp') {
				if($scheme['Null']=='NO') {
					if ((!(isset($value)))||(!(strlen($value)>0))) {
						$error = array('field'=>$scheme['Field'], 'label'=>$field, 'error'=>'required', 'errorMessage'=>'Required Field');
						$this->status = 'error';
						array_push($this->errors, $error);
					}
				}
				if (in_array($type, $this->numArray)) {
					if(strlen($value)>0) {
						$value = preg_replace("/[^0-9.]/", "", $value);
						if(!(is_numeric($value))) {
							$error = array('field'=>$scheme['Field'], 'label'=>$field, 'error'=>'numeric', 'errorMessage'=>'Must be Numeric');
							$this->status = 'error';
							array_push($this->errors, $error);
						}
					}
				}
			$this->tableFields[$field]=$value;
			}
		}
		if (!(is_null($addValid))) {
			foreach ($addValid as $key=>$value) {
				switch ($key) {
					case 'EMAIL':
						if (!filter_var($post[$value], FILTER_VALIDATE_EMAIL)) {
							$error = array('field'=>$prefix.$value, 'label'=>$value, 'error'=>'format', 'errorMessage'=>'Must be a Valid Email');
							$this->status = 'error';
							array_push($this->errors, $error);
						}
						break;

					case 'MATCH':
						if ($post[$value[0]]!=$post[$value[1]]) {
							$error = array('field'=>$prefix.$value[0], 'label'=>$value[1], 'error'=>'format', 'errorMessage'=>$value[2]);
							$this->status = 'error';
							array_push($this->errors, $error);
						}
						break;

					case 'REQUIRED':
						if (strlen($post[$value]<=0)) {
							$error = array('field'=>$prefix.$value, 'label'=>$value, 'error'=>'required', 'errorMessage'=>'Required Field');
							$this->status = 'error';
							array_push($this->errors, $error);
						}
						break;
					default:
						break;
				}
			}
		}
		$this->sql = substr($sql, 0, strlen($sql)-2);
		$this->resultMsg = ($this->status=='success') ? array('status'=>'success','table'=>$tableName, 'action'=>$tranType) : array('status'=>'fail','table'=>$tableName, 'action'=>$tranType, 'errors'=>$this->errors);
		return ($this->status=='success') ? true : false;

	}

	public function generateSQL($post, $tableName, $prefix, $tranType, $updateParam, $addValid=null)
	{
		if ($this->validateFields($post, $tableName, $prefix, $tranType, $addValid)) {
			$tranType = strtolower($tranType);
			$preSQL = ($tranType=='insert') ? 'INSERT INTO '.$tableName.' SET ' : 'UPDATE '.$tableName.' SET ';
			$this->prepSQL = $preSQL.$this->prepareStatement($preSQL);
			if ($tranType=='update') $this->prepSQL.=' WHERE '.$updateParam;
			return $this->prepSQL;
		} else {
			return false;
		}
	}

	private function prepareStatement($preSQL)
	{
		foreach ($this->schema as $scheme) {
			if ($scheme['Key']!='PRI'&&$scheme['Type']!='timestamp') {
				$fields .= $scheme['Field'].'=:'.str_replace($this->tablePrefix, '', $scheme['Field']).', ';
			}
		}
		return substr($fields, 0, strlen($fields)-2);
	}

	private function initCache()
	{
		if (!isset(self::$db_cache)) {
			$cache_dir = (defined('CACHE_DIR')) ? CACHE_DIR : '_tmp/';
			$options = array(
			    'cacheDir' => $cache_dir,
			    'lifeTime' => null
			);
			self::$db_cache = new Cache($options);
		}
		if (!(self::$db_cache->get('DB_SCHEMA'))) {
			self::$db_cache->save('empty', 'DB_SCHEMA');
		}
	}
}
