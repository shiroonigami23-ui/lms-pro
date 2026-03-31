<html>
<head>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>
</head>
<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$query = "delete from request_books where request_no=  $_GET[rn]";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	sweetAlert("Oops...", "Username or Password Invalid!", "error");
	window.location.href = "admin_dashboard.php";
</script>
</html>
