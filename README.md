# 🏠 Rent House - Property Rental Management System

A complete property rental management platform where unauthenticated users can browse properties, and authenticated users (owners and tenants) can interact through inquiries.

## 📋 Table of Contents
- [Features](#features)
- [System Architecture](#system-architecture)
- [User Roles & Permissions](#user-roles--permissions)
- [Installation & Setup](#installation--setup)
- [Configuration](#configuration)
- [Usage](#usage)
- [Default Credentials](#default-credentials)
- [Technical Stack](#technical-stack)
- [Project Structure](#project-structure)
- [Security Features](#security-features)

---

## ✨ Features

### 🌐 Public Features (Unauthenticated Users)
- 🏠 Browse all available properties
- 🔍 View property details, images, and reviews
- 📋 Filter properties by type and price
- 📖 Read About Us and Contact Us pages
- 📞 Send contact messages via contact form
- ⭐ View property reviews and ratings
- 📱 Responsive mobile-friendly interface

### 🔐 Authenticated User Features (Tenants)
- ✅ All public features
- 💬 **NEW**: Send inquiries to property owners
- 🏠 Manage personal profile
- 📧 Track inquiry status and responses
- ⭐ Submit and manage property reviews
- 💾 Save favorite properties

### 🏢 Property Owner Features
- ✅ All public and tenant features
- 🏠 Add and manage properties
- 📊 View property performance
- 💬 Receive and respond to tenant inquiries
- 📈 Manage property listings
- 📸 Upload property images
- 🔔 View inquiry notifications

### 🛠️ Admin Features
- 👥 User management (Create, Edit, Deactivate)
- 🏘️ Property type management
- 🏠 Approve/manage all properties
- 💬 Monitor inquiries and communications
- ⭐ Review and approve property reviews
- 📄 Manage CMS pages (About, Contact, Privacy)
- 📊 Platform statistics and analytics
- 🔍 Property search and filtering

---

## 🔐 User Roles & Permissions Matrix

### Permission Levels

| Feature | Guest | Tenant | Owner | Admin |
|---------|-------|--------|-------|-------|
| **Public Pages** |
| View Home Page | ✅ | ✅ | ✅ | ✅ |
| View About Page | ✅ | ✅ | ✅ | ✅ |
| View Contact Page | ✅ | ✅ | ✅ | ✅ |
| Send Contact Messages | ✅ | ✅ | ✅ | ✅ |
| **Property Management** |
| Browse Properties | ✅ | ✅ | ✅ | ✅ |
| View Property Details | ✅ | ✅ | ✅ | ✅ |
| View Property Reviews | ✅ | ✅ | ✅ | ✅ |
| Add Properties | ❌ | ❌ | ✅ | ✅ |
| Edit Own Properties | ❌ | ❌ | ✅ | ✅ |
| Delete Properties | ❌ | ❌ | ✅ | ✅ |
| Approve All Properties | ❌ | ❌ | ❌ | ✅ |
| **Inquiries & Communication** |
| Send Property Inquiries | ❌ | ✅ | ✅ | ✅ |
| Receive Inquiries | ❌ | ❌ | ✅ | ✅ |
| Reply to Inquiries | ❌ | ❌ | ✅ | ✅ |
| View All Inquiries | ❌ | ❌ | ❌ | ✅ |
| **Reviews** |
| Submit Property Reviews | ❌ | ✅ | ❌ | ❌ |
| Approve Reviews | ❌ | ❌ | ❌ | ✅ |
| View All Reviews | ❌ | ✅ | ✅ | ✅ |
| **User Management** |
| View Dashboard | ❌ | ✅ | ✅ | ✅ |
| Edit Profile | ❌ | ✅ | ✅ | ✅ |
| Manage Users | ❌ | ❌ | ❌ | ✅ |
| Activate/Deactivate Users | ❌ | ❌ | ❌ | ✅ |
| **Admin Features** |
| Manage Property Types | ❌ | ❌ | ❌ | ✅ |
| Manage CMS Pages | ❌ | ❌ | ❌ | ✅ |
| View Platform Statistics | ❌ | ❌ | ❌ | ✅ |
| Access Admin Dashboard | ❌ | ❌ | ❌ | ✅ |

### Access Level Summary

```
┌─────────────────────────────────────────────────────────┐
│                    ACCESS LEVELS                         │
├─────────────────────────────────────────────────────────┤
│ 🌐 PUBLIC ACCESS (No Authentication Required)          │
│   • Home, About, Contact pages                          │
│   • Browse all properties & details                     │
│   • View reviews and ratings                            │
│                                                         │
│ 🔓 PROTECTED ACCESS (Authentication Required)          │
│   • Dashboard pages                                     │
│   • Profile management                                 │
│   • Send inquiries (Tenant/Owner)                       │
│   • Manage properties (Owner)                           │
│   • Admin panel (Admin only)                            │
└─────────────────────────────────────────────────────────┘
```

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx with URL rewriting enabled
- Git

### Step 1: Clone the Repository

```bash
git clone https://github.com/dewcode91/rent_house.git
cd rent_house
```

### Step 2: Create Database

```bash
# Create a new MySQL database
mysql -u root -p -e "CREATE DATABASE rent_house;"

# Import the database schema
mysql -u root -p rent_house < database/schema.sql
```

### Step 3: Configure Database Connection

Edit `config/db.php` and update database credentials:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'rent_house');
```

### Step 4: Configure Base Path

Edit `config/constants.php` and set the correct base path:

```php
<?php
define('SITE_NAME', 'Rent House App');
define('SITE_URL', 'http://localhost/rent_house');
define('BASE_PATH', '/rent_house');
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/');
```

### Step 5: Set Up Web Server

#### For Apache (with .htaccess):
```apache
# Already included in .htaccess
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /rent_house/
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /rent_house/public/index.php [L]
</IfModule>
```

#### For Nginx:
```nginx
location /rent_house {
    try_files $uri $uri/ /rent_house/public/index.php?$query_string;
}
```

### Step 6: Set Directory Permissions

```bash
# Create uploads directory if it doesn't exist
mkdir -p public/uploads

# Set permissions
chmod 755 public/uploads
chmod 755 config
```

### Step 7: Start the Application

Access the application at:
```
http://localhost/rent_house
```

---

## ⚙️ Configuration

### Key Configuration Files

#### `config/constants.php`
```php
define('SITE_NAME', 'Rent House App');           // Application name
define('SITE_URL', 'http://localhost/rent_house'); // Base URL
define('BASE_PATH', '/rent_house');              // URL path
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/'); // Upload directory
define('SESSION_TIMEOUT', 30);                  // Session timeout in minutes
define('ITEMS_PER_PAGE', 10);                   // Pagination items
```

#### `config/db.php`
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rent_house');
```

### Environment Setup

Create a `.env` file for sensitive data (recommended):

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=your_password
DB_NAME=rent_house
SITE_URL=http://localhost/rent_house
SESSION_TIMEOUT=30
```

---

## 👥 Usage Guide

### For Guests (Unauthenticated Users)

1. **Browse Properties**
   - Navigate to "Browse Properties" or "Properties" page
   - View all available properties with filters
   - Click on any property to view full details

2. **View Property Details**
   - See images, description, amenities
   - Read reviews and ratings
   - Check owner information

3. **Contact Platform**
   - Visit "Contact Us" page
   - Fill out contact form to send messages

4. **Register**
   - Click "Register" button
   - Choose role: Owner or Tenant
   - Fill registration form and submit

### For Tenants (Authenticated Renters)

1. **Browse Properties**
   - Browse and filter properties
   - View detailed property information

2. **Send Inquiries**
   - Click "Send Inquiry" on property detail page
   - Compose message to property owner
   - Track inquiry status in dashboard

3. **View Inquiry Responses**
   - Check dashboard for replies
   - View owner contact information
   - Arrange property viewing

4. **Leave Reviews**
   - Submit reviews after renting
   - Rate properties (1-5 stars)
   - Help other tenants make decisions

### For Property Owners (Authenticated)

1. **Add Properties**
   - Navigate to "Add Property" in dashboard
   - Fill property details (title, description, price, etc.)
   - Upload property images
   - Set availability status

2. **Manage Properties**
   - View all listed properties
   - Edit property information
   - Activate/deactivate listings
   - Manage pricing and availability

3. **Respond to Inquiries**
   - View incoming tenant inquiries
   - Reply with property availability
   - Provide viewing schedule
   - Accept or decline inquiries

4. **Monitor Performance**
   - Track property views
   - Monitor inquiry count
   - Check reviews and ratings

### For Administrators

1. **Dashboard**
   - View platform statistics
   - Monitor active properties and users
   - Track inquiries and communications

2. **User Management**
   - Create new users
   - Edit user information
   - Activate/deactivate accounts
   - Assign user roles

3. **Property Management**
   - Approve property listings
   - Manage property types
   - Monitor property compliance
   - Remove inappropriate listings

4. **Review Management**
   - Approve property reviews
   - Monitor review quality
   - Handle review disputes

5. **CMS Management**
   - Edit About Us page
   - Edit Contact page
   - Manage Privacy Policy
   - Update static content

---

## 🔑 Default Credentials

### Test Accounts

#### Admin Account
```
Email: admin@rent.com
Password: password123
Role: Administrator
Access: Full platform access
```

#### Owner Account
```
Email: owner@rent.com
Password: password123
Role: Property Owner
Access: Property management, inquiries
```

#### Tenant Account
```
Email: tenant@rent.com
Password: password123
Role: Tenant/Renter
Access: Browse properties, send inquiries, reviews
```

**⚠️ Important**: Change default passwords immediately in production!

---

## 🛠️ Technical Stack

### Frontend
- **Framework**: Bootstrap 5 (CDN)
- **Icons**: Font Awesome 6
- **Styling**: CSS3 with custom styles
- **Scripts**: Vanilla JavaScript

### Backend
- **Language**: PHP 7.4+
- **Architecture**: MVC Pattern
- **Database**: MySQL 5.7+
- **Session Management**: PHP Native Sessions

### Server Requirements
- Apache 2.4+ with `mod_rewrite`
- PHP 7.4+ with extensions:
  - `mysqli` or `pdo_mysql`
  - `session`
  - `hash`
  - `filter`
- MySQL 5.7+

---

## 📁 Project Structure

```
rent_house/
│
├── config/
│   ├── db.php                  # Database connection configuration
│   └── constants.php           # Application constants
│
├── public/
│   ├── index.php               # Application entry point
│   ├── uploads/                # User-uploaded files
│   ├── css/                    # Custom stylesheets
│   └── js/                     # Custom scripts
│
├── app/
│   ├── controllers/
│   │   ├── Controller.php      # Base controller class
│   │   ├── MainController.php  # Home, about, contact, properties
│   │   ├── AuthController.php  # Login, register, logout
│   │   ├── AdminController.php # Admin dashboard
│   │   ├── OwnerController.php # Owner dashboard
│   │   └── TenantController.php# Tenant dashboard
│   │
│   ├── models/
│   │   ├── User.php            # User model
│   │   ├── Property.php        # Property model
│   │   ├── Inquiry.php         # Inquiry model
│   │   ├── Review.php          # Review model
│   │   └── Page.php            # CMS pages model
│   │
│   ├── views/
│   │   ├── layout/
│   │   │   ├── header.php      # Navigation and header
│   │   │   └── footer.php      # Footer
│   │   ├── auth/
│   │   │   ├── login.php       # Login page
│   │   │   └── register.php    # Registration page
│   │   ├── properties/
│   │   │   ├── list.php        # Property listing
│   │   │   └── detail.php      # Property detail
│   │   ├── home.php            # Home page
│   │   ├── about.php           # About page
│   │   ├── contact.php         # Contact page
│   │   ├── privacy.php         # Privacy page
│   │   ├── admin/              # Admin templates
│   │   ├── owner/              # Owner templates
│   │   └── tenant/             # Tenant templates
│   │
│   └── middleware/
│       └── Auth.php            # Authentication middleware
│
├── database/
│   └── schema.sql              # Database schema and initial data
│
├── .htaccess                   # URL rewriting configuration
└── README.md                   # This file
```

---

## 🔒 Security Features

### Authentication & Authorization
- ✅ Role-based access control (RBAC)
- ✅ Session-based authentication
- ✅ Password hashing with bcrypt
- ✅ Session timeout protection
- ✅ CSRF token validation (to be implemented)
- ✅ Input validation and sanitization

### Data Protection
- ✅ SQL Injection prevention (Prepared Statements)
- ✅ XSS prevention (HTML escaping)
- ✅ Secure password storage
- ✅ HTTP headers security

### Access Control
- ✅ Role-based permission matrix
- ✅ Page-level access restrictions
- ✅ Resource-level authorization
- ✅ Session verification

### Best Practices
- ✅ Separation of concerns (MVC)
- ✅ Input validation on server-side
- ✅ Error handling without exposing details
- ✅ Secure file upload handling

---

## 🌐 API Endpoints

### Public Endpoints (No Authentication Required)
```
GET  /                      # Home page
GET  /about                 # About page
GET  /contact               # Contact page
POST /contact               # Submit contact form
GET  /properties            # Browse properties
GET  /properties/{id}       # Property details
GET  /privacy               # Privacy policy
GET  /login                 # Login page
POST /login                 # Submit login
GET  /register              # Register page
POST /register              # Submit registration
```

### Protected Endpoints (Authentication Required)
```
GET  /logout                                # Logout
GET  /owner/dashboard                       # Owner dashboard
POST /owner/add-property                    # Add property
GET  /owner/properties                      # Manage properties
POST /owner/edit-property                   # Edit property
GET  /owner/inquiries                       # View inquiries
POST /owner/answer-inquiry                  # Reply to inquiry

GET  /tenant/dashboard                      # Tenant dashboard
GET  /tenant/inquiries                      # View inquiries
POST /tenant/submit-inquiry                 # Send inquiry
GET  /tenant/reviews                        # Manage reviews
POST /tenant/submit-review                  # Submit review
```

### Admin Endpoints (Admin Only)
```
GET  /admin/dashboard                       # Admin dashboard
GET  /admin/users                           # Manage users
GET  /admin/properties                      # Manage properties
GET  /admin/property-types                  # Manage types
POST /admin/add-property-type               # Add type
GET  /admin/reviews                         # Manage reviews
GET  /admin/pages                           # Manage pages
POST /admin/edit-page                       # Edit page
POST /admin/toggle-user-status              # Enable/disable user
```

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: 404 Page Not Found
- Check `.htaccess` is present and enabled
- Verify `mod_rewrite` is enabled on Apache
- Check `BASE_PATH` in `config/constants.php`

**Issue**: Database Connection Error
- Verify MySQL is running
- Check database credentials in `config/db.php`
- Ensure database `rent_house` exists

**Issue**: Session Timeout
- Increase `SESSION_TIMEOUT` in `config/constants.php`
- Check PHP session directory permissions
- Verify `session.gc_maxlifetime` in php.ini

**Issue**: File Upload Not Working
- Check `uploads/` directory permissions (755)
- Verify `UPLOAD_DIR` path in `config/constants.php`
- Check PHP `upload_max_filesize` setting

---

## 📝 License

MIT License - See LICENSE file for details

---

## 👨‍💻 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📧 Support

For support, email: support@renthouse.com

---

**Last Updated**: May 2026
**Version**: 1.0.0
