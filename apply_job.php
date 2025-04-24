<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'candidate') {
  echo "<script>window.location.href='login.php';</script>"; exit;
}
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
$job_id = $_POST['job_id'];
$user_id = $_SESSION['user']['id'];
$res = $conn->query("SELECT resume FROM candidates WHERE user_id=$user_id");
$data = $res->fetch_assoc();
$resume = $data['resume'];

$already_applied = $conn->query("SELECT * FROM applications WHERE user_id=$user_id AND job_id=$job_id");
if ($already_applied->num_rows == 0) {
  $conn->query("INSERT INTO applications (user_id, job_id, resume) VALUES ($user_id, $job_id, '$resume')");
  echo "<script>alert('Application submitted!'); window.location.href='dashboard_candidate.php';</script>";
} else {
  echo "<script>alert('You already applied!'); window.location.href='dashboard_candidate.php';</script>";
}
?>
