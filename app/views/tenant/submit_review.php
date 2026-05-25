<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Submit Review</h1>

            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body p-5">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="property_id" class="form-label">Select Property</label>
                            <select class="form-select" id="property_id" name="property_id" required>
                                <option value="">-- Select a Property --</option>
                                <?php if (!empty($properties)): ?>
                                    <?php foreach ($properties as $property): ?>
                                        <option value="<?php echo $property['id']; ?>" <?php echo isset($_POST['property_id']) && $_POST['property_id'] == $property['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($property['title']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rating5" name="rating" value="5" <?php echo isset($_POST['rating']) && $_POST['rating'] == '5' ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="rating5" style="cursor: pointer; font-size: 1.5rem;">
                                        ★★★★★ (5 Stars)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rating4" name="rating" value="4" <?php echo isset($_POST['rating']) && $_POST['rating'] == '4' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="rating4" style="cursor: pointer; font-size: 1.5rem;">
                                        ★★★★☆ (4 Stars)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rating3" name="rating" value="3" <?php echo isset($_POST['rating']) && $_POST['rating'] == '3' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="rating3" style="cursor: pointer; font-size: 1.5rem;">
                                        ★★★☆☆ (3 Stars)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rating2" name="rating" value="2" <?php echo isset($_POST['rating']) && $_POST['rating'] == '2' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="rating2" style="cursor: pointer; font-size: 1.5rem;">
                                        ★★☆☆☆ (2 Stars)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rating1" name="rating" value="1" <?php echo isset($_POST['rating']) && $_POST['rating'] == '1' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="rating1" style="cursor: pointer; font-size: 1.5rem;">
                                        ★☆☆☆☆ (1 Star)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Review</label>
                            <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Share your experience about this property..." required><?php echo htmlspecialchars($_POST['comment'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                            <a href="<?php echo SITE_URL; ?>/tenant/reviews" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
