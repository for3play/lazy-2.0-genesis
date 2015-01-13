Application Controller & Global objects
---

The application and its objects are instantiated in the root `index.php` file.

The `$app = App::getInstance($settings, $templateConfig)` line instantiates `$app` as the main singleton global object.

`$app->start()` initiates the startup process of the controller.

`$app->run()` renders the display and the final execution of the controller.

The `$app` object also instantiates global objects to be used within the entire application.

The `$app` object contains application variables and functions used throughout the site. See 'Routes & File System' for some functions.

You can also output JSON data by invoking `$app->json_encode($arrayObject)`. This will override the render of HTML files, displaying only raw JSON with header. This is useful for APIs and data queries via AJAX.

Global Objects & Functions
---

The global objects can be invoked anywhere within the application and its files.

* `$_theme` - Main HTML theme layout object
* `$_contents` - HTML theme of the current page
* `$_session` - Session handling class of the application

Session Handling
---

All session variables should be assigned using the `$_session` object. This will compartmentalize session variables based on a `uniqid()` generated on the first execution of the app. All session variables for this application will be stored as arrays under the `$_SESSION[uniqid]` object.

Assigning session variables can be invoked using `$_session['name'] = 'value'`.

Arrays should have keys instantiated prior to being passed to the `$_session` object. Example:

<pre>
	$array = array('var1'=>'value1', 'var2'=>'value2', ...);
	$_session['arrayHandler'] = $array;
</pre>
or
<pre>
	$array = array('var1', 'var2', ...);
	$_session['arrayHandler'] = $array;
</pre>
You can then retrieve or assign values to the `$_session` object via:
<pre>
	echo $_session['arrayHandler']['var1'];
	$_session['arrayHandler']['var1'] = 'foo';
</pre>
You can set unlimited number of dimensional arrays using this method.



*see section under "Template Render" for usage of theme objects*
