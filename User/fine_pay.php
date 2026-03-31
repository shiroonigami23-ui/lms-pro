<?php
session_start();
if(!isset($_SESSION['email']))
{
	header("location:user_login.php");
}
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$query = "select * from issued_books where book_no= $_GET[bn]";
	$query_run = mysqli_query($connection,$query);
if($row['dues_status'] == "Paid")
{
	?>
	<script type="text/javascript">
	alert("Already Paid...");
	window.location.href = "show_dues.php";
</script>
<?php

}
?>

else
<?php
{
	
	$query = "update issued_books set dues_status='Paid' where book_no= $_GET[bn]";
	$query_run = mysqli_query($connection,$query);
	$query = "update books set quantity=quantity+1 where book_no= $_GET[bn]";
	$query_run = mysqli_query($connection,$query);
	?>
	<script type="text/javascript">
	alert("Paid successfully...");
	window.location.href = "show_dues.php";
</script>
<?php
}
?>

