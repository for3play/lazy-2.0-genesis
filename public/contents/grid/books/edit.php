<?php

$id = $_GET['id'];
$sql = 'SELECT * FROM tbl_books WHERE book_id='.$id;
$record = $qry->getRecord($sql);
$_contents->setVariable($record);

$sql = 'SELECT * FROM tbl_genres ORDER BY gen_name ASC';
$genres = $qry->getRecords($sql);
foreach($genres['data'] as $row){
	$_contents->setCurrentBlock('genres');
	$_contents->setVariable($row);
	if ($record['book_fk_gen_id'] == $row['gen_id']) $_contents->setVariable('gen_selected', 'SELECTED');
	$_contents->parseCurrentBlock();
}
