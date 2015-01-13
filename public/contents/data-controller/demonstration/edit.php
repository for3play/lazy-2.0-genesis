<?php

	$id = $_GET['id'];
	$sql = 'SELECT * FROM tbl_books WHERE book_id='.$id;		// raw SQL query
	if (!($record = $qry->getRecord($sql))) header('Location: '.$app::$settings['SITEURL'].'data-controller/demonstration/');
																// check if record exists, if not, redirect back to display page.
	$_contents->setVariable($record);							// pass associative array to template
	$gen_id = $record['book_fk_gen_id']; 						// get foreign key genre id in record

	$sql = 'SELECT * FROM tbl_genres';							// query for genres and populate dropdown
	$genres = $qry->getRecords($sql);
	if ($genres['info']['recordCount']) {
		foreach ($genres['data'] as $genre) {
			$_contents->setCurrentBlock('genres');				// set current block to "genres" dropdown options
			$_contents->setVariable($genre);					// set values for "genres" dropdown options
			if ($genre['gen_id'] == $gen_id) $_contents->setVariable('gen_selected', 'SELECTED');
																// set the current dropdown item to SELECTED if book is this genre
			$_contents->parseCurrentBlock('genres');			// parse "genres" dropdown options
		}
	}
