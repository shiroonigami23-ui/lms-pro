<html>

<head>
	<title>LMS</title>
	<meta charset="utf-8" name=<?php
	?>"viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>
</head>

<body>

<?php
session_start();
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$sql = "select * from users where email='$email' limit 1";
$result = mysqli_query($connection, $sql);
$present = mysqli_num_rows($result);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email,$v_code)
{
	global $appConfig;
	require('../Email/Exception.php');
require('../Email/SMTP.php');
require('../Email/PHPMailer.php');
$mail = new PHPMailer(true);
try {
	if (empty($appConfig['mail']['smtp_user']) || empty($appConfig['mail']['smtp_pass'])) {
		return false;
	}
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = $appConfig['mail']['smtp_user'];                     //SMTP username
	$mail->Password   = $appConfig['mail']['smtp_pass'];                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	//Recipients
	$mail->setFrom($appConfig['mail']['smtp_user'], 'Email Verification');
	$mail->addAddress($email);     //Add a recipient
	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'LMS Email Verification';
	$verifyBase = rtrim(dirname($appConfig['live_url']), '/');
	$mail->Body    = "Hey User ,  Your Verification link is here ,Please Click on 
	<b><a href='$verifyBase/verify.php?email=$email&&v_code=$v_code'>Verify</a></b><br>";
	$mail->send();
   return true;
} catch (Exception $e) {
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   return false;
}
}
if($present>0)
{
    $_SESSION['email_alert']='1';
    header("location:signup.php"); 
}
else{
	
	$v_code=bin2hex(random_bytes(16));
	$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$isVerified = 0;
	// If SMTP is not configured, let the user in directly.
	if (empty($appConfig['mail']['smtp_user']) || empty($appConfig['mail']['smtp_pass'])) {
		$isVerified = 1;
		$v_code = '';
	}
	$query = "insert into users values('$_POST[id]','$_POST[name]','$_POST[course]','$_POST[department]','$_POST[email]','$hashedPassword','$v_code',$isVerified,'$_POST[mobile]','$_POST[address]')";
	
	if(mysqli_query($connection,$query) && ($isVerified === 1 || sendmail($_POST['email'],$v_code)))
	{
?>
<script type="text/javascript">
	alert("Registration Successful!");
	window.location.href = "user_login.php";
</script>
<?php 
	}
	else{
		?>
		<script type="text/javascript">
	alert("Registration UnSuccessful!");
	window.location.href = "user_login.php";
</script>
<?php
	}
}
?>	
</body>
</html>
