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
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
    
    <style>
        /* Additional inline styles for critical elements */
        .navbar-brand {
            position: relative;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        
        .navbar-brand::after {
            content: '✦';
            position: absolute;
            top: -5px;
            right: -15px;
            color: var(--color-accent-3);
            font-size: 1rem;
            animation: sparkle 2s infinite;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        .nav-link {
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link.active {
            font-weight: 600;
            color: var(--color-accent-1) !important;
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.6rem;
            padding: 0.25em 0.5em;
            border-radius: 50%;
            background: var(--color-accent-1);
            color: white;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container px-0 px-md-4 d-flex justify-content-end align-items-center">
            <div class="d-flex align-items-center">
                <span class="me-3"><i class="bi bi-envelope me-1"></i> support@dreamora.com</span>
                <span><i class="bi bi-telephone me-1"></i> +91 1234567890</span>
            </div>
            <?php if (!isLoggedIn()): ?>
            <div class="d-none d-md-flex align-items-center">
                <a href="<?= SITE_URL ?>/login.php" class="text-white text-decoration-none me-3 d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
                <a href="<?= SITE_URL ?>/register.php" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-person-plus me-1"></i> Register
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid px-3 px-lg-4">
            <!-- Brand with Sparkle -->
            <a class="navbar-brand d-flex align-items-center" href="<?= SITE_URL ?>">
                <img src="<?= SITE_URL ?>/assets/images/logo.png" alt="<?= SITE_NAME ?>" height="40" class="d-inline-block align-top">
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" 
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Navigation -->
                <ul class="navbar-nav w-100 d-flex justify-content-between mb-3 mb-lg-0">
                    <li class="nav-item flex-grow-1 text-center">
                        <a class="nav-link <?= $is_home ? 'active' : '' ?> px-3" href="<?= SITE_URL ?>">
                            <i class="bi bi-house-door d-md-none me-2"></i>Home
                        </a>
                    </li>
                    <li class="nav-item flex-grow-1 text-center">
                        <a class="nav-link px-3" href="<?= SITE_URL ?>/products.php">
                            <i class="bi bi-collection d-md-none me-2"></i>Products
                        </a>
                    </li>
                    <li class="nav-item flex-grow-1 text-center">
                        <a class="nav-link px-3" href="<?= SITE_URL ?>/categories.php">
                            <i class="bi bi-tags d-md-none me-2"></i>Categories
                        </a>
                    </li>
                    <li class="nav-item flex-grow-1 text-center">
                        <a class="nav-link px-3" href="<?= SITE_URL ?>/pricing.php">
                            <i class="bi bi-tag d-md-none me-2"></i>Pricing
                        </a>
                    </li>
                    <li class="nav-item flex-grow-1 text-center">
                        <a class="nav-link px-3" href="<?= SITE_URL ?>/contact.php">
                            <i class="bi bi-envelope d-md-none me-2"></i>Contact
                        </a>
                    </li>
                </ul>
                
                <!-- Right Side Navigation -->
                <div class="d-flex align-items-center ms-auto">
                    <!-- Search Form (Desktop) -->
                    <form class="d-none d-md-flex me-3" action="<?= SITE_URL ?>/search.php" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="search" class="form-control form-control-sm" placeholder="Search..." name="q" 
                                   aria-label="Search" style="min-width: 200px;">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Cart -->
                    <a href="<?= SITE_URL ?>/cart.php" class="btn btn-link text-dark position-relative me-3">
                        <i class="bi bi-cart3 fs-5"></i>
                        <?php if (isLoggedIn() && ($cart_count = getCartCount()) > 0): ?>
                            <span class="cart-badge">
                                <?= $cart_count > 9 ? '9+' : $cart_count ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    
                    <!-- User Dropdown -->
                    <?php if (isLoggedIn()): ?>
                        <div class="dropdown">
                            <a class="btn btn-link text-dark dropdown-toggle d-flex align-items-center p-0" 
                               href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" 
                               aria-expanded="false">
                                <div class="position-relative">
                                    <i class="bi bi-person-circle fs-4"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                        <span class="visually-hidden">User online</span>
                                    </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                                <li>
                                    <div class="d-flex align-items-center px-3 py-2 border-bottom">
                                        <i class="bi bi-person-circle fs-3 text-primary me-2"></i>
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></div>
                                            <small class="text-muted"><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></small>
                                        </div>
                                    </div>
                                </li>
                                <li><a class="dropdown-item py-2" href="<?= SITE_URL ?>/profile.php">
                                    <i class="bi bi-person me-2"></i>My Profile
                                </a></li>
                                <li><a class="dropdown-item py-2" href="<?= SITE_URL ?>/orders.php">
                                    <i class="bi bi-bag-check me-2"></i>My Orders
                                </a></li>
                                <?php if (isAdmin()): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header text-uppercase small fw-bold">Admin Panel</h6></li>
                                    <li><a class="dropdown-item py-2" href="<?= SITE_URL ?>/admin">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a></li>
                                    <li><a class="dropdown-item py-2" href="<?= SITE_URL ?>/admin/products.php">
                                        <i class="bi bi-box-seam me-2"></i>Products
                                    </a></li>
                                    <li><a class="dropdown-item py-2" href="<?= SITE_URL ?>/admin/orders.php">
                                        <i class="bi bi-cart-check me-2"></i>Orders
                                    </a></li>
                                    <li><a class="dropdown-item py-2" href="<?= SITE_URL ?>/admin/users.php">
                                        <i class="bi bi-people me-2"></i>Users
                                    </a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="<?= SITE_URL ?>/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="d-none d-md-flex gap-2">
                            <a href="<?= SITE_URL ?>/login.php" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                            <a href="<?= SITE_URL ?>/register.php" class="btn btn-primary btn-sm">
                                <i class="bi bi-person-plus me-1"></i>Register
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Search Form -->
    <div class="container px-0 px-md-4 d-md-none py-2">
        <form class="d-flex" action="<?= SITE_URL ?>/search.php" method="GET">
            <div class="input-group">
                <input type="search" class="form-control form-control-sm" placeholder="Search products..." name="q" 
                       aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
    
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
