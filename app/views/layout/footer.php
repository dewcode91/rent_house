    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>About <?php echo SITE_NAME; ?></h5>
                    <p>A complete property rental management system connecting property owners and tenants.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SITE_URL; ?>/about" class="text-white-50 text-decoration-none">About Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/contact" class="text-white-50 text-decoration-none">Contact Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/privacy" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p class="text-white-50">
                        Email: contact@rent.com<br>
                        Phone: +1-800-RENT-NOW
                    </p>
                </div>
            </div>
            <hr class="bg-white-50">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="text-white-50">&copy; 2024 <?php echo SITE_NAME; ?>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Close alerts automatically after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.remove();
                }, 5000);
            });
        });
    </script>
</body>
</html>
