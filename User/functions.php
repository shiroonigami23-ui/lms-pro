<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

	function get_user_issue_book_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$user_issue_book_count = 0;
		$query = "select count(*) as user_issue_book_count from issued_books where student_id = '$_SESSION[id]'";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_issue_book_count = $row['user_issue_book_count'];
		}
		return($user_issue_book_count);
	}
	function get_book_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$book_count = 0;
		$query = "select count(*) as book_count from books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$book_count = $row['book_count'];
		}
		return($book_count);
	}
    function get_request_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$request_count = 0;
		$query = "select count(*) as request_count from request_books where student_id='$_SESSION[id]'";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$request_count = $row['request_count'];
		}
		return($request_count);
	}
	function get_dues_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$dues_count = 0;
		$query = "select count(*) as dues_count from issued_books where current_date > adddate(issued_books.issue_date,30) and student_id = '$_SESSION[id]'";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$dues_count = $row['dues_count'];
		}
		return($dues_count);
	}
?>
