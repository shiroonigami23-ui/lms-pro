<?php $appConfig = require __DIR__ . '/../config/app.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .lms-footer {
    background: linear-gradient(125deg, #0f172a, #1e293b 55%, #0b1120);
    color: #e2e8f0;
    border-top: 2px solid #1f2937;
  }
  .lms-footer a {
    color: #93c5fd;
    transition: color .2s ease, transform .2s ease;
  }
  .lms-footer a:hover {
    color: #f8fafc;
    transform: translateX(3px);
    text-decoration: none;
  }
  .social-row a {
    margin-right: 12px;
    font-size: 1.3rem;
  }
</style>
<footer class="lms-footer text-center mt-4">
  <section class="container text-center text-md-start pt-4 pb-2">
    <div class="row mt-2">
      <div class="col-md-4 mb-3">
        <h6 class="text-uppercase fw-bold mb-3">LMS Pro</h6>
        <p class="mb-0">A modern platform to manage books, requests, fines, users, and analytics in one place.</p>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="text-uppercase fw-bold mb-3">Useful Links</h6>
        <p class="mb-1"><a href="index.php">Home</a></p>
        <p class="mb-1"><a href="user_login.php">Login</a></p>
        <p class="mb-0"><a href="signup.php">Sign Up</a></p>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="text-uppercase fw-bold mb-3">Connect</h6>
        <div class="social-row mb-2">
          <a href="<?php echo htmlspecialchars($appConfig['social']['github']); ?>" target="_blank" rel="noopener noreferrer" title="GitHub"><i class="fa-brands fa-github"></i></a>
          <a href="<?php echo htmlspecialchars($appConfig['social']['leetcode']); ?>" target="_blank" rel="noopener noreferrer" title="LeetCode"><i class="fa-solid fa-code"></i></a>
        </div>
      </div>
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase fw-bold mb-3">Contact</h6>
        <p class="mb-1"><a href="<?php echo htmlspecialchars($appConfig['owner_location_url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($appConfig['owner_location']); ?></a></p>
        <p class="mb-1"><a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $appConfig['owner_phone']); ?>"><?php echo htmlspecialchars($appConfig['owner_phone']); ?></a></p>
        <p class="mb-1"><a href="mailto:<?php echo htmlspecialchars($appConfig['owner_email']); ?>"><?php echo htmlspecialchars($appConfig['owner_email']); ?></a></p>
      </div>
    </div>
  </section>
  <div class="text-center py-3 border-top border-secondary">
    © <?php echo date('Y'); ?> <?php echo htmlspecialchars($appConfig['owner_name']); ?>. All rights reserved.
  </div>
</footer>
