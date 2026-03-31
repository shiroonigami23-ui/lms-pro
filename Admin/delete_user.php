<?php
	session_start();
if(!isset($_SESSION['email']))
{
die(include('../user/error.html'));
}
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$query = "delete from users where id = '$_GET[id]'";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("User Deleted successfully...");
	window.location.href = "Regusers.php";
</script>
