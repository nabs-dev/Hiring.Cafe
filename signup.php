<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];
  $conn->query("INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')");
  echo "<script>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; text-align: center; }
    form { background: white; padding: 30px; margin: 50px auto; width: 300px; border-radius: 10px; box-shadow: 0 0 10px gray; }
    input, select { width: 90%; padding: 10px; margin: 10px 0; }
    button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Signup</h2>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role" required>
      <option value="">Select Role</option>
      <option value="candidate">Candidate</option>
      <option value="employer">Employer</option>
    </select><br>
    <button type="submit">Sign Up</button>
  </form>
</body>
</html>
