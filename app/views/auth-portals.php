<?php include __DIR__ . '/layout/header.php'; ?>

<!-- Quick Access Section -->
<section class="bg-light py-5 mt-5">
    <div class="container">
        <h2 class="text-center mb-5">Quick Access</h2>
        <div class="row">
            <!-- Admin Portal -->
            <div class="col-md-4 mb-4">
                <div class="card border-primary h-100 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <i class="fas fa-lock fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Admin Portal</h5>
                        <p class="card-text text-muted">Access the administrative dashboard</p>
                        <a href="<?php echo SITE_URL; ?>/login" class="btn btn-primary btn-sm">
                            <i class="fas fa-sign-in-alt me-2"></i>Admin Login
                        </a>
                    </div>
                </div>
            </div>

            <!-- Owner Portal -->
            <div class="col-md-4 mb-4">
                <div class="card border-success h-100 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-2x text-success mb-3"></i>
                        <h5 class="card-title">Owner Portal</h5>
                        <p class="card-text text-muted">List and manage your properties</p>
                        <a href="<?php echo SITE_URL; ?>/login" class="btn btn-success btn-sm">
                            <i class="fas fa-sign-in-alt me-2"></i>Owner Login
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tenant Portal -->
            <div class="col-md-4 mb-4">
                <div class="card border-warning h-100 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <i class="fas fa-user fa-2x text-warning mb-3"></i>
                        <h5 class="card-title">Tenant Portal</h5>
                        <p class="card-text text-muted">Browse properties and inquire</p>
                        <a href="<?php echo SITE_URL; ?>/login" class="btn btn-warning btn-sm">
                            <i class="fas fa-sign-in-alt me-2"></i>Tenant Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/layout/footer.php'; ?>
