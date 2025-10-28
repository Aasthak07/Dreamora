<?php
$page_title = 'Home';
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5 py-lg-7">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">Premium Digital Products for Your Creative Journey</h1>
                <p class="lead mb-4">Discover high-quality digital assets, templates, and resources to bring your creative projects to life.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#featured-products" class="btn btn-light btn-lg px-4">Explore Products</a>
                    <a href="#how-it-works" class="btn btn-outline-light btn-lg px-4">How It Works</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= SITE_URL ?>/assets/images/hero-illustration.svg" alt="Digital Products" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 py-lg-7">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; line-height: 80px;">
                            <i class="bi bi-download fs-3"></i>
                        </div>
                        <h3 class="h5 mb-3">Instant Download</h3>
                        <p class="text-muted mb-0">Get immediate access to your purchases and start using them right away.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; line-height: 80px;">
                            <i class="bi bi-shield-check fs-3"></i>
                        </div>
                        <h3 class="h5 mb-3">Premium Quality</h3>
                        <p class="text-muted mb-0">Carefully curated digital assets created by professional designers.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; line-height: 80px;">
                            <i class="bi bi-headset fs-3"></i>
                        </div>
                        <h3 class="h5 mb-3">24/7 Support</h3>
                        <p class="text-muted mb-0">Our dedicated support team is always here to help you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section id="featured-products" class="py-5 py-lg-7 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Featured Products</h2>
            <p class="text-muted">Check out our most popular digital products</p>
        </div>
        
        <div class="row g-4">
            <?php
            // Sample products - In a real app, this would come from the database
            $products = [
                [
                    'id' => 1,
                    'name' => 'Creative Business Template',
                    'price' => '29.99',
                    'image' => 'product1.jpg',
                    'category' => 'Templates'
                ],
                [
                    'id' => 2,
                    'name' => 'Minimal UI Kit',
                    'price' => '39.99',
                    'image' => 'product2.jpg',
                    'category' => 'UI Kits'
                ],
                [
                    'id' => 3,
                    'name' => 'Social Media Pack',
                    'price' => '19.99',
                    'image' => 'product3.jpg',
                    'category' => 'Graphics'
                ],
                [
                    'id' => 4,
                    'name' => 'Font Collection',
                    'price' => '24.99',
                    'image' => 'product4.jpg',
                    'category' => 'Fonts'
                ]
            ];
            
            foreach ($products as $product):
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="card product-card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="<?= SITE_URL ?>/assets/images/products/<?= $product['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="product-badge bg-primary text-white"><?= $product['category'] ?></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="text-muted small mb-2"><?= $product['category'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0 text-primary">$<?= number_format($product['price'], 2) ?></span>
                            <a href="product-details.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="products.php" class="btn btn-primary btn-lg px-4">View All Products</a>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="py-5 py-lg-7">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">How It Works</h2>
            <p class="text-muted">Get started in just a few simple steps</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center px-3">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">1</div>
                    <h4 class="h5 mb-3">Browse Products</h4>
                    <p class="text-muted mb-0">Explore our collection of premium digital products and find what you need.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center px-3">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">2</div>
                    <h4 class="h5 mb-3">Make a Purchase</h4>
                    <p class="text-muted mb-0">Add items to your cart and complete the secure checkout process.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center px-3">
                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">3</div>
                    <h4 class="h5 mb-3">Download & Use</h4>
                    <p class="text-muted mb-0">Instantly download your files and start using them in your projects.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 py-lg-7 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Ready to Get Started?</h2>
        <p class="lead mb-5">Join thousands of creatives who trust Dreamora for their digital product needs.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="register.php" class="btn btn-light btn-lg px-4">Create Free Account</a>
            <a href="contact.php" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 py-lg-7 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">What Our Customers Say</h2>
            <p class="text-muted">Don't just take our word for it</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-4">"The quality of the templates is outstanding. They've saved me countless hours of work and my clients love the professional results."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle me-3" width="50" height="50" alt="Sarah Johnson">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Freelance Designer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-4">"I've been using Dreamora for all my digital asset needs. The variety and quality are unmatched, and the support is excellent."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" class="rounded-circle me-3" width="50" height="50" alt="Michael Chen">
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">Creative Director</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <p class="mb-4">"Great selection of digital products at reasonable prices. The instant download feature is a huge time-saver!"</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/67.jpg" class="rounded-circle me-3" width="50" height="50" alt="Emily Rodriguez">
                            <div>
                                <h6 class="mb-0">Emily Rodriguez</h6>
                                <small class="text-muted">Small Business Owner</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="py-5 py-lg-7">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">Stay Updated</h2>
                <p class="lead text-muted mb-5">Subscribe to our newsletter to receive updates on new products, special offers, and more.</p>
                
                <form class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                            <button class="btn btn-primary px-4" type="submit">Subscribe</button>
                        </div>
                        <div class="form-text mt-2">We respect your privacy. Unsubscribe at any time.</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
