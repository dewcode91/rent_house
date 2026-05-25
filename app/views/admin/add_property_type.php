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
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/reviews">⭐ Reviews</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/admin/property_types">🏷️ Property Types</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/pages">📄 Pages</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Add Property Type</h1>

            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create Property Type</button>
                            <a href="<?php echo SITE_URL; ?>/admin/property_types" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
