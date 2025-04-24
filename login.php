<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $q = $conn->query("SELECT * FROM users WHERE email='$email'");
  if ($q->num_rows > 0) {
    $user = $q->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      $role = $user['role'];
      if ($role == 'candidate') {
        echo "<script>window.location.href='dashboard_candidate.php';</script>";
      } else {
        echo "<script>window.location.href='dashboard_employer.php';</script>";
      }
    } else {
      echo "<script>alert('Wrong password');</script>";
    }
  } else {
    echo "<script>alert('User not found');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; text-align: center; }
    form { background: white; padding: 30px; margin: 50px auto; width: 300px; border-radius: 10px; box-shadow: 0 0 10px gray; }
    input { width: 90%; padding: 10px; margin: 10px 0; }
    button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
