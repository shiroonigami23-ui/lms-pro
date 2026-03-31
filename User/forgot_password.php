<?php
session_start();
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);

$message = '';
$messageType = '';

if (isset($_POST['forgot_password'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $message = 'Passwords do not match.';
        $messageType = 'danger';
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $checkUser = mysqli_query($connection, "SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (mysqli_num_rows($checkUser) === 1) {
            mysqli_query($connection, "UPDATE users SET password='$hashedPassword' WHERE email='$email'");
            $message = 'Password updated. You can login now.';
            $messageType = 'success';
        } else {
            $message = 'Email not found.';
            $messageType = 'warning';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
</head>
<body style="background: linear-gradient(to right, #0ea5e9, #1e3a8a);">
<?php include('navbar_home.php') ?>
<div class="container py-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Reset User Password</div>
                <div class="card-body">
                    <?php if ($message !== ''): ?>
                        <div class="alert alert-<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" required minlength="4">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required minlength="4">
                        </div>
                        <button type="submit" name="forgot_password" class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
</body>
</html>
