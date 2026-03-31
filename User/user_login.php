<?php
session_start();
$appConfig = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
$connection = lms_db_connect($appConfig['db']);

$loginMessage = '';
$loginType = 'danger';
$redirectTo = '';

if (isset($_POST['login'])) {
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $loginMessage = 'Please enter both email and password.';
        $loginType = 'warning';
    } else {
        $userFound = false;
        $adminFound = false;
        $userStmt = mysqli_prepare($connection, 'SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1');
        if ($userStmt) {
            mysqli_stmt_bind_param($userStmt, 's', $email);
            mysqli_stmt_execute($userStmt);
            $userResult = mysqli_stmt_get_result($userStmt);
            $userRow = mysqli_fetch_assoc($userResult);
            mysqli_stmt_close($userStmt);

            if ($userRow) {
                $userFound = true;
                $userPassOk = password_verify($password, $userRow['password']) || $userRow['password'] === $password;
                if ($userPassOk) {
                    $_SESSION['id'] = $userRow['id'];
                    $_SESSION['name'] = $userRow['name'];
                    $_SESSION['email'] = $userRow['email'];
                    $redirectTo = 'user_dashboard.php';
                } else {
                    $loginMessage = 'Invalid email or password.';
                }
            }
        }

        if ($redirectTo === '') {
            $adminStmt = mysqli_prepare($connection, 'SELECT id, name, email, password FROM admins WHERE email = ? LIMIT 1');
            if ($adminStmt) {
                mysqli_stmt_bind_param($adminStmt, 's', $email);
                mysqli_stmt_execute($adminStmt);
                $adminResult = mysqli_stmt_get_result($adminStmt);
                $adminRow = mysqli_fetch_assoc($adminResult);
                mysqli_stmt_close($adminStmt);

                if ($adminRow) {
                    $adminFound = true;
                    $adminPassOk = password_verify($password, $adminRow['password']) || $adminRow['password'] === $password;
                    if ($adminPassOk) {
                        $_SESSION['id'] = $adminRow['id'];
                        $_SESSION['name'] = $adminRow['name'];
                        $_SESSION['email'] = $adminRow['email'];
                        $redirectTo = '../Admin/admin_dashboard.php';
                    } else {
                        $loginMessage = 'Invalid email or password.';
                    }
                }
            }
        }

        if ($redirectTo === '' && $loginMessage === '') {
            $loginMessage = 'No account found with this email. Please sign up first.';
            if (!empty($userFound) || !empty($adminFound)) {
                $loginMessage = 'Invalid email or password.';
            }
        }
    }
}

if ($redirectTo !== '') {
    header('Location: ' . $redirectTo);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            font-family: Arial, sans-serif;
        }
        #login-box {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            animation: fadeInRight 1s;
        }
        #sidebar-content {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            animation: fadeInLeft 1s;
            height: 90%;
        }
        @media (max-width: 768px) {
            #login-box,
            #sidebar-content {
                margin-bottom: 20px;
                height: auto;
            }
        }
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .form-control {
            border-radius: 20px;
            border: none;
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn-primary {
            border-radius: 20px;
            padding: 12px 30px;
            background-color: #6c63ff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #534bff;
        }
        .btn-warning {
            border-radius: 20px;
            padding: 12px 30px;
            background-color: #ffcc00;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e6b800;
        }
        @media (max-width: 768px) {
            #sidebar-content {
                height: auto;
                max-height: none;
                overflow-y: visible;
            }
        }
    </style>
</head>
<body>
<?php include('navbar_home.php'); ?>
    <marquee style="background-color: lightblue;">
        <b>Attention Users !!! Your login form is here, Please fill the correct credentials to log-in for your LMS
            activities.</b>
    </marquee>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="sidebar-content">
                    <h5>Library Timing</h5>
                    <ul>
                        <li>Opening: 8:00 AM</li>
                        <li>Closing: 8:00 PM</li>
                        <li>(Sunday Off)</li>
                    </ul>
                    <h5>What We Provide</h5>
                    <ul>
                        <li>Full furniture</li>
                        <li>Free Wi-fi</li>
                        <li>News Papers</li>
                        <li>Discussion Room</li>
                        <li>RO Water</li>
                        <li>Peaceful Environment</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div id="login-box">
                    <h3><i class="fas fa-sign-in-alt"></i> User Login</h3>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email ID" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Sign In</button>
                        <a class="btn btn-warning" href="signup.php">Sign Up</a>
                        <br><br>
                        <a href="forgot_password.php" style="color:red">Forgot Password?</a>
                    </form>
                    <?php if ($loginMessage !== ''): ?>
                        <div class="alert alert-<?php echo htmlspecialchars($loginType); ?> mt-3 mb-0"><?php echo htmlspecialchars($loginMessage); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap-4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
