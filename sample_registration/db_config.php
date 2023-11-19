<?php
// Database configuration
$dbHost = "localhost"; // Replace with your database host
$dbUsername = "root"; // Replace with your database username
$dbPassword = ""; // Replace with your database password
$dbName = "patient_users"; // Replace with your database name

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
