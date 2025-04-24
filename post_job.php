<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'employer') {
  echo "<script>window.location.href='login.php';</script>"; exit;
}
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $company = $_POST['company'];
  $description = $_POST['description'];
  $employer_id = $_SESSION['user']['id'];
  $conn->query("INSERT INTO jobs (title, company, description, employer_id) VALUES ('$title', '$company', '$description', $employer_id)");
  echo "<script>alert('Job posted successfully!'); window.location.href='dashboard_employer.php';</script>"; exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Post Job</title>
  <style>
    body { font-family: Arial; background: #f2f2f2; }
    form { width: 60%; margin: auto; margin-top: 60px; background: white; padding: 30px; border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input[type=text], textarea {
      width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit] {
      background: #007bff; color: white; padding: 10px 20px; border: none;
      border-radius: 5px; cursor: pointer;
    }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Post a New Job</h2>
    <input type="text" name="title" placeholder="Job Title" required>
    <input type="text" name="company" placeholder="Company Name" required>
    <textarea name="description" placeholder="Job Description" required></textarea>
    <input type="submit" value="Post Job">
  </form>
</body>
</html>
