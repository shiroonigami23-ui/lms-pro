<?php $appConfig = require __DIR__ . '/../config/app.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <a class="navbar-brand ml-3" href="index.php" style="color:whitesmoke"><?php echo htmlspecialchars($appConfig['app_name']); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signup.php">Register</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="admin/index.php">Admin Login</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="about_us.php">About Us</a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .navbar-nav .nav-item .nav-link {
        transition: color .2s ease, transform .2s ease;
    }
    .navbar-nav .nav-item .nav-link:hover {
        color: #7dd3fc;
        transform: translateY(-1px);
    }
</style>
