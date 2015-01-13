<?php
for ($i=1; $i<=5; $i++) {
	$_contents->setCurrentBlock('outer');		    // sets the "outer" block to be reiterated
	$_contents->setVariable('i', $i);				// assigns `$i` to {i} placeholder
	for ($x=1; $x<=3; $x++) {
		$_contents->setCurrentBlock('inner');		// sets the "inner" block to be reiterated
		$_contents->setVariable('x', $x);			// assigns `$x` to {x} placeholder
		$_contents->setVariable('inner-i', $i);		// assigns `$i` to {inner-i} placeholder
		$_contents->parse('inner');					// parses the "inner" block on each iteration
	}
	$_contents->parse('outer');						// parses the "outer" block on each iteration
}
