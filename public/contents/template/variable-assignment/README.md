Variable Assignment from Backend to Frontend
---

By using the ITX class from pear, Genesis is able to implement total separation of HTML and PHP code. The HTML template uses placeholders in its code which will can be assigned values or strings from the PHP code.

The placeholders are variable names wrapped in curly braces &#123;variable}. Variable names can include any alphanumber character, dashes (-), periods (.) and underscores (_). Any order of these characters are allowed.

Genesis default variables are written in uppercase. *see article under "Application Defaults" for a list of default placeholders.*

These placeholders can be replaced by the PHP code by invoking the `->setVariable('variable', 'value')` method of the Render Object.

HTML (Current content template)

<pre>
	The quick &#123;color} &#123;animal} jumped over the lazy &#123;animal2}.
</pre>

PHP (`$_contents` is the current contents template object)
<pre>
	$_contents->setVariable('color', 'brown');
	$_contents->setVariable('animal', 'fox');
	$_contents->setVariable('animal2', 'dog');
</pre>

Output
<pre>
	The quick brown fox jumped over the lazy dog.
</pre>

Array Parsing
---

You can also pass associative arrays to the Render Object by passing an array object to the `->setVariable()` method.

<pre>
	$array = array(
		'color'=>'brown'.
		'animal'=>fox,
		'animal2'=>dog
	);

	$_contents->setVariable($array);
</pre>

Output
<pre>
	The quick brown fox jumped over the lazy dog.
</pre>

Nested Templates
---

You can nest multiple HTML templates within each other by assigning the rendered output to the variable placeholder of another template.

HTMLTemplate1.htm
<pre>
	The content of another file will be displayed here: &lt;br>
	&#123;otherfile_contents}
</pre>

HTMLTemplate2.htm
<pre>
	This is the contents of HTMLTemplate2. &lt;br>
	&#123;var_in_html2}
</pre>

Current contents theme
<pre>
	Current Contents: &lt;br>
	&#123;nested_contents}
</pre>

PHP
<pre>
	$obj1 = new Lazy\Render('path_to_HTMLTemplate1', 'HTMLTemplate1.htm');  	// creates $obj1 as new Render
	$obj2 = new Lazy\Render('path_to_HTMLTemplate2', 'HTMLTemplate2.htm');		// creates $obj2 as new Render
	$obj2->setVariable('var_in_html2', 'Hello World!');							// assigns &#123;var_in_html2} with "Hello World"
	$html2_contents = $obj2->get();												// gets the rendered output of $obj2
	$obj1->setVariable('otherfile_contents', $html2_contents);					// assigns &#123;otherfile_contents} with the rendered output of $obj2
	$html1_contents = $obj1->get();												// gets the rendered output of $obj1
	$_contents->setVariable('nested_contents', $html1_contents);				// assigns the output of $obj1 to the current content render object
</pre>

Output
<pre>
	Current Contents:&lt;br>
	The content of another file will be displayed here:&lt;br>
	This is the contents of HTMLTemplate2.&lt;br>
	Hello World!
</pre>

Default placeholder variables within the loaded templates are automatically parsed.

Variable placeholders in the main template can be parsed using the `$_theme` object.

Variable placeholders in the current HTML template content can be parsed using the `$_contents` object.



*You can read more about **ITX** over at http://pear.php.net/package/HTML_Template_IT/docs/latest/HTML_Template_IT/HTML_Template_ITX.html*
