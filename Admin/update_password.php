<?php
	session_start();
	if(!isset($_SESSION['email']))
{
die(include('../user/error.html'));
}
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$password = "";
	$query = "select * from admins where email = '$_SESSION[email]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$password = $row['password'];
	}
	if($password == $_POST['new_password']){
		$query = "update admins set password = '$_POST[new_password]' where email = '$_SESSION[email]'";
		$query_run = mysqli_query($connection,$query);
		?>
		<script type="text/javascript">
			alert("Updated successfully...");
			window.location.href = "admin_dashboard.php";
		</script>

		<?php
	}
	else{
		?>
		<script type="text/javascript">
			alert("Wrong Admin Password...");
			window.location.href = "change_password.php";
		</script>
		<?php
	}
?>
