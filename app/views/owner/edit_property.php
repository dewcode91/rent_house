<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/properties">🏠 My Properties</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/owner/add_property">➕ Edit Property</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/inquiries">📧 Inquiries</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Edit Property</h1>

            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($property['title'] ?? $_POST['title'] ?? ''); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="property_type_id" class="form-label">Property Type</label>
                                <select class="form-select" id="property_type_id" name="property_type_id" required>
                                    <option value="">-- Select Type --</option>
                                    <?php if (!empty($propertyTypes)): ?>
                                        <?php foreach ($propertyTypes as $type): ?>
                                            <option value="<?php echo $type['id']; ?>" <?php echo (isset($property['property_type_id']) && $property['property_type_id'] == $type['id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($type['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($property['description'] ?? $_POST['description'] ?? ''); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Monthly Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($property['price'] ?? $_POST['price'] ?? ''); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">Area (sqft)</label>
                                <input type="number" class="form-control" id="area" name="area" value="<?php echo htmlspecialchars($property['area'] ?? $_POST['area'] ?? ''); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="bedrooms" class="form-label">Bedrooms</label>
                                <input type="number" class="form-control" id="bedrooms" name="bedrooms" value="<?php echo htmlspecialchars($property['bedrooms'] ?? $_POST['bedrooms'] ?? '1'); ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="bathrooms" class="form-label">Bathrooms</label>
                                <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="<?php echo htmlspecialchars($property['bathrooms'] ?? $_POST['bathrooms'] ?? '1'); ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($property['city'] ?? $_POST['city'] ?? ''); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="property_image" class="form-label">Property Image</label>
                            <?php if (isset($property['property_image']) && $property['property_image']): ?>
                                <div class="mb-2">
                                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo htmlspecialchars($property['property_image']); ?>" alt="Property" style="max-width: 200px; max-height: 150px; border-radius: 8px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="property_image" name="property_image" accept="image/*">
                            <small class="form-text text-muted">Max size: 5MB. Allowed formats: JPG, PNG, GIF</small>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="available" <?php echo (isset($property['status']) && $property['status'] === 'available') ? 'selected' : ''; ?>>Available</option>
                                <option value="rented" <?php echo (isset($property['status']) && $property['status'] === 'rented') ? 'selected' : ''; ?>>Rented</option>
                                <option value="inactive" <?php echo (isset($property['status']) && $property['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Property</button>
                            <a href="<?php echo SITE_URL; ?>/owner/properties" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
