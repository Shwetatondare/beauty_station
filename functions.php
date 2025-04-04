<?php
require_once 'config.php';

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url) {
    header("Location: " . SITE_URL . '/' . ltrim($url, '/'));
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserData() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'],
            'full_name' => $_SESSION['full_name'] ?? '',
            'phone' => $_SESSION['phone'] ?? '',
            'address' => $_SESSION['address'] ?? ''
        ];
    }
    return null;
}

function validatePassword($password) {
    // At least 8 characters, 1 uppercase, 1 lowercase, 1 number
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password);
}

function displayAlert() {
    if (isset($_SESSION['success'])) {
        echo '<div class="alert success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="alert error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
}
?>