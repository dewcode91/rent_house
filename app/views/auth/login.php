<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Role Selection Cards -->
            <div class="text-center mb-5">
                <h2 class="mb-2">Login to Your Account</h2>
                <p class="text-muted">Select your role to proceed</p>
            </div>

            <div class="row mb-5">
                <!-- Admin Login -->
                <div class="col-md-4 mb-4">
                    <a href="#adminLogin" class="text-decoration-none" data-role="admin">
                        <div class="card role-card" style="min-height: 200px; border: 2px solid #2563eb; cursor: pointer; transition: all 0.3s;">
                            <div class="card-body text-center">
                                <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Admin</h5>
                                <p class="card-text text-muted">Platform Administrator Login</p>
                                <span class="badge bg-primary">Manage All</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Owner Login -->
                <div class="col-md-4 mb-4">
                    <a href="#ownerLogin" class="text-decoration-none" data-role="owner">
                        <div class="card role-card" style="min-height: 200px; border: 2px solid #10b981; cursor: pointer; transition: all 0.3s;">
                            <div class="card-body text-center">
                                <i class="fas fa-building fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Owner</h5>
                                <p class="card-text text-muted">Property Owner Login</p>
                                <span class="badge bg-success">List Properties</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Tenant Login -->
                <div class="col-md-4 mb-4">
                    <a href="#tenantLogin" class="text-decoration-none" data-role="tenant">
                        <div class="card role-card" style="min-height: 200px; border: 2px solid #f59e0b; cursor: pointer; transition: all 0.3s;">
                            <div class="card-body text-center">
                                <i class="fas fa-user fa-3x text-warning mb-3"></i>
                                <h5 class="card-title">Tenant</h5>
                                <p class="card-text text-muted">Tenant/Renter Login</p>
                                <span class="badge bg-warning">Browse & Inquire</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Login Form -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0" id="roleTitle">Select a role to login</h4>
                        </div>
                        <div class="card-body p-5">
                            <?php if (!empty($errors)): ?>
                                <?php foreach ($errors as $field => $error): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <?php echo $error; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <form method="POST" id="loginForm">
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email Address
                                    </label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" required 
                                        placeholder="Enter your email">
                                    <small class="text-muted">We'll never share your email.</small>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required
                                        placeholder="Enter your password">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="<?php echo SITE_URL; ?>/password-reset" class="text-decoration-none small">
                                        Forgot Password?
                                    </a>
                                </div>
                            </form>

                            <hr class="my-4">

                            <p class="text-center mb-0">
                                Don't have an account? 
                                <a href="<?php echo SITE_URL; ?>/register" class="text-primary fw-bold">
                                    Register here
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Default Credentials Info -->
                    <div class="alert alert-info mt-4">
                        <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Demo Credentials</h6>
                        <hr class="my-2">
                        <div class="row small">
                            <div class="col-md-6">
                                <strong>Admin:</strong><br>
                                📧 admin@rent.com<br>
                                🔑 password123
                            </div>
                            <div class="col-md-6">
                                <strong>Owner:</strong><br>
                                📧 owner@rent.com<br>
                                🔑 password123
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="small">
                            <strong>Tenant:</strong><br>
                            📧 tenant@rent.com<br>
                            🔑 password123
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Role selection functionality
    document.querySelectorAll('.role-card').forEach(card => {
        card.addEventListener('click', function(e) {
            e.preventDefault();
            const role = this.closest('a').getAttribute('data-role');
            
            // Update form styling
            document.querySelectorAll('.role-card').forEach(c => {
                c.parentElement.style.opacity = '0.5';
            });
            this.parentElement.style.opacity = '1';
            
            // Update title
            const roleTitles = {
                'admin': '🔐 Admin Login',
                'owner': '🏢 Owner Login',
                'tenant': '👤 Tenant Login'
            };
            document.getElementById('roleTitle').textContent = roleTitles[role];
        });
    });
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
