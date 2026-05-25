<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Properties</h1>

            <!-- Search and Filter -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" placeholder="Search by title or city" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="type">
                                <option value="">All Types</option>
                                <?php if (!empty($propertyTypes)): ?>
                                    <?php foreach ($propertyTypes as $type): ?>
                                        <option value="<?php echo $type['id']; ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $type['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($type['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="min_price" placeholder="Min Price" value="<?php echo htmlspecialchars($_GET['min_price'] ?? ''); ?>">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="max_price" placeholder="Max Price" value="<?php echo htmlspecialchars($_GET['max_price'] ?? ''); ?>">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="<?php echo SITE_URL; ?>/properties" class="btn btn-secondary">Clear</a>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!empty($properties)): ?>
                <div class="row">
                    <?php foreach ($properties as $property): ?>
                        <div class="col-md-4 mb-4">
                            <div class="property-card">
                                <?php if ($property['property_image']): ?>
                                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $property['property_image']; ?>" alt="Property" class="property-image">
                                <?php else: ?>
                                    <div class="property-image" style="background: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 300\"><rect fill=\"%23e9ecef\" width=\"400\" height=\"300\"/><text x=\"200\" y=\"150\" font-size=\"24\" text-anchor=\"middle\" dy=\".3em\" fill=\"%236c757d\">No Image</text></svg>')"></div>
                                <?php endif; ?>
                                <div class="p-4">
                                    <h5 class="card-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                                    <p class="text-muted"><?php echo htmlspecialchars($property['city']); ?></p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="property-price">$<?php echo number_format($property['price'], 0); ?></span>
                                        <span class="badge bg-primary"><?php echo htmlspecialchars($property['property_type'] ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="row text-center mb-3">
                                        <div class="col-4"><small class="text-muted">Bed: <?php echo $property['bedrooms']; ?></small></div>
                                        <div class="col-4"><small class="text-muted">Bath: <?php echo $property['bathrooms']; ?></small></div>
                                        <div class="col-4"><small class="text-muted">Area: <?php echo $property['area']; ?> sqft</small></div>
                                    </div>
                                    <a href="<?php echo SITE_URL; ?>/properties/<?php echo $property['id']; ?>" class="btn btn-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if (!empty($pagination) && ($pagination['total_pages'] > 1)): ?>
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <?php if ($pagination['current_page'] > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=1<?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">First</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $pagination['current_page'] - 1; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                                <li class="page-item <?php echo ($i == $pagination['current_page']) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $pagination['current_page'] + 1; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Next</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $pagination['total_pages']; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Last</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">No properties found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
