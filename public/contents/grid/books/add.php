<?php
$sql = 'SELECT * FROM tbl_genres ORDER BY gen_name ASC';
$genres = $qry->getRecords($sql);
foreach($genres['data'] as $row){
	$_contents->setCurrentBlock('genres');
	$_contents->setVariable($row);
	$_contents->parseCurrentBlock();
}
