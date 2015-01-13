Data Controller Demonstration - Update Record
---

The below demonstration shows the validation for the record being updated/added and display the form and display error messages, or redirect to display page on success.

* `$obj->generateSQL(<post variables>, <table name>, <fields prefix>, <transaction type ([INSERT/UPDATE]>, <update parameters [WHERE id=id], <optional validation array>))` - returns prepared SQL statement to be executed by invoking `$obj->execSQL()`, on return false, use `$obj->resultMsg()` to return error results
* `$obj->resultMsg()` - returns result array based on last DB transaction
	* `[status]` - returns "success" or "fail"
	* `[table]` - returns affected table name
	* `[action]` - returns transaction type "update" or "insert"
	* `[errors]` - returns associative array of table name, input name field, and error message
		* `[field]` - field name from table
		* `[label]` - input name field or post variable key
		* `[error]` - error type
		* `[errorMessage]` - error message

PHP
<pre>
	{codePHP}
</pre>

HTML
<pre>
	&lt;!-- BEGIN error -->
		&#123;display-form}
	&lt;!-- END error -->
	&lt;!-- BEGIN success -->
		&lt;strong>Result: &lt;/strong>&#123;action} is successful. Click &lt;a href="{SITEURL-success}data-controller/demonstration/">Here&lt;/a> to go back to list
	&lt;!-- END success -->


</pre>
See the corresponding form "edit.htm" or "add.htm" for the HTML code.
