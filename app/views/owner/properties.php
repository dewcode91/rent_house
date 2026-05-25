<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/dashboard">📊 Dashboard</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/owner/properties">🏠 My Properties</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/add_property">➕ Add Property</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/inquiries">📧 Inquiries</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>My Properties</h1>
                <a href="<?php echo SITE_URL; ?>/owner/add_property" class="btn btn-primary">+ Add Property</a>
            </div>

            <div class="row">
                <?php if (!empty($properties)): ?>
                    <?php foreach ($properties as $property): ?>
                        <div class="col-md-6 mb-4">
                            <div class="property-card">
                                <?php if ($property['property_image']): ?>
                                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $property['property_image']; ?>" alt="Property" class="property-image">
                                <?php else: ?>
                                    <div class="property-image" style="background: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 300\"><rect fill=\"%23e9ecef\" width=\"400\" height=\"300\"/><text x=\"200\" y=\"150\" font-size=\"24\" text-anchor=\"middle\" dy=\".3em\" fill=\"%236c757d\">No Image</text></svg>')"></div>
                                <?php endif; ?>
                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                                        <span class="badge bg-<?php echo $property['status'] === 'available' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($property['status']); ?>
                                        </span>
                                    </div>
                                    <p class="text-muted mb-2"><?php echo htmlspecialchars($property['city']); ?></p>
                                    <p class="property-price mb-3">$<?php echo number_format($property['price'], 0); ?>/month</p>
                                    <div class="row text-center mb-3">
                                        <div class="col-4"><small class="text-muted">Beds: <?php echo $property['bedrooms']; ?></small></div>
                                        <div class="col-4"><small class="text-muted">Baths: <?php echo $property['bathrooms']; ?></small></div>
                                        <div class="col-4"><small class="text-muted">Area: <?php echo $property['area']; ?></small></div>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo SITE_URL; ?>/owner/edit_property?id=<?php echo $property['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?php echo SITE_URL; ?>/properties/<?php echo $property['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="<?php echo SITE_URL; ?>/owner/delete_property?id=<?php echo $property['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            You haven't added any properties yet. <a href="<?php echo SITE_URL; ?>/owner/add_property">Add your first property</a>
                        </div>
                    </div>
                <?php endif; ?>
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
