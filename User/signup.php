<?php
session_start();
$msg = '';
if (isset($_SESSION['email_alert'])) {
    $msg = "Email already exists. Please use another email.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LMS Pro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(130deg, #0f172a, #1e3a8a);
            min-height: 100vh;
        }
        .panel {
            background: rgba(255,255,255,.96);
            border-radius: 16px;
            box-shadow: 0 16px 34px rgba(2, 6, 23, .35);
        }
        .hint-card {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.25);
            color: #e2e8f0;
            border-radius: 14px;
            padding: 18px;
        }
    </style>
</head>
<body>
<?php include('navbar_home.php'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <div class="hint-card">
                <h5>Registration Notes</h5>
                <ul class="mb-0">
                    <li>Use valid student details.</li>
                    <li>Email and mobile should be active.</li>
                    <li>Roll number should be unique.</li>
                    <li>Password can be changed after first login.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel p-4">
                <h3 class="mb-3">Student Registration</h3>
                <?php if ($msg !== ''): ?>
                    <div class="alert alert-warning"><?php echo htmlspecialchars($msg); ?></div>
                <?php endif; ?>
                <form action="register.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Roll Number</label>
                            <input type="text" name="id" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Course</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Department</label>
                            <input type="text" name="department" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile</label>
                            <input type="text" name="mobile" maxlength="10" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<?php unset($_SESSION['email_alert']); ?>
