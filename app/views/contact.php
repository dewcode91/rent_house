<?php include __DIR__ . '/layout/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Contact Us</h1>
        <p class="lead">Get in touch with our team</p>
    </div>
</section>

<div class="container section">
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2 class="mb-4">Send us a Message</h2>
            <form method="POST" action="<?php echo SITE_URL; ?>/contact" id="contactForm">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" name="phone">
                </div>
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-paper-plane me-2"></i>Send Message
                </button>
            </form>
        </div>
        <div class="col-md-6">
            <h2 class="mb-4">Contact Information</h2>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-map-marker-alt text-primary me-2"></i>Address</h5>
                    <p class="card-text">123 Main Street, Suite 100<br>New York, NY 10001<br>United States</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-phone text-primary me-2"></i>Phone</h5>
                    <p class="card-text">
                        <a href="tel:+15551234567" class="text-decoration-none">+1 (555) 123-4567</a><br>
                        <a href="tel:+15559876543" class="text-decoration-none">+1 (555) 987-6543</a>
                    </p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-envelope text-primary me-2"></i>Email</h5>
                    <p class="card-text">
                        <a href="mailto:info@renthouse.com" class="text-decoration-none">info@renthouse.com</a><br>
                        <a href="mailto:support@renthouse.com" class="text-decoration-none">support@renthouse.com</a>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-clock text-primary me-2"></i>Business Hours</h5>
                    <p class="card-text">
                        Monday - Friday: 9:00 AM - 6:00 PM<br>
                        Saturday: 10:00 AM - 4:00 PM<br>
                        Sunday: Closed
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
