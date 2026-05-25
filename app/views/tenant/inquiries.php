<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/dashboard">📊 Dashboard</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/tenant/inquiries">📧 My Inquiries</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/reviews">⭐ My Reviews</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/profile">👤 Profile</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>My Inquiries</h1>
                <a href="<?php echo SITE_URL; ?>/tenant/submit_inquiry" class="btn btn-primary">+ New Inquiry</a>
            </div>

            <div class="card">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Property</th>
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
                                    <td><?php echo htmlspecialchars(substr($inquiry['message'], 0, 50)); ?>...</td>
                                    <td>
                                        <span class="badge bg-<?php echo $inquiry['status'] === 'answered' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($inquiry['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($inquiry['created_at'])); ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>/tenant/inquiries/<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?php echo SITE_URL; ?>/tenant/delete_inquiry?id=<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No inquiries yet</td>
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
