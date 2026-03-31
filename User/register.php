<?php
session_start();

$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.php');
    exit();
}

$id = trim((string)($_POST['id'] ?? ''));
$name = trim((string)($_POST['name'] ?? ''));
$course = trim((string)($_POST['course'] ?? ''));
$department = trim((string)($_POST['department'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$password = (string)($_POST['password'] ?? '');
$confirmPassword = (string)($_POST['confirm_password'] ?? '');
$mobile = trim((string)($_POST['mobile'] ?? ''));
$address = trim((string)($_POST['address'] ?? ''));

$_SESSION['register_message'] = '';
$_SESSION['register_type'] = 'danger';

if ($id === '' || $name === '' || $course === '' || $department === '' || $email === '' || $password === '' || $mobile === '' || $address === '') {
    $_SESSION['register_message'] = 'Please fill all required fields.';
    $_SESSION['register_type'] = 'warning';
    header('Location: signup.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['register_message'] = 'Please enter a valid email address.';
    $_SESSION['register_type'] = 'warning';
    header('Location: signup.php');
    exit();
}

if ($password !== $confirmPassword) {
    $_SESSION['register_message'] = 'Password and confirm password do not match.';
    $_SESSION['register_type'] = 'warning';
    header('Location: signup.php');
    exit();
}

if (strlen($password) < 6) {
    $_SESSION['register_message'] = 'Password must be at least 6 characters.';
    $_SESSION['register_type'] = 'warning';
    header('Location: signup.php');
    exit();
}

$emailStmt = mysqli_prepare($connection, 'SELECT id FROM users WHERE email = ? LIMIT 1');
mysqli_stmt_bind_param($emailStmt, 's', $email);
mysqli_stmt_execute($emailStmt);
$emailExists = mysqli_stmt_get_result($emailStmt)->num_rows > 0;
mysqli_stmt_close($emailStmt);

if ($emailExists) {
    $_SESSION['register_message'] = 'Email is already registered.';
    $_SESSION['register_type'] = 'warning';
    header('Location: signup.php');
    exit();
}

$idStmt = mysqli_prepare($connection, 'SELECT id FROM users WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($idStmt, 's', $id);
mysqli_stmt_execute($idStmt);
$idExists = mysqli_stmt_get_result($idStmt)->num_rows > 0;
mysqli_stmt_close($idStmt);

if ($idExists) {
    $_SESSION['register_message'] = 'Roll number already exists.';
    $_SESSION['register_type'] = 'warning';
    header('Location: signup.php');
    exit();
}

$verificationCode = '';
$isVerified = 1;
if (!empty($appConfig['mail']['smtp_user']) && !empty($appConfig['mail']['smtp_pass'])) {
    $verificationCode = bin2hex(random_bytes(16));
    $isVerified = 0;
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insertStmt = mysqli_prepare(
    $connection,
    'INSERT INTO users (id, name, course, department, email, password, verification_code, is_verified, mobile, address, Role)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)'
);
mysqli_stmt_bind_param($insertStmt, 'sssssssiss', $id, $name, $course, $department, $email, $hashedPassword, $verificationCode, $isVerified, $mobile, $address);
$insertOk = mysqli_stmt_execute($insertStmt);
mysqli_stmt_close($insertStmt);

if (!$insertOk) {
    $_SESSION['register_message'] = 'Registration failed. Please try again.';
    $_SESSION['register_type'] = 'danger';
    header('Location: signup.php');
    exit();
}

if ($isVerified === 0) {
    require('../Email/Exception.php');
    require('../Email/SMTP.php');
    require('../Email/PHPMailer.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $appConfig['mail']['smtp_user'];
        $mail->Password = $appConfig['mail']['smtp_pass'];
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom($appConfig['mail']['smtp_user'], 'LMS Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verify your LMS account';
        $verifyBase = rtrim(dirname($appConfig['live_url']), '/');
        $mail->Body = "Click to verify your account: <a href='{$verifyBase}/verify.php?email={$email}&v_code={$verificationCode}'>Verify Email</a>";
        $mail->send();
    } catch (Exception $e) {
        // Keep account created; user can use forgot password flow if needed.
    }
}

$_SESSION['register_message'] = 'Registration successful. Please login.';
$_SESSION['register_type'] = 'success';
header('Location: user_login.php');
exit();
?>
