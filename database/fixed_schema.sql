-- Drop existing database and create a new one
DROP DATABASE IF EXISTS dreamora_shop;
CREATE DATABASE dreamora_shop;
USE dreamora_shop;

-- Users table (no dependencies)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    avatar VARCHAR(255),
    is_admin BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    reset_token VARCHAR(255),
    reset_token_expires DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Categories table (no dependencies)
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    short_description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    sale_price DECIMAL(10, 2),
    sku VARCHAR(100) UNIQUE,
    stock_quantity INT DEFAULT 0,
    image VARCHAR(255),
    gallery TEXT,
    file_path VARCHAR(255),
    file_size VARCHAR(50),
    file_type VARCHAR(50),
    download_limit INT DEFAULT 1,
    is_featured BOOLEAN DEFAULT FALSE,
    is_digital BOOLEAN DEFAULT TRUE,
    status ENUM('active', 'draft', 'archived') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_number VARCHAR(50) NOT NULL UNIQUE,
    subtotal DECIMAL(10, 2) NOT NULL,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    discount_amount DECIMAL(10, 2) DEFAULT 0,
    shipping_amount DECIMAL(10, 2) DEFAULT 0,
    total_amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    payment_id VARCHAR(255),
    payment_details TEXT,
    status ENUM('pending', 'processing', 'completed', 'cancelled', 'refunded') DEFAULT 'pending',
    billing_first_name VARCHAR(100),
    billing_last_name VARCHAR(100),
    billing_email VARCHAR(100),
    billing_phone VARCHAR(20),
    billing_address TEXT,
    billing_city VARCHAR(100),
    billing_state VARCHAR(100),
    billing_country VARCHAR(100),
    billing_postcode VARCHAR(20),
    notes TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    total_amount DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Downloads table
CREATE TABLE IF NOT EXISTS downloads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_item_id INT NOT NULL,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    download_token VARCHAR(255) NOT NULL UNIQUE,
    download_count INT DEFAULT 0,
    download_limit INT DEFAULT 1,
    expires_at DATETIME,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Coupons table
CREATE TABLE IF NOT EXISTS coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    discount_type ENUM('percent', 'fixed') NOT NULL,
    discount_value DECIMAL(10, 2) NOT NULL,
    min_order_amount DECIMAL(10, 2) DEFAULT 0,
    max_discount_amount DECIMAL(10, 2),
    usage_limit INT DEFAULT NULL,
    usage_count INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    start_date DATETIME,
    end_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User coupons
CREATE TABLE IF NOT EXISTS user_coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    coupon_id INT NOT NULL,
    order_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Support tickets
CREATE TABLE IF NOT EXISTS support_tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('open', 'in_progress', 'resolved', 'closed') DEFAULT 'open',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ticket replies
CREATE TABLE IF NOT EXISTS ticket_replies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    user_id INT,
    message TEXT NOT NULL,
    is_admin_reply BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- FAQ categories
CREATE TABLE IF NOT EXISTS faq_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- FAQ items
CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Settings table
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    `value` TEXT,
    `group` VARCHAR(50) DEFAULT 'general',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add foreign key constraints after all tables are created
DELIMITER //
CREATE PROCEDURE add_foreign_keys()
BEGIN
    -- Products table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'products' 
        AND CONSTRAINT_NAME = 'products_ibfk_1'
    ) THEN
        ALTER TABLE products 
        ADD CONSTRAINT products_ibfk_1 
        FOREIGN KEY (category_id) REFERENCES categories(id) 
        ON DELETE SET NULL;
    END IF;

    -- Orders table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'orders' 
        AND CONSTRAINT_NAME = 'orders_ibfk_1'
    ) THEN
        ALTER TABLE orders 
        ADD CONSTRAINT orders_ibfk_1 
        FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE SET NULL;
    END IF;

    -- Order items table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'order_items' 
        AND CONSTRAINT_NAME = 'order_items_ibfk_1'
    ) THEN
        ALTER TABLE order_items 
        ADD CONSTRAINT order_items_ibfk_1 
        FOREIGN KEY (order_id) REFERENCES orders(id) 
        ON DELETE CASCADE;
    END IF;

    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'order_items' 
        AND CONSTRAINT_NAME = 'order_items_ibfk_2'
    ) THEN
        ALTER TABLE order_items 
        ADD CONSTRAINT order_items_ibfk_2 
        FOREIGN KEY (product_id) REFERENCES products(id) 
        ON DELETE SET NULL;
    END IF;

    -- Downloads table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'downloads' 
        AND CONSTRAINT_NAME = 'downloads_ibfk_1'
    ) THEN
        ALTER TABLE downloads 
        ADD CONSTRAINT downloads_ibfk_1 
        FOREIGN KEY (order_item_id) REFERENCES order_items(id) 
        ON DELETE CASCADE;
    END IF;

    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'downloads' 
        AND CONSTRAINT_NAME = 'downloads_ibfk_2'
    ) THEN
        ALTER TABLE downloads 
        ADD CONSTRAINT downloads_ibfk_2 
        FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE CASCADE;
    END IF;

    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'downloads' 
        AND CONSTRAINT_NAME = 'downloads_ibfk_3'
    ) THEN
        ALTER TABLE downloads 
        ADD CONSTRAINT downloads_ibfk_3 
        FOREIGN KEY (product_id) REFERENCES products(id) 
        ON DELETE CASCADE;
    END IF;

    -- User coupons table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'user_coupons' 
        AND CONSTRAINT_NAME = 'user_coupons_ibfk_1'
    ) THEN
        ALTER TABLE user_coupons 
        ADD CONSTRAINT user_coupons_ibfk_1 
        FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE CASCADE;
    END IF;

    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'user_coupons' 
        AND CONSTRAINT_NAME = 'user_coupons_ibfk_2'
    ) THEN
        ALTER TABLE user_coupons 
        ADD CONSTRAINT user_coupons_ibfk_2 
        FOREIGN KEY (coupon_id) REFERENCES coupons(id) 
        ON DELETE CASCADE;
    END IF;

    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'user_coupons' 
        AND CONSTRAINT_NAME = 'user_coupons_ibfk_3'
    ) THEN
        ALTER TABLE user_coupons 
        ADD CONSTRAINT user_coupons_ibfk_3 
        FOREIGN KEY (order_id) REFERENCES orders(id) 
        ON DELETE SET NULL;
    END IF;

    -- Support tickets table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'support_tickets' 
        AND CONSTRAINT_NAME = 'support_tickets_ibfk_1'
    ) THEN
        ALTER TABLE support_tickets 
        ADD CONSTRAINT support_tickets_ibfk_1 
        FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE SET NULL;
    END IF;

    -- Ticket replies table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'ticket_replies' 
        AND CONSTRAINT_NAME = 'ticket_replies_ibfk_1'
    ) THEN
        ALTER TABLE ticket_replies 
        ADD CONSTRAINT ticket_replies_ibfk_1 
        FOREIGN KEY (ticket_id) REFERENCES support_tickets(id) 
        ON DELETE CASCADE;
    END IF;

    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'ticket_replies' 
        AND CONSTRAINT_NAME = 'ticket_replies_ibfk_2'
    ) THEN
        ALTER TABLE ticket_replies 
        ADD CONSTRAINT ticket_replies_ibfk_2 
        FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE SET NULL;
    END IF;

    -- FAQ items table
    IF NOT EXISTS (
        SELECT * FROM information_schema.TABLE_CONSTRAINTS 
        WHERE CONSTRAINT_SCHEMA = 'dreamora_shop' 
        AND TABLE_NAME = 'faqs' 
        AND CONSTRAINT_NAME = 'faqs_ibfk_1'
    ) THEN
        ALTER TABLE faqs 
        ADD CONSTRAINT faqs_ibfk_1 
        FOREIGN KEY (category_id) REFERENCES faq_categories(id) 
        ON DELETE SET NULL;
    END IF;
END //
DELIMITER ;

-- Call the procedure to add foreign keys
CALL add_foreign_keys();

-- Drop the procedure after use
DROP PROCEDURE IF EXISTS add_foreign_keys;

-- Insert default admin user (password: admin123)
INSERT IGNORE INTO users (id, name, email, password, is_admin, is_active) 
VALUES (1, 'Admin', 'admin@dreamora.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE, TRUE)
ON DUPLICATE KEY UPDATE 
    name = VALUES(name),
    email = VALUES(email),
    password = VALUES(password),
    is_admin = VALUES(is_admin),
    is_active = VALUES(is_active),
    updated_at = CURRENT_TIMESTAMP;

-- Insert default settings
INSERT IGNORE INTO settings (`key`, `value`, `group`) VALUES 
('site_name', 'Dreamora Digital Shop', 'general'),
('site_email', 'admin@dreamora.com', 'general'),
('site_phone', '+1234567890', 'general'),
('site_address', '123 Digital Street, Tech City', 'general'),
('currency', 'INR', 'payment'),
('currency_symbol', '₹', 'payment'),
('tax_rate', '18.00', 'tax'),
('tax_name', 'GST', 'tax'),
('payment_methods', '["razorpay", "paypal", "stripe"]', 'payment'),
('razorpay_key_id', '', 'payment'),
('razorpay_key_secret', '', 'payment'),
('stripe_publishable_key', '', 'payment'),
('stripe_secret_key', '', 'payment'),
('paypal_client_id', '', 'payment'),
('paypal_secret', '', 'payment'),
('paypal_mode', 'sandbox', 'payment'),
('smtp_host', '', 'email'),
('smtp_port', '587', 'email'),
('smtp_username', '', 'email'),
('smtp_password', '', 'email'),
('smtp_encryption', 'tls', 'email'),
('from_email', 'noreply@dreamora.com', 'email'),
('from_name', 'Dreamora Shop', 'email')
ON DUPLICATE KEY UPDATE 
    `value` = VALUES(`value`),
    `group` = VALUES(`group`),
    updated_at = CURRENT_TIMESTAMP;
