<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/admin/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/users">👥 Users</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/properties">🏠 Properties</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/reviews">⭐ Reviews</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/property_types">🏷️ Property Types</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/pages">📄 Pages</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Admin Dashboard</h1>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Total Users</h6>
                            <h2 class="mb-0" style="color: #007bff;">
                                <?php echo $stats['total_users'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Total Properties</h6>
                            <h2 class="mb-0" style="color: #28a745;">
                                <?php echo $stats['total_properties'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Total Reviews</h6>
                            <h2 class="mb-0" style="color: #ffc107;">
                                <?php echo $stats['total_reviews'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Active Properties</h6>
                            <h2 class="mb-0" style="color: #dc3545;">
                                <?php echo $stats['active_properties'] ?? 0; ?>
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
                            <h5 class="mb-0">Recent Properties</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($recent_properties)): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($recent_properties as $property): ?>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-0"><?php echo htmlspecialchars($property['title']); ?></h6>
                                                    <small class="text-muted"><?php echo htmlspecialchars($property['owner_name'] ?? 'N/A'); ?></small>
                                                </div>
                                                <span class="badge bg-secondary"><?php echo ucfirst($property['status']); ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">No recent properties.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Recent Users</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($recent_users)): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($recent_users as $user): ?>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-0"><?php echo htmlspecialchars($user['name']); ?></h6>
                                                    <small class="text-muted"><?php echo $user['email']; ?></small>
                                                </div>
                                                <span class="badge bg-info"><?php echo ucfirst($user['role']); ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">No recent users.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
