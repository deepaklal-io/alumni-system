<?php
// db.php — Database connection for Alumni Registration System

$host     = "localhost";
$username = "root";
$password = "";
$database = "alumni_system";

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>