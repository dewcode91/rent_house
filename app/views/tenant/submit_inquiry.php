<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Submit Inquiry</h1>

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
                                        <option value="<?php echo $property['id']; ?>" 
                                            <?php echo (isset($_GET['property_id']) && $_GET['property_id'] == $property['id']) || (isset($_POST['property_id']) && $_POST['property_id'] == $property['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($property['title']); ?> - $<?php echo number_format($property['price'], 0); ?>/month
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Ask your questions about the property..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Send Inquiry</button>
                            <a href="<?php echo SITE_URL; ?>/tenant/inquiries" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
