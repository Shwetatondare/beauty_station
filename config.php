<?php
// Site configuration
define('SITE_NAME', 'Beauty Station');
define('SITE_URL', 'http://localhost/website');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'website');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>