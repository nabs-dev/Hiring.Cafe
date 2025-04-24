<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'candidate') {
  echo "<script>window.location.href='login.php';</script>"; exit;
}
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
$user_id = $_SESSION['user']['id'];
$resume_q = $conn->query("SELECT resume FROM candidates WHERE user_id=$user_id");
$resume_data = $resume_q->fetch_assoc();
$resume = $resume_data ? $resume_data['resume'] : '';
$jobs = $conn->query("SELECT * FROM jobs");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Candidate Dashboard</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; margin: 0; }
    .header { background: #007bff; color: white; padding: 15px; text-align: center; }
    .container { padding: 20px; }
    .job { background: white; padding: 15px; margin: 15px 0; border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1); }
    .job h3 { margin: 0; color: #333; }
    .job p { margin: 5px 0; color: #666; }
    button, input[type="submit"] {
      background: #28a745; color: white; border: none; padding: 10px 15px;
      border-radius: 5px; cursor: pointer;
    }
    form { margin: 10px 0; }
  </style>
</head>
<body>
  <div class="header">
    <h2>Welcome <?= $_SESSION['user']['email'] ?> | <a href="logout.php" style="color:white;">Logout</a></h2>
    <p><?= $resume ? "Resume Uploaded" : "No Resume Uploaded" ?></p>
    <form action="upload_resume.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="resume" required>
      <input type="submit" value="Upload Resume">
    </form>
  </div>
  <div class="container">
    <h2>Available Jobs</h2>
    <?php while($job = $jobs->fetch_assoc()): ?>
      <div class="job">
        <h3><?= $job['title'] ?> - <?= $job['company'] ?></h3>
        <p><?= $job['description'] ?></p>
        <form method="POST" action="apply_job.php">
          <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
          <input type="submit" value="Apply Now">
        </form>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
