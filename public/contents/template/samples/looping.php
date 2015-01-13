<?php
for ($i=0; $i<=5; $i++) {
	$_contents->setCurrentBlock('row');		// sets the "row" block to be reiterated
	$_contents->setVariable('i', $i);		// assigns `$x` to the current block variable
	$_contents->parseCurrentBlock('row');	// parses the "row" block on each iteration
}
