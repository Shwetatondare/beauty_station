<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "User not found.";
    }
    $stmt->close();
}
?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<style>
    /* Center the form on the page */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #ff9a9e, #fad0c4);
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
    width: 300px;
}

/* Input fields */
input[type="email"], 
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: 0.3s ease-in-out;
}

/* Focus effect */
input[type="email"]:focus, 
input[type="password"]:focus {
    border-color:rgb(161, 86, 98);
    outline: none;
}

/* Submit button */
button {
    background:rgb(161, 86, 98);
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
    background:rgb(188, 114, 120);
}

/* Responsive Design */
@media (max-width: 400px) {
    form {
        width: 90%;
    }
}
</style>