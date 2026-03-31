<?php

$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$user_count = 0;
	$query = "select count(*) as user_count from users";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$user_count = $row['user_count'];	
	}
?>
