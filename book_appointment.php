<?php
session_start();
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $service_id = $_POST['service'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in
    $name = $_POST['name'];
    $email = $_POST['email'];
    $appointment_date = $_POST['date'];
    $appointment_time = $_POST['time'];
    $status = 'pending'; // Set the default status to 'pending'
    $payment_status = 'unpaid'; // Default payment status

    // Check if the service, name, email, date, and time are not empty
    if (!empty($service_id) && !empty($name) && !empty($email) && !empty($appointment_date) && !empty($appointment_time)) {
        // Prepare SQL query to insert the appointment into the database
        $stmt = $conn->prepare("INSERT INTO appointments (user_id, service_id, appointment_date, status, payment_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $user_id, $service_id, $appointment_date, $status, $payment_status);

        // Execute the query
        if ($stmt->execute()) {
            // Appointment added successfully
            echo "<p>Appointment booked successfully!</p>";
            // Redirect to a confirmation page or back to home
            header("Location: index.php?status=success");
            exit();
        } else {
            echo "<p>There was an error booking your appointment. Please try again.</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>All fields are required. Please fill out all fields.</p>";
    }
}

$conn->close();
?>