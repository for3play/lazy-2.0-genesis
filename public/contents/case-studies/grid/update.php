<?php
$post = $_POST;											// get $_POST variables
$type = $post['type'];

if($type =='books') {
	$addValid = array('EMAIL'=>'author_email');				// add email format validation
	$tablePrefix = 'book_';									// set table prefix for books
} else {
	$tablePrefix = 'gen_';									// set table prefix for genres
}


if ($qry->generateSQL($post, 'tbl_'.$type, $tablePrefix, $post['action'], $tablePrefix.'id='.$post['id'], $addValid)) {
	$qry->execSQL();
}
$app->json_encode($qry->resultMsg);
