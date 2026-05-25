<?php
/**
 * Header Layout
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Property Rental Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: var(--secondary-color) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            border-bottom: 2px solid var(--primary-color);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 80px 20px;
            margin-top: 56px;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-section .lead {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }

        /* Property Cards */
        .property-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            background: white;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .property-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background-color: #e2e8f0;
        }

        .property-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .property-card .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .property-card .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Sections */
        .section {
            padding: 60px 0;
        }

        .section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2rem;
        }

        .section h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Badges */
        .badge {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
        }

        /* Forms */
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            padding: 0.75rem;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-item.active {
            color: var(--secondary-color);
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* Pagination */
        .pagination .page-link {
            color: var(--primary-color);
            border-color: #ddd;
        }

        .pagination .page-link:hover {
            background-color: #f0f4ff;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <i class="fas fa-home me-2"></i><?php echo SITE_NAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/properties">Browse Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/contact">Contact</a>
                    </li>
                    <?php if (Auth::check()): ?>
                        <?php if (Auth::isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/dashboard">Admin Dashboard</a>
                            </li>
                        <?php elseif (Auth::isOwner()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITE_URL; ?>/owner/dashboard">Owner Dashboard</a>
                            </li>
                        <?php elseif (Auth::isTenant()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITE_URL; ?>/tenant/dashboard">Tenant Dashboard</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/logout">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white ms-2" href="<?php echo SITE_URL; ?>/register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
