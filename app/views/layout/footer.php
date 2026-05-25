    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <h5><?php echo SITE_NAME; ?></h5>
                    <p class="text-muted">Your trusted platform for property rental management.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SITE_URL; ?>" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/properties" class="text-white text-decoration-none">Properties</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/about" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/contact" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>For Owners</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SITE_URL; ?>/register" class="text-white text-decoration-none">List Your Property</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/login" class="text-white text-decoration-none">Owner Login</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/about" class="text-white text-decoration-none">How It Works</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>123 Main Street, City</li>
                        <li><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope me-2"></i>info@renthouse.com</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted mb-0">&copy; 2024 <?php echo SITE_NAME; ?>. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?php echo SITE_URL; ?>/privacy" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to current nav link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && currentPath.includes(href.replace('<?php echo SITE_URL; ?>', '')) || currentPath === href)) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
