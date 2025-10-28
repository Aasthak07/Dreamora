<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Default XAMPP password is empty
define('DB_NAME', 'dreamora_shop');

// Site configuration
define('SITE_NAME', 'Dreamora Digital Shop');
define('SITE_URL', 'http://localhost/Dreamora');
define('ADMIN_EMAIL', 'admin@dreamora.com');

// File upload paths
define('UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Dreamora/uploads/');
define('PRODUCT_IMAGE_PATH', 'uploads/products/');

// Payment gateway configuration
define('RAZORPAY_KEY_ID', 'YOUR_RAZORPAY_KEY');
define('RAZORPAY_KEY_SECRET', 'YOUR_RAZORPAY_SECRET');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Include functions
require_once __DIR__ . '/../includes/functions.php';
?>
