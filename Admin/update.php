<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$query = "update admins set name = '$_POST[name]',email = '$_POST[email]',mobile = '$_POST[mobile]'";
$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	
	alert("Updated successfully...");
	window.location.href = "admin_dashboard.php";
</script>
