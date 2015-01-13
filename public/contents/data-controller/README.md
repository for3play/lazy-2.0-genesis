Data Controller
---

The Data Controller object of Genesis can be invoked by instantiating the `Lazy\DataController` class.

The Data Controller extends the PHP PDO Class Object as it's parent classs.

Raw SQL statements are used, instead of using an Data Mapper which gives the developer 100% control of data shaping and optimization of data querying (read: too lazy to develop one).

The controller has functions such as:
* Auto paging
* Auto generate INSERT and UPDATE SQL statements
* Auto field validation based on table schema
* Custom validation
* Session-based schema storage for non redundant query of table schema
* Auto SQL Statement preparation for security
* Associative array return with relevant information such as paging, type of query, etc.
* Debug information generated on SQL statement, connection or other errors

To instantiate the Data Controller, assign the `Lazy\DataController` class to an object variable: `$obj = new Lazy\DataController`.

The Data Controller object has these methods and functions:

* `$obj->query(<sql statement>)` - to query records from the database and return the results
* `$obj->exec(<sql statement>)` - execute and SQL statement and return a status message based on the type of query (INSERT/UPDATE)
* `$obj->execSQL()` - automatically execute a prepared stament passed by `$obj->generateSQL(...)`
* `$obj->getRecords(<sql statement>, <optional paging array>)` - retrieve records based on the SQL statement along with optional paging information
* `$obj->getRecord(<sql statement>) - retrieve a single record based on the SQL statement
* `$obj->generateSQL(<post variables>, <table name>, <fields prefix>, <transaction type ([INSERT/UPDATE]>, <update parameters [WHERE id=id], <optional validation array>))` - returns prepared SQL statement to be executed by invoking `$obj->execSQL()`, on return false, use `$obj->resultMsg()` to return error results
* `$obj->resultMsg()` - returns result array based on last DB transaction


The Genesis Data Controller is compatible with any table schema layout, but it is advisable to add a prefix to fields of each table, unique to itself, to allow for non conflicting field names in grouped queries and easier identification on what table each field belongs to.

*Import the included sample database in "data/lazy_genesis.sql" into your MySQL server for the demonstration in the sub section, and update "config.php" to use the database*

*You can read more about the PHP PDO object at http://php.net/manual/en/book.pdo.php*
