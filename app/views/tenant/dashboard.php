<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/tenant/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/inquiries">📧 My Inquiries</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/reviews">⭐ My Reviews</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/profile">👤 Profile</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Tenant Dashboard</h1>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Total Inquiries</h6>
                            <h2 class="mb-0" style="color: #007bff;">
                                <?php echo $stats['total_inquiries'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Answered</h6>
                            <h2 class="mb-0" style="color: #28a745;">
                                <?php echo $stats['answered_inquiries'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Reviews</h6>
                            <h2 class="mb-0" style="color: #ffc107;">
                                <?php echo $stats['total_reviews'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Recent Inquiries</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($recent_inquiries)): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($recent_inquiries as $inquiry): ?>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1"><?php echo htmlspecialchars($inquiry['property_title'] ?? 'N/A'); ?></h6>
                                                    <small class="text-muted">Submitted <?php echo date('M d, Y', strtotime($inquiry['created_at'])); ?></small>
                                                </div>
                                                <span class="badge bg-<?php echo $inquiry['status'] === 'answered' ? 'success' : 'warning'; ?>">
                                                    <?php echo ucfirst($inquiry['status']); ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">No inquiries yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Quick Links</h5>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo SITE_URL; ?>/properties" class="btn btn-primary w-100 mb-2">Browse Properties</a>
                            <a href="<?php echo SITE_URL; ?>/tenant/submit_inquiry" class="btn btn-success w-100 mb-2">Submit Inquiry</a>
                            <a href="<?php echo SITE_URL; ?>/tenant/submit_review" class="btn btn-info w-100">Submit Review</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
