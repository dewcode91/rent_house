<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/users">👥 Users</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/properties">🏠 Properties</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/admin/reviews">⭐ Reviews</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/property_types">🏷️ Property Types</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/pages">📄 Pages</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Reviews</h1>

            <div class="card">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Property</th>
                            <th>Reviewer</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <tr>
                                    <td><?php echo $review['id']; ?></td>
                                    <td><?php echo htmlspecialchars($review['property_title'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($review['reviewer_name']); ?></td>
                                    <td>
                                        <span class="rating">
                                            <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                                ★
                                            <?php endfor; ?>
                                            <?php for ($i = $review['rating']; $i < 5; $i++): ?>
                                                ☆
                                            <?php endfor; ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars(substr($review['comment'], 0, 50)); ?>...</td>
                                    <td><?php echo date('M d, Y', strtotime($review['created_at'])); ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>/admin/view_review?id=<?php echo $review['id']; ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?php echo SITE_URL; ?>/admin/delete_review?id=<?php echo $review['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No reviews found</td>
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
