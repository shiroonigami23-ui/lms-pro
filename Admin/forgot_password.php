<?php
session_start();
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);

$message = '';
$messageType = '';

if (isset($_POST['reset_password'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $message = 'Passwords do not match.';
        $messageType = 'danger';
    } else {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $checkQuery = mysqli_query($connection, "SELECT id FROM admins WHERE email = '$email' LIMIT 1");
        if (mysqli_num_rows($checkQuery) === 1) {
            mysqli_query($connection, "UPDATE admins SET password='$hashed' WHERE email='$email'");
            $message = 'Admin password updated successfully. You can login now.';
            $messageType = 'success';
        } else {
            $message = 'Admin email not found.';
            $messageType = 'warning';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset Password</title>
    <link rel="stylesheet" href="../bootstrap-4.4.1/css/bootstrap.min.css">
</head>
<body style="background:#f1f5f9;">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">Admin Password Reset</div>
                <div class="card-body">
                    <?php if ($message !== ''): ?>
                        <div class="alert alert-<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
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
                        <button type="submit" name="reset_password" class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="index.php">Back to Admin Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
