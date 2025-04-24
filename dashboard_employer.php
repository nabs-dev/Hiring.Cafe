<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'employer') {
  echo "<script>window.location.href='login.php';</script>"; exit;
}
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
$employer_id = $_SESSION['user']['id'];
$jobs = $conn->query("SELECT * FROM jobs WHERE employer_id=$employer_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Employer Dashboard</title>
  <style>
    body { font-family: Arial; background: #fff; margin: 0; }
    .header { background: #343a40; color: white; padding: 15px; text-align: center; }
    .container { padding: 20px; }
    .job { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px; }
    .job h3 { margin: 0 0 10px 0; }
    .applications { background: #f9f9f9; padding: 10px; border-radius: 6px; }
    a.button {
      background: #007bff; color: white; padding: 6px 10px; text-decoration: none;
      border-radius: 5px; margin-left: 10px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h2>Welcome Employer: <?= $_SESSION['user']['email'] ?> | <a href="logout.php" style="color:white;">Logout</a></h2>
    <a href="post_job.php" class="button">Post New Job</a>
  </div>
  <div class="container">
    <h2>Your Job Listings</h2>
    <?php while($job = $jobs->fetch_assoc()): ?>
      <div class="job">
        <h3><?= $job['title'] ?> - <?= $job['company'] ?></h3>
        <p><?= $job['description'] ?></p>
        <div class="applications">
          <strong>Applications:</strong><br>
          <?php
          $job_id = $job['id'];
          $apps = $conn->query("SELECT * FROM applications a JOIN users u ON a.user_id=u.id WHERE a.job_id=$job_id");
          if ($apps->num_rows == 0) echo "No applications yet.";
          while($a = $apps->fetch_assoc()):
          ?>
            <p><?= $a['email'] ?> - <a class="button" href="<?= $a['resume'] ?>" target="_blank">View Resume</a></p>
          <?php endwhile; ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
