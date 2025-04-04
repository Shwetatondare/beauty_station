<?php
$servername = "localhost"; // Change if your DB is hosted elsewhere
$username = "root"; // Change if using another user
$password = ""; // Change if using a password
$database = "beauty_station_db"; // Make sure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
