<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<form method="post">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
</form>

<style>
    /* General styles */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right,rgb(189, 123, 125), #fad0c4);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Form container */
form {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
}

/* Input fields */
input[type="text"], 
input[type="email"], 
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: 0.3s ease-in-out;
}

/* Focus effect */
input:focus {
    border-color:rgb(161, 86, 98);
    outline: none;
}

/* Submit button */
button {
    background: rgb(161, 86, 98);
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s ease;
}

button:hover {
    background: rgb(188, 114, 120);
}

/* Responsive Design */
@media (max-width: 400px) {
    form {
        width: 90%;
    }
}
</style>