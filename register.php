<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Connect to DB
$conn = new mysqli("localhost", "root", "", "your_database");

if ($conn->connect_error) {
  http_response_code(500);
  echo "Database connection failed.";
  exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

$fullname = $conn->real_escape_string($data['fullname']);
$email = $conn->real_escape_string($data['email']);
$username = $conn->real_escape_string($data['username']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
  echo "Registration successful!";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
