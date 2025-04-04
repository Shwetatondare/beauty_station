<?php
// Include the database connection file
include 'db_connect.php';

// Check if the connection is successful
if ($conn) {
    echo "✅ Database connected successfully!";
} else {
    echo "❌ Database connection failed: " . $conn->connect_error;
}
?>