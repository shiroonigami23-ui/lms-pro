<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

	function get_author_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$author_count = 0;
		$query = "select count(*) as author_count from authors";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$author_count = $row['author_count'];
		}
		return($author_count);
		
	}
	function get_user_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$user_count = 0;
		$query = "select count(*) as user_count from users";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_count = $row['user_count'];
		}
		return($user_count);
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

	function get_issue_book_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$issue_book_count = 0;
		$query = "select count(*) as issue_book_count from issued_books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$issue_book_count = $row['issue_book_count'];
		}
		return($issue_book_count);
	}

	function get_category_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$cat_count = 0;
		$query = "select count(*) as cat_count from category";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$cat_count = $row['cat_count'];
		}
		return($cat_count);
	}
	function not_return_book_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$not_return_book_count = 0;
		$query = "select count(*) as not_return_book_count from issued_books where current_date > adddate(issue_date,30)";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$not_return_book_count = $row['not_return_book_count'];
		}
		return($not_return_book_count);
	}
	function get_request_count(){
		global $appConfig;
		$connection = lms_db_connect($appConfig['db']);
		$request_count = 0;
		$query = "select count(*) as request_count from request_books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$request_count = $row['request_count'];
		}
		return($request_count);
	}


?>
