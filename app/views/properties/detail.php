<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">
            <?php if (!empty($property)): ?>
                <!-- Property Image -->
                <?php if ($property['property_image']): ?>
                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $property['property_image']; ?>" alt="Property" class="img-fluid mb-4" style="max-height: 400px; object-fit: cover; width: 100%; border-radius: 8px;">
                <?php else: ?>
                    <div class="bg-light mb-4" style="height: 400px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <span class="text-muted">No Image Available</span>
                    </div>
                <?php endif; ?>

                <!-- Property Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title mb-3"><?php echo htmlspecialchars($property['title']); ?></h1>
                        <p class="text-muted mb-3"><?php echo htmlspecialchars($property['city']); ?></p>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h3 class="property-price">$<?php echo number_format($property['price'], 0); ?>/month</h3>
                            </div>
                            <div class="col-md-6 text-end">
                                <span class="badge bg-primary">Status: <?php echo ucfirst($property['status']); ?></span>
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($property['property_type'] ?? 'N/A'); ?></span>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <h6>Bedrooms</h6>
                                <p class="h5"><?php echo $property['bedrooms']; ?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Bathrooms</h6>
                                <p class="h5"><?php echo $property['bathrooms']; ?></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Area</h6>
                                <p class="h5"><?php echo $property['area']; ?> sqft</p>
                            </div>
                            <div class="col-md-3">
                                <h6>Owner</h6>
                                <p class="h5"><?php echo htmlspecialchars($property['owner_name'] ?? 'N/A'); ?></p>
                            </div>
                        </div>

                        <hr>

                        <h4 class="mb-3">Description</h4>
                        <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Reviews</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <div class="mb-4 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6><?php echo htmlspecialchars($review['reviewer_name']); ?></h6>
                                            <span class="rating">
                                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                                    ★
                                                <?php endfor; ?>
                                                <?php for ($i = $review['rating']; $i < 5; $i++): ?>
                                                    ☆
                                                <?php endfor; ?>
                                            </span>
                                        </div>
                                        <small class="text-muted"><?php echo date('M d, Y', strtotime($review['created_at'])); ?></small>
                                    </div>
                                    <p class="mt-2 mb-0"><?php echo htmlspecialchars($review['comment']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No reviews yet.</p>
                        <?php endif; ?>

                        <?php if (Auth::check() && Auth::user()['role'] === 'tenant'): ?>
                            <hr>
                            <h6>Leave a Review</h6>
                            <form method="POST" action="<?php echo SITE_URL; ?>/properties/<?php echo $property['id']; ?>/review">
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <select class="form-select" id="rating" name="rating" required>
                                        <option value="">-- Select Rating --</option>
                                        <option value="5">5 Stars ★★★★★</option>
                                        <option value="4">4 Stars ★★★★☆</option>
                                        <option value="3">3 Stars ★★★☆☆</option>
                                        <option value="2">2 Stars ★★☆☆☆</option>
                                        <option value="1">1 Star ★☆☆☆☆</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        <?php elseif (!Auth::check()): ?>
                            <p class="text-muted mt-3"><a href="<?php echo SITE_URL; ?>/login">Login</a> to leave a review.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Inquiry Button -->
                <?php if (Auth::check() && Auth::user()['role'] === 'tenant'): ?>
                    <div class="mt-4">
                        <a href="<?php echo SITE_URL; ?>/tenant/submit_inquiry?property_id=<?php echo $property['id']; ?>" class="btn btn-success btn-lg">Submit Inquiry</a>
                    </div>
                <?php elseif (!Auth::check()): ?>
                    <div class="mt-4 alert alert-info">
                        <a href="<?php echo SITE_URL; ?>/login">Login</a> to submit an inquiry about this property.
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-warning">Property not found.</div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="sidebar">
                <h5 class="mb-3">Quick Info</h5>
                <?php if (!empty($property)): ?>
                    <ul class="list-unstyled">
                        <li class="mb-2"><strong>Type:</strong> <?php echo htmlspecialchars($property['property_type'] ?? 'N/A'); ?></li>
                        <li class="mb-2"><strong>City:</strong> <?php echo htmlspecialchars($property['city']); ?></li>
                        <li class="mb-2"><strong>Price:</strong> $<?php echo number_format($property['price'], 0); ?>/month</li>
                        <li class="mb-2"><strong>Status:</strong> <?php echo ucfirst($property['status']); ?></li>
                        <li class="mb-2"><strong>Posted:</strong> <?php echo date('M d, Y', strtotime($property['created_at'])); ?></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
