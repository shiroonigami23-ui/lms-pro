<?php
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);

$message = 'Verification failed.';
$redirect = 'user_login.php';

$email = trim((string)($_GET['email'] ?? ''));
$code = trim((string)($_GET['v_code'] ?? ''));

if ($email !== '' && $code !== '') {
    $stmt = mysqli_prepare($connection, 'SELECT email, is_verified FROM users WHERE email = ? AND verification_code = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'ss', $email, $code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        if ((int)$row['is_verified'] === 0) {
            $up = mysqli_prepare($connection, 'UPDATE users SET is_verified = 1 WHERE email = ?');
            mysqli_stmt_bind_param($up, 's', $email);
            mysqli_stmt_execute($up);
            mysqli_stmt_close($up);
            $message = 'Email verification completed. Please login.';
        } else {
            $message = 'Account already verified. Please login.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification | LMS Pro</title>
    <link rel="stylesheet" href="../bootstrap-4.4.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4 class="mb-3">LMS Verification</h4>
                <p><?php echo htmlspecialchars($message); ?></p>
                <a href="<?php echo htmlspecialchars($redirect); ?>" class="btn btn-primary">Go To Login</a>
            </div>
        </div>
    </div>
</body>
</html>
