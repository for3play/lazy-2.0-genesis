<?php
	$post = $_POST;											// get $_POST variables
	$addValid = array('EMAIL'=>'author_email');				// add email format validation
	$tablePrefix = 'book_';									// set table prefix
	if ($qry->generateSQL($post, 'tbl_books', $tablePrefix,	$post['action'], 'book_id='.$post['id'], $addValid)) {
		$qry->execSQL();
		$_contents->setVariable('SITEURL-success', $app::$settings['SITEURL']);		// assign special value to display success message block
		$_contents->setVariable('action', strtolower($post['action']));				// sets status type placeholder value
	} else {
		$formName = ((strtolower($post['action'])=='update')) ? 'edit.htm' : 'add.htm';
		$form = new \Lazy\Render($app::$route['path'], $formName);					// load edit.htm form again for display2
		foreach ($post as $key=>$value) {
			$form->setVariable($tablePrefix.$key, $value);							// assign post variables to form
		}
		foreach ($qry->resultMsg['errors'] as $key => $error) {
			$form->setVariable('error-'.$error['label'], 'input-error');			// set input forms to class="input-error" for CSS display
			$form->setVariable('errorMsg-'.$error['label'], $error['errorMessage']);		// set message to errorMsg-[formname] to display error
		}
		$sql = 'SELECT * FROM tbl_genres';							// query for genres and populate dropdown
		$genres = $qry->getRecords($sql);
		if ($genres['info']['recordCount']) {
			foreach ($genres['data'] as $genre) {
				$form->setCurrentBlock('genres');				// set current block to "genres" dropdown options
				$form->setVariable($genre);					// set values for "genres" dropdown options
				if ($genre['gen_id'] == $post['fk_gen_id']) $form->setVariable('gen_selected', 'SELECTED');
																	// set the current dropdown item to SELECTED if book is this genre
				$form->parseCurrentBlock('genres');			// parse "genres" dropdown options
			}
		}
		$_contents->setVariable('display-form', $form->get()); 				// display form in {result} placeholder
	}
