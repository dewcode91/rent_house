# Rent House App

A complete property rental management system with Admin, Property Owner, and Tenant modules.

## Features

### Admin Module
- Dashboard with property statistics
- Property Type Management
- Owner Management
- User Management
- Property Listing Management
- Review Management
- Pages Management (About Us, Contact Us)
- Property Search
- Password Management

### User Module - Property Owner
- View home page and about us
- Browse properties by type
- Manage own profile
- Add and manage properties
- Receive and answer inquiries

### User Module - Tenant
- View home page and about us
- Browse available properties
- Manage own profile
- Submit inquiries

## Tech Stack
- **Frontend**: Bootstrap 5 (CDN)
- **Backend**: Pure PHP (no frameworks)
- **Database**: MySQL

## Project Structure
```
rent_house/
├── config/
│   ├── db.php              # Database connection
│   └── constants.php       # App constants
├── public/
│   ├── index.php           # Entry point
│   ├── css/
│   ├── js/
│   └── uploads/            # User uploads
├── app/
│   ├── controllers/        # Page controllers
│   ├── models/             # Database models
│   ├── views/              # Template files
│   └── middleware/         # Auth middleware
├── database/
│   └── schema.sql          # Database schema
├── .htaccess               # URL rewriting
└── README.md
```

## Installation

1. Clone the repository
2. Create a MySQL database named `rent_house`
3. Import `database/schema.sql`
4. Update database credentials in `config/db.php`
5. Set up web server to point to `public/` directory
6. Access via `http://localhost`

## Default Credentials
- Admin: admin@rent.com / password123
- Owner: owner@rent.com / password123
- Tenant: tenant@rent.com / password123

## License
MIT
