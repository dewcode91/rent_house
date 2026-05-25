<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Breadcrumb -->
<div class="container mt-5 pt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/properties">Properties</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($property['title']); ?></li>
        </ol>
    </nav>
</div>

<div class="container section">
    <?php if ($property): ?>
        <div class="row">
            <!-- Property Images -->
            <div class="col-md-8 mb-4">
                <?php if ($property['property_image']): ?>
                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo htmlspecialchars($property['property_image']); ?>" alt="Property" class="img-fluid rounded" style="height: 500px; object-fit: cover; width: 100%;">
                <?php else: ?>
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 500px; border-radius: 12px;">
                        <i class="fas fa-image text-white" style="font-size: 5rem;"></i>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Property Info -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-3"><?php echo htmlspecialchars($property['title']); ?></h2>
                        <p class="text-muted mb-4">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?php echo htmlspecialchars($property['city']); ?>, <?php echo htmlspecialchars($property['state'] ?? ''); ?>
                        </p>

                        <div class="mb-4">
                            <h4 class="mb-2">$<?php echo number_format($property['price'], 0); ?></h4>
                            <small class="text-muted">per month</small>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6 text-center border-end">
                                <h5 class="mb-0"><?php echo $property['bedrooms']; ?></h5>
                                <small class="text-muted">Bedrooms</small>
                            </div>
                            <div class="col-6 text-center">
                                <h5 class="mb-0"><?php echo $property['bathrooms']; ?></h5>
                                <small class="text-muted">Bathrooms</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <strong>Property Type:</strong> <span class="badge bg-primary"><?php echo htmlspecialchars($property['property_type']); ?></span>
                        </div>

                        <div class="mb-4">
                            <strong>Area:</strong> <?php echo $property['area']; ?> sqft
                        </div>

                        <div class="mb-4">
                            <strong>Status:</strong> 
                            <?php if ($property['status'] == 'available'): ?>
                                <span class="badge bg-success">Available</span>
                            <?php elseif ($property['status'] == 'rented'): ?>
                                <span class="badge bg-danger">Rented</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                            <?php endif; ?>
                        </div>

                        <?php if ($property['status'] == 'available'): ?>
                            <button class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-envelope me-2"></i>Send Inquiry
                            </button>
                        <?php endif; ?>
                        <button class="btn btn-outline-primary w-100">
                            <i class="fas fa-heart me-2"></i>Save Property
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Description</h4>
                        <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Features & Amenities</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Furnished</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Air Conditioning</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Parking</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Swimming Pool</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Gym</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Security</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Reviews</h4>
                        <?php if (!empty($avgRating)): ?>
                            <div class="mb-4">
                                <div class="mb-2">
                                    <span class="h5 me-2"><?php echo number_format($avgRating['average_rating'], 1); ?>/5</span>
                                    <small class="text-muted">(<?php echo $avgRating['review_count']; ?> reviews)</small>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($avgRating['average_rating'] / 5) * 100; ?>%;"></div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-1">
                                        <strong><?php echo htmlspecialchars($review['tenant_name'] ?? 'Anonymous'); ?></strong>
                                        <small class="text-muted"><?php echo date('M d, Y', strtotime($review['created_at'])); ?></small>
                                    </div>
                                    <div class="mb-2">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <i class="fas fa-star" style="color: <?php echo $i < $review['rating'] ? '#ffc107' : '#e9ecef'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="mb-0"><?php echo htmlspecialchars($review['review_text']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No reviews yet. Be the first to review this property!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i>
            Property not found.
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
