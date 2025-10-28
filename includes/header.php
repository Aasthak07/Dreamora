<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$is_home = ($current_page == 'index' || $current_page == 'home');
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?><?= SITE_NAME ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= SITE_URL ?>/assets/images/favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/theme.css" id="theme-style">
    
    <!-- Mobile Specific CSS -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/mobile.css" media="screen and (max-width: 991.98px)">
    
    <!-- Desktop Specific CSS -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/desktop.css" media="screen and (min-width: 992px)">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar bg-primary text-white py-2 d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="top-bar-left">
                        <span><i class="bi bi-envelope me-2"></i> support@dreamora.com</span>
                        <span class="ms-3"><i class="bi bi-phone me-2"></i> +91 1234567890</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="top-bar-right text-md-end">
                        <?php if (isLoggedIn()): ?>
                            <a href="<?= SITE_URL ?>/profile.php" class="text-white me-3">
                                <i class="bi bi-person me-1"></i> My Account
                            </a>
                            <a href="<?= SITE_URL ?>/logout.php" class="text-white">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </a>
                        <?php else: ?>
                            <a href="<?= SITE_URL ?>/login.php" class="text-white me-3">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                            <a href="<?= SITE_URL ?>/register.php" class="text-white">
                                <i class="bi bi-person-plus me-1"></i> Register
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-primary" href="<?= SITE_URL ?>">
                <img src="<?= SITE_URL ?>/assets/images/logo.png" alt="<?= SITE_NAME ?>" height="40" class="d-inline-block align-top">
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Desktop Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $is_home ? 'active' : '' ?>" href="<?= SITE_URL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_URL ?>/products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_URL ?>/categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_URL ?>/pricing.php">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_URL ?>/contact.php">Contact</a>
                    </li>
                    <?php if (isAdmin()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="<?= SITE_URL ?>/admin">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= SITE_URL ?>/admin/products.php">Products</a></li>
                            <li><a class="dropdown-item" href="<?= SITE_URL ?>/admin/orders.php">Orders</a></li>
                            <li><a class="dropdown-item" href="<?= SITE_URL ?>/admin/users.php">Users</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= SITE_URL ?>/admin/settings.php">Settings</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <!-- Search and Cart -->
                <div class="d-flex align-items-center">
                    <!-- Search Form -->
                    <form class="d-none d-md-flex me-3" action="<?= SITE_URL ?>/search.php" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" placeholder="Search products..." aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Cart -->
                    <div class="position-relative">
                        <a href="<?= SITE_URL ?>/cart.php" class="btn btn-outline-primary position-relative">
                            <i class="bi bi-cart3"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= getCartCount() ?>
                                <span class="visually-hidden">items in cart</span>
                            </span>
                        </a>
                    </div>
                    
                    <!-- Theme Toggle -->
                    <button class="btn btn-link text-dark ms-2" id="theme-toggle">
                        <i class="bi bi-moon-fill"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Offcanvas Menu -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarOffcanvasLabel"><?= SITE_NAME ?></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= $is_home ? 'active' : '' ?>" href="<?= SITE_URL ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/pricing.php">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/contact.php">Contact</a>
                        </li>
                        <?php if (isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>/admin">Admin Panel</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    
                    <!-- Mobile Search Form -->
                    <form class="mt-3 mb-3" action="<?= SITE_URL ?>/search.php" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" placeholder="Search products..." aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Mobile User Menu -->
                    <div class="d-grid gap-2">
                        <?php if (isLoggedIn()): ?>
                            <a href="<?= SITE_URL ?>/profile.php" class="btn btn-outline-primary">
                                <i class="bi bi-person me-1"></i> My Account
                            </a>
                            <a href="<?= SITE_URL ?>/orders.php" class="btn btn-outline-secondary">
                                <i class="bi bi-bag-check me-1"></i> My Orders
                            </a>
                            <a href="<?= SITE_URL ?>/logout.php" class="btn btn-outline-danger">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </a>
                        <?php else: ?>
                            <a href="<?= SITE_URL ?>/login.php" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login / Register
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Page Content -->
    <main class="main-content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
