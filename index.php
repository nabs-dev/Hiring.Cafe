<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dbmtcx7vymui3w");
$filter = isset($_GET['type']) ? $_GET['type'] : '';
$query = "SELECT * FROM jobs";
if ($filter) $query .= " WHERE type='$filter'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Hiring Cafe - Jobs</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 0; }
    .header { background: #343a40; color: white; padding: 20px; text-align: center; }
    .filters { margin: 20px; text-align: center; }
    .filters button {
      background: #007bff; color: white; border: none; padding: 10px 20px;
      margin: 5px; cursor: pointer; border-radius: 5px;
    }
    .job { background: white; margin: 20px auto; padding: 20px; width: 80%;
      border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .job h2 { margin: 0; color: #333; }
    .job p { color: #555; }
  </style>
  <script>
    function filterJobs(type) {
      window.location.href = 'index.php?type=' + type;
    }
  </script>
</head>
<body>
  <div class="header">
    <h1>Hiring Cafe</h1>
  </div>
  <div class="filters">
    <button onclick="filterJobs('')">All</button>
    <button onclick="filterJobs('Remote')">Remote</button>
    <button onclick="filterJobs('Part-Time')">Part-Time</button>
    <button onclick="filterJobs('Full-Time')">Full-Time</button>
  </div>
  <?php while($job = $result->fetch_assoc()): ?>
    <div class="job">
      <h2><?= $job['title'] ?> - <?= $job['company'] ?></h2>
      <p><?= $job['description'] ?></p>
    </div>
  <?php endwhile; ?>
</body>
</html>
