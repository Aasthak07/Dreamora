<?php
session_start();
require_once 'config/config.php';
require_once 'includes/functions.php';

// Basic routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Include header
include 'includes/header.php';

// Load the requested page
$page_path = "pages/$page.php";
if (file_exists($page_path)) {
    include $page_path;
} else {
    include 'pages/404.php';
}

// Include footer
include 'includes/footer.php';
?>
