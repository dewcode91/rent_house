<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/users">👥 Users</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/admin/properties">🏠 Properties</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/reviews">⭐ Reviews</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/property_types">🏷️ Property Types</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/pages">📄 Pages</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Properties</h1>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="propertySearch" class="form-control form-control-sm" placeholder="Search properties...">
                        </div>
                        <div class="col-md-6">
                            <select id="propertyStatus" class="form-select form-select-sm">
                                <option value="">All Statuses</option>
                                <option value="available">Available</option>
                                <option value="rented">Rented</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($properties)): ?>
                            <?php foreach ($properties as $property): ?>
                                <tr>
                                    <td><?php echo $property['id']; ?></td>
                                    <td><?php echo htmlspecialchars($property['title']); ?></td>
                                    <td><?php echo htmlspecialchars($property['owner_name'] ?? 'N/A'); ?></td>
                                    <td>$<?php echo number_format($property['price'], 0); ?></td>
                                    <td><?php echo htmlspecialchars($property['property_type'] ?? 'N/A'); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $property['status'] === 'available' ? 'success' : ($property['status'] === 'rented' ? 'warning' : 'secondary'); ?>">
                                            <?php echo ucfirst($property['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($property['created_at'])); ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>/properties/<?php echo $property['id']; ?>" class="btn btn-sm btn-info" target="_blank">View</a>
                                        <a href="<?php echo SITE_URL; ?>/admin/edit_property?id=<?php echo $property['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?php echo SITE_URL; ?>/admin/delete_property?id=<?php echo $property['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No properties found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (!empty($pagination) && ($pagination['total_pages'] > 1)): ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($pagination['current_page'] > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1">First</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $pagination['current_page'] - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                            <li class="page-item <?php echo ($i == $pagination['current_page']) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $pagination['current_page'] + 1; ?>">Next</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $pagination['total_pages']; ?>">Last</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
