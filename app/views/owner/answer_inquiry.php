<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3">
            <div class="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/dashboard">📊 Dashboard</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/properties">🏠 My Properties</a>
                    <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/add_property">➕ Add Property</a>
                    <a class="nav-link active" href="<?php echo SITE_URL; ?>/owner/inquiries">📧 Inquiries</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <a href="<?php echo SITE_URL; ?>/owner/inquiries" class="btn btn-secondary mb-3">← Back to Inquiries</a>

            <?php if (!empty($inquiry)): ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Inquiry Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6>Property</h6>
                                <p><?php echo htmlspecialchars($inquiry['property_title'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>From</h6>
                                <p><?php echo htmlspecialchars($inquiry['tenant_name']); ?><br><small class="text-muted"><?php echo htmlspecialchars($inquiry['tenant_email']); ?></small></p>
                            </div>
                        </div>

                        <hr>

                        <h6>Inquiry Message</h6>
                        <p class="bg-light p-3 rounded"><?php echo nl2br(htmlspecialchars($inquiry['message'])); ?></p>

                        <h6 class="mt-4 mb-3">Your Answer</h6>
                        <form method="POST">
                            <div class="mb-3">
                                <textarea class="form-control" name="answer" rows="5" placeholder="Type your reply here..." required><?php echo htmlspecialchars($_POST['answer'] ?? ($inquiry['answer'] ?? '')); ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Send Answer</button>
                        </form>

                        <?php if (!empty($inquiry['answer'])): ?>
                            <div class="mt-4 pt-4 border-top">
                                <h6>Your Previous Answer</h6>
                                <p class="bg-light p-3 rounded"><?php echo nl2br(htmlspecialchars($inquiry['answer'])); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Inquiry not found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
