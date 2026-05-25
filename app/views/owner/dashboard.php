<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/owner/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/properties">🏠 My Properties</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/add-property">➕ Add Property</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/inquiries">📧 Inquiries</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Owner Dashboard</h1>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Total Properties</h6>
                            <h2 class="mb-0" style="color: #007bff;">
                                <?php echo $stats['total_properties'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Active Properties</h6>
                            <h2 class="mb-0" style="color: #28a745;">
                                <?php echo $stats['active_properties'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Total Inquiries</h6>
                            <h2 class="mb-0" style="color: #ffc107;">
                                <?php echo $stats['total_inquiries'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">Avg Rating</h6>
                            <h2 class="mb-0" style="color: #dc3545;">
                                <?php echo isset($stats['average_rating']) ? number_format($stats['average_rating'], 1) : 'N/A'; ?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Properties -->
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Properties</h5>
                    <a href="<?php echo SITE_URL; ?>/owner/add-property" class="btn btn-light btn-sm">+ Add Property</a>
                </div>
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Reviews</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_properties)): ?>
                            <?php foreach ($recent_properties as $property): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($property['title']); ?></td>
                                    <td><?php echo htmlspecialchars($property['property_type'] ?? 'N/A'); ?></td>
                                    <td>$<?php echo number_format($property['price'], 0); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $property['status'] === 'available' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($property['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $property['review_count'] ?? 0; ?></td>
                                    <td><?php echo date('M d, Y', strtotime($property['created_at'])); ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>/properties/<?php echo $property['id']; ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?php echo SITE_URL; ?>/owner/edit-property?id=<?php echo $property['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No properties yet</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
