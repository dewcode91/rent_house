<?php include __DIR__ . '/layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body p-5">
                    <h3 class="card-title text-center mb-4">Login</h3>

                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $field => $error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    </form>

                    <hr>

                    <p class="text-center mb-0">
                        Don't have an account? <a href="<?php echo SITE_URL; ?>/register">Register here</a>
                    </p>
                </div>
            </div>

            <!-- Default Credentials -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title">Default Credentials</h6>
                    <p class="mb-2"><strong>Admin:</strong><br>Email: admin@rent.com<br>Pass: password123</p>
                    <p class="mb-2"><strong>Owner:</strong><br>Email: owner@rent.com<br>Pass: password123</p>
                    <p class="mb-0"><strong>Tenant:</strong><br>Email: tenant@rent.com<br>Pass: password123</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
