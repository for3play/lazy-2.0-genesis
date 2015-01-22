<?php
$id = $_GET['id'];
$sql = 'SELECT * FROM tbl_genres WHERE gen_id='.$id;
$record = $qry->getRecord($sql);
$_contents->setVariable($record);
