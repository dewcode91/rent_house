<?php
/**
 * Application Constants
 */

define('SITE_NAME', 'Rent House App');
define('SITE_URL', 'http://localhost/rent_house');
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/');

// User Roles
define('ROLE_ADMIN', 'admin');
define('ROLE_OWNER', 'owner');
define('ROLE_TENANT', 'tenant');

// Status Constants
define('STATUS_ACTIVE', 'active');
define('STATUS_INACTIVE', 'inactive');

// Property Status
define('PROPERTY_AVAILABLE', 'available');
define('PROPERTY_RENTED', 'rented');
define('PROPERTY_INACTIVE', 'inactive');

// Inquiry Status
define('INQUIRY_PENDING', 'pending');
define('INQUIRY_ANSWERED', 'answered');
define('INQUIRY_CLOSED', 'closed');

// Review Status
define('REVIEW_PENDING', 'pending');
define('REVIEW_APPROVED', 'approved');
define('REVIEW_REJECTED', 'rejected');

// Session Timeout (in minutes)
define('SESSION_TIMEOUT', 30);

// Items Per Page
define('ITEMS_PER_PAGE', 10);
