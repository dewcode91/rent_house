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
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/property_types">🏷️ Property Types</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/admin/pages">📄 Pages</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h1 class="mb-4">Edit Page</h1>

            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($page['title'] ?? $_POST['title'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="<?php echo htmlspecialchars($page['slug'] ?? $_POST['slug'] ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="8" required><?php echo htmlspecialchars($page['content'] ?? $_POST['content'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="draft" <?php echo (isset($page['status']) && $page['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo (isset($page['status']) && $page['status'] === 'published') ? 'selected' : ''; ?>>Published</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Page</button>
                            <a href="<?php echo SITE_URL; ?>/admin/pages" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
