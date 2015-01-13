<?php


	$sql = 'SELECT * FROM tbl_genres';							// query for genres and populate dropdown
	$genres = $qry->getRecords($sql);
	if ($genres['info']['recordCount']) {
		foreach ($genres['data'] as $genre) {
			$_contents->setCurrentBlock('genres');				// set current block to "genres" dropdown options
			$_contents->setVariable($genre);					// set values for "genres" dropdown options
			$_contents->parseCurrentBlock();					// parse "genres" dropdown options
		}
	}
