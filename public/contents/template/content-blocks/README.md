Content Blocks
---

Content blocks can be inserted into the HTML template that can be hidden or displayed depending on conditions, or reiterated for loops.

Content blocks are coded using basic HTML comments and include the `BEGIN` and `END` keywords followed by the block name.

If no variable placeholders are parsed within a block, the block will not be displayed on rendering.

<pre>
	&lt;!-- BEGIN row -->
		This is the row contents. This is a  &#123;variable} within the block.
	&lt;!-- END row -->

	&lt;!-- BEGIN hiddenBlock -->
		This block will not be displayed as there are no variable placeholders to parse.
	&lt;!-- END hiddenBlock -->
</pre>

Conditional Assignments
---

Multiple different blocks can be hidden and displayed based on conditions on the PHP code. This can be achived by putting unique variable placeholders within each block and assigned values in the PHP code.

HTML
<pre>
	This is the content file

	&lt;!-- BEGIN true -->
		This block will be displayed if the condition is true. &#123;true}
	&lt;!-- END true -->

	&lt;!-- BEGIN false -->
		This block will be displayed if the condition is true. &#123;false}
	&lt;!-- END false -->
</pre>

PHP
<pre>
	$x = 1;
	if ($x == 1) {
		$_contents->setVariable('true', '');		// display "true" block
	} else {
		$_contents->setVariable('false', '');		// display "false" block
	}
</pre>

Output
<pre>
	This is the content file This block will be displayed if the condition is true.
</pre>

*see {path}/samples/conditional.htm and {path}/samples/conditional.php for the source code, <a target="_blank" href="{SITEURL}template/samples/conditional">{SITEURL}template/samples/conditional</a> for output*

Conditional or hidden blocks should not have application default variable placeholders as it will be rendered and displayed, nor should it contain generic variables that may be replaced in the normal execution of the PHP code.

Loops
---

Content blocks can also be reiterated via the PHP code using `->setCurrentBlock([blockName])` and parsed via `->parseCurrentBlock([blockName])

HTML
<pre>
	&lt;ul>
	&lt;!-- BEGIN row -->
		 &lt;li>&#123;i}&lt;/li> <!-- this variable will be incremented -->
	&lt;!-- END row -->
	&lt;/ul>
</pre>

PHP
<pre>
	for ($i=0; $i<=5; $i++) {
		$_contents->setCurrentBlock('row');		// sets the "row" block to be reiterated
		$_contents->setVariable('i', $i);		// assigns `$x` to the current block variable
		$_contents->parseCurrentBlock('row');	// parses the "row" block on each iteration
	}
</pre>

Output
<pre>
	&lt;ul>
	&lt;li>0&lt;/li>
	&lt;li>1&lt;/li>
	&lt;li>2&lt;/li>
	&lt;li>3&lt;/li>
	&lt;li>4&lt;/li>
	&lt;li>5&lt;/li>
	&lt;/ul>
</pre>

*see {path}/samples/looping.htm and {path}/samples/looping.php for the source code, <a target="_blank" href="{SITEURL}template/samples/looping">{SITEURL}template/samples/looping</a> for output*

Nested Loops
---

You can also create nested loops by putting Content Blocks within Content Blocks. Instead of using `->parseCurrentBlock([blockname])`, nesting needs to use `->parse([blockname])` for each block.

HTML
<pre>
	&lt;ul>
	&lt;!-- BEGIN outer -->
    &lt;li>&#123;i}
		&lt;ul>
			&lt;!-- BEGIN inner -->
			&lt;li>&#123;inner-i}.&#123;x}&lt;/li>
			&lt;!-- END inner -->
        &lt;/ul>
    &lt;/li>
	&lt;!-- END outer -->
	&lt;/ul>
</pre>

PHP
<pre>
	for ($i=1; $i<=5; $i++) {
		$_contents->setCurrentBlock('outer');			// sets the "outer" block to be reiterated
		$_contents->setVariable('i', $i);				// assigns `$i` to {i} placeholder
		for ($x=1; $x<=3; $x++) {
			$_contents->setCurrentBlock('inner');		// sets the "inner" block to be reiterated
			$_contents->setVariable('x', $x);			// assigns `$x` to {x} placeholder
			$_contents->setVariable('inner-i', $i);		// assigns `$i` to {inner-i} placeholder
			$_contents->parse('inner');					// parses the "inner" block on each iteration
		}
		$_contents->parse('outer');						// parses the "outer" block on each iteration
	}
</pre>

Output
<pre>
	&lt;ul>
    &lt;li>
		&lt;ul>
			&lt;li>1.1&lt;/li>
			&lt;li>1.2&lt;/li>
			&lt;li>1.3&lt;/li>
        &lt;/ul>
    &lt;/li>
    &lt;li>2
		&lt;ul>
			&lt;li>2.1&lt;/li>
			&lt;li>2.2&lt;/li>
			&lt;li>2.3&lt;/li>
        &lt;/ul>
    &lt;/li>
    &lt;li>3
		&lt;ul>
			&lt;li>3.1&lt;/li>
			&lt;li>3.2&lt;/li>
			&lt;li>3.3&lt;/li>
        &lt;/ul>
    &lt;/li>
    &lt;li>4
		&lt;ul>
			&lt;li>4.1&lt;/li>
			&lt;li>4.2&lt;/li>
			&lt;li>4.3&lt;/li>
        &lt;/ul>
    &lt;/li>
    &lt;li>5
		&lt;ul>
			&lt;li>5.1&lt;/li>
			&lt;li>5.2&lt;/li>
			&lt;li>5.3&lt;/li>
        &lt;/ul>
    &lt;/li>
	&lt;/ul>
</pre>

Do not use a placeholder variable inside the nested loop that is on the outside loop!

*see {path}/samples/nesting.htm and {path}/samples/nesting.php for the source code, <a target="_blank" href="{SITEURL}template/samples/nesting">{SITEURL}template/samples/nesting</a> for output*
