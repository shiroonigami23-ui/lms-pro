<?php
session_start();
require("functions.php");
if (!isset($_SESSION['email'])) {
    header("location:user_login.php");
    exit();
}

$issued = (int)get_user_issue_book_count();
$available = (int)get_book_count();
$requests = (int)get_request_count();
$dues = (int)get_dues_count();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard | LMS Pro</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: linear-gradient(135deg,#0f172a,#1d4ed8); min-height: 100vh; }
        .panel { background: rgba(255,255,255,.97); border-radius: 16px; box-shadow: 0 14px 32px rgba(0,0,0,.2); }
        .stat { border-radius: 12px; padding: 16px; background: #f8fafc; border-left: 5px solid #0ea5e9; }
        .stat h5 { margin: 0; font-size: .95rem; color: #334155; }
        .stat .val { font-size: 1.8rem; font-weight: 700; color: #0f172a; }
        .quick-btn { border-radius: 999px; }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container py-4">
    <div class="panel p-4 mb-3">
        <h3 class="mb-2">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h3>
        <p class="mb-0 text-muted">Manage your books, requests, dues, and profile from one clean dashboard.</p>
    </div>

    <div class="panel p-4 mb-3">
        <div class="row">
            <div class="col-md-3 mb-3"><div class="stat"><h5>Issued Books</h5><div class="val"><?php echo $issued; ?></div></div></div>
            <div class="col-md-3 mb-3"><div class="stat"><h5>Available Books</h5><div class="val"><?php echo $available; ?></div></div></div>
            <div class="col-md-3 mb-3"><div class="stat"><h5>Your Requests</h5><div class="val"><?php echo $requests; ?></div></div></div>
            <div class="col-md-3 mb-3"><div class="stat"><h5>Dues</h5><div class="val"><?php echo $dues; ?></div></div></div>
        </div>
    </div>

    <div class="panel p-4">
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#actions">Quick Actions</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#insights">Insights</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#help">Help</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="actions">
                <div class="row">
                    <div class="col-md-4 mb-2"><a class="btn btn-primary btn-block quick-btn" href="avail_books.php">Browse Books</a></div>
                    <div class="col-md-4 mb-2"><a class="btn btn-success btn-block quick-btn" href="view_issued_book.php">Issued Books</a></div>
                    <div class="col-md-4 mb-2"><a class="btn btn-warning btn-block quick-btn" href="show_requests.php">Request Status</a></div>
                    <div class="col-md-4 mb-2"><a class="btn btn-danger btn-block quick-btn" href="show_dues.php">Clear Dues</a></div>
                    <div class="col-md-4 mb-2"><a class="btn btn-info btn-block quick-btn" href="feedback.php">Send Feedback</a></div>
                    <div class="col-md-4 mb-2"><a class="btn btn-dark btn-block quick-btn" href="view_profile.php">View Profile</a></div>
                </div>
            </div>
            <div class="tab-pane fade" id="insights">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="card p-3 border-0 shadow-sm">
                            <h5 class="mb-3">Your Activity Snapshot</h5>
                            <canvas id="userChart" height="110"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <div class="card p-3 border-0 shadow-sm">
                            <h5 class="mb-2">Status</h5>
                            <p class="mb-2">Current requests: <b><?php echo $requests; ?></b></p>
                            <p class="mb-2">Pending dues: <b><?php echo $dues; ?></b></p>
                            <p class="mb-0">Issued books in hand: <b><?php echo $issued; ?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="help">
                <p class="mb-2"><b>Borrowing Policy:</b> Books are issued for 30 days.</p>
                <p class="mb-2"><b>Renewal:</b> Contact admin before due date if extension is needed.</p>
                <p class="mb-0"><b>Tip:</b> Use request section for limited stock and track approval status from requests page.</p>
            </div>
        </div>
    </div>
</div>
<script>
new Chart(document.getElementById('userChart'), {
    type: 'doughnut',
    data: {
        labels: ['Issued', 'Requests', 'Dues', 'Available'],
        datasets: [{
            data: [<?php echo $issued; ?>, <?php echo $requests; ?>, <?php echo $dues; ?>, <?php echo $available; ?>],
            backgroundColor: ['#10b981','#f59e0b','#ef4444','#3b82f6']
        }]
    },
    options: { responsive: true }
});
</script>
</body>
</html>
