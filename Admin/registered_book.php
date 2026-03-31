<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$book_count = 0;
	$query = "select count(*) as book_count from books";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$book_count = $row['book_count'];	
	}
?>
