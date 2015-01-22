<?php

$type = $_GET['type'];


if ($type=='books') {
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
	ORDER BY book_title ASC';												// raw SQL query to select books
} elseif ($type == 'genres') {
	$sql = 'SELECT *
	FROM tbl_genres ORDER BY gen_name ASC';								// raw SQL query to select genres

}
	$paging = ['currPage'=>$_GET['page'], 'recPerPage'=>10];			 // optional parameter to set the returns in pages
	$records = $qry->getRecords($sql, $paging);							  // returns associative array [info, data]
	$app->json_encode($records);


