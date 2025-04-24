<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'candidate') {
  echo "<script>window.location.href='login.php';</script>"; exit;
}
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");

if ($_FILES['resume']['error'] == 0) {
  $filename = "resumes/" . time() . "_" . basename($_FILES['resume']['name']);
  move_uploaded_file($_FILES['resume']['tmp_name'], $filename);
  $user_id = $_SESSION['user']['id'];
  $check = $conn->query("SELECT * FROM candidates WHERE user_id=$user_id");
  if ($check->num_rows > 0) {
    $conn->query("UPDATE candidates SET resume='$filename' WHERE user_id=$user_id");
  } else {
    $conn->query("INSERT INTO candidates (user_id, resume) VALUES ($user_id, '$filename')");
  }
}
echo "<script>alert('Resume uploaded.'); window.location.href='dashboard_candidate.php';</script>";
?>
