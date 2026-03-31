<?php
	session_start();
if(!isset($_SESSION['email']))
{
	die(include('../user/error.html'));
}
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$query = "delete from feedback where id = $_GET[in]";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Feedback removed successfully...");
	window.location.href = "view_feedback.php";
</script> 
