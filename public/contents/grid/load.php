<?php

$qry = new Lazy\DataController;
$sql = 'SELECT
	tbl_books.book_id,
	tbl_books.book_title,
	tbl_books.book_author,
	tbl_books.book_author_email,
	tbl_genres.gen_name
	FROM
	tbl_books
	INNER JOIN
	tbl_genres ON tbl_books.book_fk_gen_id = tbl_genres.gen_id
	ORDER BY book_title ASC';												// raw SQL query to select records

	$paging = array('currPage'=>$_GET['page'], 'recPerPage'=>5);			 // optional parameter to set the returns in pages
	$records = $qry->getRecords($sql, $paging);							  // returns associative array [info, data]
	$app->json_encode($records);

