<?php
/**
 * Common functions used throughout the application
 */

/**
 * Redirect to a specific URL
 */
function redirect($url) {
    header("Location: " . SITE_URL . "/" . ltrim($url, '/'));
    exit();
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if user is admin
 */
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

/**
 * Sanitize input data
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Generate a random string
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

/**
 * Upload file with validation
 */
function uploadFile($file, $targetDir, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
    $fileName = basename($file['name']);
    $targetPath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    
    // Check if file already exists
    if (file_exists($targetPath)) {
        $fileName = time() . '_' . $fileName;
        $targetPath = $targetDir . $fileName;
    }
    
    // Check file type
    if (!in_array($fileType, $allowedTypes)) {
        return ['success' => false, 'message' => 'Sorry, only ' . implode(', ', $allowedTypes) . ' files are allowed.'];
    }
    
    // Check file size (5MB max)
    if ($file['size'] > 5000000) {
        return ['success' => false, 'message' => 'Sorry, your file is too large. Max size is 5MB.'];
    }
    
    // Upload file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => true, 'file_name' => $fileName];
    } else {
        return ['success' => false, 'message' => 'Sorry, there was an error uploading your file.'];
    }
}

/**
 * Get user by ID
 */
function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Get product by ID
 */
function getProductById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND status = 'active'");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Get all active products
 */
function getAllProducts($limit = 12, $offset = 0) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE status = 'active' ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->execute([$limit, $offset]);
    return $stmt->fetchAll();
}

/**
 * Get featured products
 */
function getFeaturedProducts($limit = 4) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE status = 'active' AND is_featured = 1 ORDER BY created_at DESC LIMIT ?");
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

/**
 * Add to cart
 */
function addToCart($productId, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
    
    return true;
}

/**
 * Get cart items with details
 */
function getCartItems() {
    if (empty($_SESSION['cart'])) {
        return [];
    }
    
    global $pdo;
    $productIds = array_keys($_SESSION['cart']);
    $placeholders = str_repeat('?,', count($productIds) - 1) . '?';
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders) AND status = 'active'");
    $stmt->execute($productIds);
    $products = $stmt->fetchAll();
    
    $cartItems = [];
    $total = 0;
    
    foreach ($products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $subtotal = $product['price'] * $quantity;
        $total += $subtotal;
        
        $cartItems[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'image' => $product['image']
        ];
    }
    
    return [
        'items' => $cartItems,
        'total' => $total,
        'count' => array_sum($_SESSION['cart'])
    ];
}

/**
 * Clear cart
 */
function clearCart() {
    unset($_SESSION['cart']);
}

/**
 * Format price with currency
 */
function formatPrice($price) {
    return '₹' . number_format($price, 2);
}

/**
 * Get category name by ID
 */
function getCategoryName($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $category = $stmt->fetch();
    return $category ? $category['name'] : 'Uncategorized';
}

/**
 * Check if product is in cart
 */
function isInCart($productId) {
    return isset($_SESSION['cart'][$productId]);
}

/**
 * Get cart count
 */
function getCartCount() {
    return !empty($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
}
?>
