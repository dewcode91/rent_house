<?php include __DIR__ . '/layout/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Welcome to <?php echo SITE_NAME; ?></h1>
        <p class="lead">Find your perfect rental property or list yours today</p>
        <div class="mt-4">
            <a href="<?php echo SITE_URL; ?>/properties" class="btn btn-light btn-lg me-2">Browse Properties</a>
            <?php if (!Auth::isOwner()): ?>
                <a href="<?php echo SITE_URL; ?>/register" class="btn btn-outline-light btn-lg">List Your Property</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<div class="container mb-5">
    <h2 class="text-center mb-4">Featured Properties</h2>
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
                                <span class="badge bg-primary"><?php echo htmlspecialchars($property['property_type']); ?></span>
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
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/properties" class="btn btn-outline-primary btn-lg">View All Properties</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No properties available at the moment.</div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
