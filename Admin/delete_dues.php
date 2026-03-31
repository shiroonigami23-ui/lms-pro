<?php
	session_start();
if(!isset($_SESSION['email']))
{
die(include('../user/error.html'));
}
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$query = "delete from issued_books where s_no=  $_GET[bn]";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Dues Removed successfully...");
	window.location.href = "view_not_return_book.php";
</script>
