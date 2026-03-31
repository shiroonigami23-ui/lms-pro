<?php
require("functions.php");
session_start();
if(!isset($_SESSION['email'])) {
    header("location:index.php");
    exit();
}

$users = (int)get_user_count();
$books = (int)get_book_count();
$categories = (int)get_category_count();
$authors = (int)get_author_count();
$issued = (int)get_issue_book_count();
$requests = (int)get_request_count();
$late = (int)not_return_book_count();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard | LMS Pro</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #eef2ff; }
        .layout-wrap { display: flex; min-height: calc(100vh - 56px); }
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg,#0f172a,#1e293b);
            color: #e2e8f0;
            padding: 18px 14px;
        }
        .sidebar .brand { font-weight: 700; margin-bottom: 14px; letter-spacing: .3px; }
        .sidebar a { color: #bfdbfe; display: block; padding: 10px 12px; border-radius: 10px; margin-bottom: 6px; }
        .sidebar a:hover { background: rgba(255,255,255,.1); text-decoration: none; }
        .content { flex: 1; padding: 20px; }
        .metric-card { border: 0; border-radius: 14px; box-shadow: 0 10px 22px rgba(0,0,0,.08); }
        .metric-num { font-size: 1.9rem; font-weight: 700; }
        .card-soft { border-radius: 14px; border: 0; box-shadow: 0 10px 20px rgba(15,23,42,.08); }
        .event-item { border-bottom: 1px solid #e2e8f0; padding: 8px 0; }
        .event-item:last-child { border-bottom: 0; }
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
        <div class="brand">LMS Pro Admin</div>
        <a href="admin_dashboard.php">Dashboard Home</a>
        <a href="add_book.php">Add New Book</a>
        <a href="manage_book.php">Manage Books</a>
        <a href="add_cat.php">Add Category</a>
        <a href="manage_cat.php">Manage Category</a>
        <a href="add_author.php">Add Author</a>
        <a href="manage_author.php">Manage Author</a>
        <a href="issue_book.php">Issue Book</a>
        <a href="approval.php">Book Requests</a>
        <a href="view_not_return_book.php">Late Returns</a>
        <a href="view_feedback.php">Feedback</a>
    </aside>
    <main class="content">
        <div class="alert alert-primary mb-3">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>. Monitor daily operations from this control center.</div>
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#overview">Overview</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#actions">Quick Actions</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#insights">Insights</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="overview">
                <div class="row">
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Total Users</div><div class="metric-num"><?php echo $users; ?></div></div></div>
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Total Books</div><div class="metric-num"><?php echo $books; ?></div></div></div>
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Issued Books</div><div class="metric-num"><?php echo $issued; ?></div></div></div>
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Pending Requests</div><div class="metric-num"><?php echo $requests; ?></div></div></div>
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Categories</div><div class="metric-num"><?php echo $categories; ?></div></div></div>
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Authors</div><div class="metric-num"><?php echo $authors; ?></div></div></div>
                    <div class="col-md-3 mb-3"><div class="card metric-card p-3"><div>Late Returns</div><div class="metric-num"><?php echo $late; ?></div></div></div>
                </div>
            </div>
            <div class="tab-pane fade" id="actions">
                <div class="row">
                    <div class="col-md-3 mb-2"><a class="btn btn-success btn-block" href="Regusers.php">View Users</a></div>
                    <div class="col-md-3 mb-2"><a class="btn btn-primary btn-block" href="Regbooks.php">View Books</a></div>
                    <div class="col-md-3 mb-2"><a class="btn btn-warning btn-block" href="approval.php">Approve Requests</a></div>
                    <div class="col-md-3 mb-2"><a class="btn btn-danger btn-block" href="view_not_return_book.php">Late Returns</a></div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#advOps">Toggle Advanced Operations</button>
                    <div id="advOps" class="collapse mt-2">
                        <div class="card card-body card-soft">
                            <div class="row">
                                <div class="col-md-4 mb-2"><a class="btn btn-outline-secondary btn-block" href="add_book.php">New Book Entry</a></div>
                                <div class="col-md-4 mb-2"><a class="btn btn-outline-secondary btn-block" href="add_author.php">New Author Entry</a></div>
                                <div class="col-md-4 mb-2"><a class="btn btn-outline-secondary btn-block" href="add_cat.php">New Category Entry</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="insights">
                <div class="row">
                    <div class="col-lg-7 mb-3">
                        <div class="card card-soft p-3">
                            <h5 class="mb-3">System Snapshot</h5>
                            <canvas id="opsChart" height="120"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="card card-soft p-3">
                            <h5 class="mb-2">Today’s Focus</h5>
                            <div class="event-item">Process pending book requests: <b><?php echo $requests; ?></b></div>
                            <div class="event-item">Check late return records: <b><?php echo $late; ?></b></div>
                            <div class="event-item">Audit catalog consistency across <b><?php echo $categories; ?></b> categories.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
const chart = document.getElementById('opsChart');
new Chart(chart, {
    type: 'bar',
    data: {
        labels: ['Users', 'Books', 'Issued', 'Requests', 'Late'],
        datasets: [{
            label: 'Count',
            data: [<?php echo $users; ?>, <?php echo $books; ?>, <?php echo $issued; ?>, <?php echo $requests; ?>, <?php echo $late; ?>],
            backgroundColor: ['#2563eb','#0ea5e9','#10b981','#f59e0b','#ef4444']
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});
</script>
</body>
</html>
