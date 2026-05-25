<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/properties">🏠 My Properties</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/add_property">➕ Add Property</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/owner/inquiries">📧 Inquiries</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Inquiries</h1>

            <div class="card">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Property</th>
                            <th>Tenant</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($inquiries)): ?>
                            <?php foreach ($inquiries as $inquiry): ?>
                                <tr>
                                    <td><?php echo $inquiry['id']; ?></td>
                                    <td><?php echo htmlspecialchars($inquiry['property_title'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($inquiry['tenant_name']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($inquiry['message'], 0, 50)); ?>...</td>
                                    <td>
                                        <span class="badge bg-<?php echo $inquiry['status'] === 'answered' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($inquiry['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($inquiry['created_at'])); ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>/owner/answer_inquiry?id=<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-primary">View</a>
                                        <a href="<?php echo SITE_URL; ?>/owner/delete_inquiry?id=<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No inquiries</td>
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
