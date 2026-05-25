<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h2 class="mb-2">Create Your Account</h2>
                <p class="text-muted">Join our platform and start managing your properties or find your ideal rental</p>
            </div>

            <div class="row mb-5">
                <!-- Owner Register -->
                <div class="col-md-6 mb-4">
                    <a href="#ownerReg" class="text-decoration-none" onclick="selectRole('owner'); return false;">
                        <div class="card role-card" style="min-height: 180px; border: 2px solid #10b981; cursor: pointer; transition: all 0.3s;">
                            <div class="card-body text-center">
                                <i class="fas fa-building fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Property Owner</h5>
                                <p class="card-text text-muted small">List and manage your properties</p>
                                <span class="badge bg-success">List Properties</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Tenant Register -->
                <div class="col-md-6 mb-4">
                    <a href="#tenantReg" class="text-decoration-none" onclick="selectRole('tenant'); return false;">
                        <div class="card role-card" style="min-height: 180px; border: 2px solid #f59e0b; cursor: pointer; transition: all 0.3s;">
                            <div class="card-body text-center">
                                <i class="fas fa-user fa-3x text-warning mb-3"></i>
                                <h5 class="card-title">Tenant/Renter</h5>
                                <p class="card-text text-muted small">Browse and rent properties</p>
                                <span class="badge bg-warning">Find Properties</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header bg-success text-white text-center">
                            <h4 class="mb-0" id="roleTitle">Select your role to register</h4>
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

                            <form method="POST" id="registerForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Full Name
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" required 
                                        placeholder="Enter your full name">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email Address
                                    </label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" required 
                                        placeholder="Enter your email">
                                    <small class="text-muted">We'll never share your email.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2"></i>Phone Number
                                    </label>
                                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone" 
                                        placeholder="Enter your phone number">
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required
                                        placeholder="Create a strong password">
                                    <small class="text-muted">Minimum 6 characters</small>
                                </div>

                                <input type="hidden" id="role" name="role" value="tenant">

                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="agree" required>
                                    <label class="form-check-label" for="agree">
                                        I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                    </label>
                                </div>
                            </form>

                            <hr class="my-4">

                            <p class="text-center mb-0">
                                Already have an account? 
                                <a href="<?php echo SITE_URL; ?>/login" class="text-success fw-bold">
                                    Login here
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectRole(role) {
        document.getElementById('role').value = role;
        
        // Update UI
        document.querySelectorAll('.role-card').forEach(card => {
            card.parentElement.style.opacity = '0.5';
        });
        event.target.closest('.card').parentElement.style.opacity = '1';
        
        // Update title
        const roleTitles = {
            'owner': '🏢 Register as Property Owner',
            'tenant': '👤 Register as Tenant'
        };
        document.getElementById('roleTitle').textContent = roleTitles[role];
    }
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
