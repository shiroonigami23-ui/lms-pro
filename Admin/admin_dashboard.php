<?php
require("functions.php");
session_start();
if(!isset($_SESSION['email'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard | LMS Pro</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style>
        body { background: #f1f5f9; }
        .layout-wrap { display: flex; min-height: calc(100vh - 56px); }
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg,#0f172a,#1e293b);
            color: #e2e8f0;
            padding: 18px 14px;
        }
        .sidebar a { color: #bfdbfe; display: block; padding: 8px 10px; border-radius: 8px; }
        .sidebar a:hover { background: rgba(255,255,255,.08); text-decoration: none; }
        .content { flex: 1; padding: 18px; }
        .metric-card { border: 0; border-radius: 14px; box-shadow: 0 6px 16px rgba(0,0,0,.08); }
        .metric-num { font-size: 1.8rem; font-weight: 700; }
        @media (max-width: 992px) {
            .layout-wrap { display: block; }
            .sidebar { width: 100%; }
        }
    </style>
</head>
<body>
<?php include('navbar.php');?>
<div class="layout-wrap">
    <aside class="sidebar">
        <h5 class="mb-3">Control Center</h5>
        <a href="add_book.php">Add New Book</a>
        <a href="manage_book.php">Manage Books</a>
        <a href="add_cat.php">Add Category</a>
        <a href="manage_cat.php">Manage Category</a>
        <a href="add_author.php">Add Author</a>
        <a href="manage_author.php">Manage Author</a>
        <a href="issue_book.php">Issue Book</a>
        <a href="approval.php">Book Requests</a>
        <a href="view_feedback.php">Feedback</a>
    </aside>
    <main class="content">
        <div class="alert alert-primary mb-3">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>. You can monitor students, issues, returns, and requests from this panel.</div>
        <ul class="nav nav-tabs mb-3" id="dashTabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#overview">Overview</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#operations">Operations</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="overview">
                <div class="row">
                    <div class="col-md-4 mb-3"><div class="card metric-card p-3"><div>Total Users</div><div class="metric-num" id="metric_users"><?php echo get_user_count(); ?></div></div></div>
                    <div class="col-md-4 mb-3"><div class="card metric-card p-3"><div>Total Books</div><div class="metric-num" id="metric_books"><?php echo get_book_count(); ?></div></div></div>
                    <div class="col-md-4 mb-3"><div class="card metric-card p-3"><div>Categories</div><div class="metric-num" id="metric_categories"><?php echo get_category_count(); ?></div></div></div>
                    <div class="col-md-4 mb-3"><div class="card metric-card p-3"><div>Authors</div><div class="metric-num" id="metric_authors"><?php echo get_author_count(); ?></div></div></div>
                    <div class="col-md-4 mb-3"><div class="card metric-card p-3"><div>Issued Books</div><div class="metric-num" id="metric_issued"><?php echo get_issue_book_count(); ?></div></div></div>
                    <div class="col-md-4 mb-3"><div class="card metric-card p-3"><div>Pending Requests</div><div class="metric-num" id="metric_requests"><?php echo get_request_count(); ?></div></div></div>
                </div>
            </div>
            <div class="tab-pane fade" id="operations">
                <p>
                    <a class="btn btn-outline-dark" data-toggle="collapse" href="#quickOps" role="button">Toggle Quick Operations</a>
                </p>
                <div class="collapse show" id="quickOps">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2"><a class="btn btn-success btn-block" href="Regusers.php">View Users</a></div>
                            <div class="col-md-3 mb-2"><a class="btn btn-primary btn-block" href="Regbooks.php">View Books</a></div>
                            <div class="col-md-3 mb-2"><a class="btn btn-warning btn-block" href="view_not_return_book.php">Late Returns</a></div>
                            <div class="col-md-3 mb-2"><a class="btn btn-danger btn-block" href="approval.php">Approve Requests</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    // Cache metrics for faster perceived reloads.
    const metrics = {
        users: document.getElementById('metric_users').textContent.trim(),
        books: document.getElementById('metric_books').textContent.trim(),
        categories: document.getElementById('metric_categories').textContent.trim(),
        authors: document.getElementById('metric_authors').textContent.trim(),
        issued: document.getElementById('metric_issued').textContent.trim(),
        requests: document.getElementById('metric_requests').textContent.trim()
    };
    localStorage.setItem('lms_admin_metrics', JSON.stringify(metrics));
</script>
</body>
</html>
