<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Pro</title>
    <link rel="manifest" href="manifest.webmanifest">
    <meta name="theme-color" content="#0ea5e9">
    <link rel="icon" type="image/png" sizes="192x192" href="icons/icon-192.png">
    <link rel="apple-touch-icon" href="icons/icon-192.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --bg-1: #0f172a;
            --bg-2: #1e293b;
            --card: #f8fafc;
            --accent: #0ea5e9;
        }
        body {
            background: radial-gradient(circle at top right, #1d4ed8, #0f172a 45%, #020617);
            color: #0f172a;
        }
        .hero {
            min-height: 66vh;
            background:
                linear-gradient(120deg, rgba(15, 23, 42, .65), rgba(2, 6, 23, .7)),
                url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1600&q=80') center/cover;
            border-radius: 16px;
            padding: 56px 28px;
            color: #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        .floating-card {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 14px;
            padding: 14px 16px;
            backdrop-filter: blur(6px);
            animation: floatY 4s ease-in-out infinite;
        }
        .floating-card.delay {
            animation-delay: 1.2s;
        }
        @keyframes floatY {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .feature {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(2, 6, 23, .15);
            transition: transform .2s ease;
            background: var(--card);
        }
        .feature:hover {
            transform: translateY(-4px);
        }
        .section-wrap {
            background: #ffffff;
            border-radius: 14px;
            padding: 24px;
        }
    </style>
</head>
<body>
<?php include('navbar_home.php'); ?>

<div class="container py-4">
    <div class="hero mb-4">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="mb-3">Library Management System</h1>
                <p class="lead mb-4">A modern platform to manage books, users, requests, and circulation records with clarity and speed.</p>
                <a href="signup.php" class="btn btn-info mr-2"><i class="fa-solid fa-user-plus"></i> Register</a>
                <a href="user_login.php" class="btn btn-outline-light"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <div class="floating-card mb-3">
                    <strong><i class="fa-solid fa-book-open"></i> Smart Catalog</strong>
                    <div>Track books, categories, and authors from one panel.</div>
                </div>
                <div class="floating-card delay">
                    <strong><i class="fa-solid fa-chart-line"></i> Admin Analytics</strong>
                    <div>Monitor users, issued books, and pending requests.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-wrap mb-4">
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#features">Features</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#policies">Policies</a></li>
        </ul>
        <div class="tab-content">
            <div id="features" class="tab-pane fade show active">
                <div class="row">
                    <div class="col-md-4 mb-3"><div class="feature p-3 h-100"><h5>Book Issuing</h5><p class="mb-0">Issue and return flow with due tracking and status visibility.</p></div></div>
                    <div class="col-md-4 mb-3"><div class="feature p-3 h-100"><h5>User Portal</h5><p class="mb-0">Students can browse, request books, and check dues quickly.</p></div></div>
                    <div class="col-md-4 mb-3"><div class="feature p-3 h-100"><h5>Admin Control</h5><p class="mb-0">Manage inventory, users, requests, and feedback centrally.</p></div></div>
                </div>
            </div>
            <div id="policies" class="tab-pane fade">
                <div class="alert alert-primary mb-2">Default borrow duration is 30 days.</div>
                <div class="alert alert-warning mb-0">Late returns are recorded in dues and visible in admin monitoring.</div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("sw.js").catch(function () {});
}
</script>
</body>
</html>
