<?php
/**
 * Application Entry Point
 */

// Start session
session_start();

// Load configuration
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/constants.php';

// Load middleware
require_once __DIR__ . '/../app/middleware/Auth.php';

// Check session timeout
if (Auth::check()) {
    Auth::checkSessionTimeout();
}

// Load controllers
require_once __DIR__ . '/../app/controllers/MainController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/OwnerController.php';
require_once __DIR__ . '/../app/controllers/TenantController.php';

// Get the request path from REQUEST_URI
$request = trim($_SERVER['REQUEST_URI'], '/');

// Remove the base path (/rent_house) from the request
// The REQUEST_URI contains: /rent_house/login (even though routed to public/index.php)
if (strpos($request, 'rent_house/') === 0) {
    $request = substr($request, strlen('rent_house/'));
}

// Remove any remaining slashes
$request = trim($request, '/');

// Handle empty request
if (empty($request)) {
    $action = 'home';
    $param = null;
} else {
    // Parse the request
    $parts = explode('/', $request);
    $action = $parts[0] ?? 'home';
    $param = $parts[1] ?? null;
}

// Route the request
try {
    switch ($action) {
        // Auth routes
        case 'login':
            $controller = new AuthController($pdo);
            $controller->login();
            break;

        case 'register':
            $controller = new AuthController($pdo);
            $controller->register();
            break;

        case 'logout':
            $controller = new AuthController($pdo);
            $controller->logout();
            break;

        // Admin routes
        case 'admin':
            if ($param === 'dashboard') {
                $controller = new AdminController($pdo);
                $controller->dashboard();
            } elseif ($param === 'property-types') {
                $controller = new AdminController($pdo);
                $controller->propertyTypes();
            } elseif ($param === 'add-property-type') {
                $controller = new AdminController($pdo);
                $controller->addPropertyType();
            } elseif ($param === 'users') {
                $controller = new AdminController($pdo);
                $controller->users();
            } elseif ($param === 'properties') {
                $controller = new AdminController($pdo);
                $controller->properties();
            } elseif ($param === 'reviews') {
                $controller = new AdminController($pdo);
                $controller->reviews();
            } elseif ($param === 'pages') {
                $controller = new AdminController($pdo);
                $controller->pages();
            } elseif ($param === 'edit-page') {
                $controller = new AdminController($pdo);
                $controller->editPage();
            } elseif ($param === 'toggle-user-status') {
                $controller = new AdminController($pdo);
                $controller->toggleUserStatus();
            } else {
                header('Location: ' . SITE_URL . '/');
            }
            break;

        // Owner routes
        case 'owner':
            if ($param === 'dashboard') {
                $controller = new OwnerController($pdo);
                $controller->dashboard();
            } elseif ($param === 'properties') {
                $controller = new OwnerController($pdo);
                $controller->properties();
            } elseif ($param === 'add-property') {
                $controller = new OwnerController($pdo);
                $controller->addProperty();
            } elseif ($param === 'edit-property') {
                $controller = new OwnerController($pdo);
                $controller->editProperty();
            } elseif ($param === 'inquiries') {
                $controller = new OwnerController($pdo);
                $controller->inquiries();
            } elseif ($param === 'answer-inquiry') {
                $controller = new OwnerController($pdo);
                $controller->answerInquiry();
            } else {
                header('Location: ' . SITE_URL . '/');
            }
            break;

        // Tenant routes
        case 'tenant':
            if ($param === 'dashboard') {
                $controller = new TenantController($pdo);
                $controller->dashboard();
            } elseif ($param === 'inquiries') {
                $controller = new TenantController($pdo);
                $controller->inquiries();
            } elseif ($param === 'submit-inquiry') {
                $controller = new TenantController($pdo);
                $controller->submitInquiry();
            } elseif ($param === 'reviews') {
                $controller = new TenantController($pdo);
                $controller->reviews();
            } elseif ($param === 'submit-review') {
                $controller = new TenantController($pdo);
                $controller->submitReview();
            } elseif ($param === 'profile') {
                $controller = new TenantController($pdo);
                $controller->profile();
            } else {
                header('Location: ' . SITE_URL . '/');
            }
            break;

        // Main routes
        case 'home':
            $controller = new MainController($pdo);
            $controller->index();
            break;

        case 'about':
            $controller = new MainController($pdo);
            $controller->about();
            break;

        case 'contact':
            $controller = new MainController($pdo);
            $controller->contact();
            break;

        case 'privacy':
            $controller = new MainController($pdo);
            $controller->privacy();
            break;

        case 'properties':
            if ($param) {
                $controller = new MainController($pdo);
                $_GET['id'] = $param;
                $controller->property();
            } else {
                $controller = new MainController($pdo);
                $controller->properties();
            }
            break;

        default:
            header('HTTP/1.0 404 Not Found');
            echo '404 - Page Not Found';
            break;
    }
} catch (Exception $e) {
    header('HTTP/1.0 500 Internal Server Error');
    echo '500 - Internal Server Error: ' . $e->getMessage();
}
