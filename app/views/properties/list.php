<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Browse Properties</h1>
        <p class="lead">Find your perfect rental property</p>
    </div>
</section>

<div class="container section">
    <div class="row mb-4">
        <div class="col-md-3">
            <!-- Filters can be added here -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Search Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="<?php echo SITE_URL; ?>/properties">
                        <div class="mb-3">
                            <label class="form-label">Property Type</label>
                            <select class="form-select" name="type">
                                <option value="">All Types</option>
                                <option value="apartment">Apartment</option>
                                <option value="house">House</option>
                                <option value="condo">Condo</option>
                                <option value="townhouse">Townhouse</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Price</label>
                            <input type="number" class="form-control" name="max_price" placeholder="Enter max price">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php if (!empty($properties)): ?>
                <div class="row">
                    <?php foreach ($properties as $property): ?>
                        <div class="col-md-6 mb-4">
                            <div class="property-card">
                                <?php if ($property['property_image']): ?>
                                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo htmlspecialchars($property['property_image']); ?>" alt="Property" class="property-image">
                                <?php else: ?>
                                    <div class="property-image bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-white" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="p-4">
                                    <h5 class="card-title"><?php echo htmlspecialchars($property['title']); ?></h5>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <?php echo htmlspecialchars($property['city']); ?>, <?php echo htmlspecialchars($property['state'] ?? ''); ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="property-price">$<?php echo number_format($property['price'], 0); ?>/mo</span>
                                        <span class="badge bg-primary"><?php echo htmlspecialchars($property['property_type']); ?></span>
                                    </div>
                                    <div class="row text-center mb-3">
                                        <div class="col-4">
                                            <small class="text-muted"><i class="fas fa-bed me-1"></i><?php echo $property['bedrooms']; ?> Bed</small>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted"><i class="fas fa-bath me-1"></i><?php echo $property['bathrooms']; ?> Bath</small>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted"><i class="fas fa-ruler-combined me-1"></i><?php echo $property['area']; ?> sqft</small>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3"><?php echo htmlspecialchars(substr($property['description'], 0, 100)); ?>...</p>
                                    <a href="<?php echo SITE_URL; ?>/properties/<?php echo $property['id']; ?>" class="btn btn-primary w-100">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo SITE_URL; ?>/properties?page=1">First</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo SITE_URL; ?>/properties?page=<?php echo $currentPage - 1; ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php 
                            $start = max(1, $currentPage - 2);
                            $end = min($totalPages, $currentPage + 2);
                            for ($i = $start; $i <= $end; $i++): 
                            ?>
                                <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                                    <a class="page-link" href="<?php echo SITE_URL; ?>/properties?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo SITE_URL; ?>/properties?page=<?php echo $currentPage + 1; ?>">Next</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo SITE_URL; ?>/properties?page=<?php echo $totalPages; ?>">Last</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No properties available at the moment. Please check back soon!
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
