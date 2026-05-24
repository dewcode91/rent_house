-- Rent House App Database Schema

-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'owner', 'tenant') NOT NULL DEFAULT 'tenant',
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    state VARCHAR(50),
    country VARCHAR(50),
    profile_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Property Types Table
CREATE TABLE property_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Properties Table
CREATE TABLE properties (
    id INT PRIMARY KEY AUTO_INCREMENT,
    owner_id INT NOT NULL,
    property_type_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    bedrooms INT,
    bathrooms INT,
    area FLOAT,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    property_image VARCHAR(255),
    status ENUM('available', 'rented', 'inactive') NOT NULL DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (property_type_id) REFERENCES property_types(id) ON DELETE CASCADE
);

-- Inquiries Table
CREATE TABLE inquiries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    property_id INT NOT NULL,
    tenant_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'answered', 'closed') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    FOREIGN KEY (tenant_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Inquiry Answers Table
CREATE TABLE inquiry_answers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    inquiry_id INT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inquiry_id) REFERENCES inquiries(id) ON DELETE CASCADE
);

-- Reviews Table
CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    property_id INT NOT NULL,
    tenant_id INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    FOREIGN KEY (tenant_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Pages Table (for About Us, Contact Us, etc.)
CREATE TABLE pages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    slug VARCHAR(100) UNIQUE NOT NULL,
    title VARCHAR(200) NOT NULL,
    content LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create Indexes
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_properties_owner ON properties(owner_id);
CREATE INDEX idx_properties_type ON properties(property_type_id);
CREATE INDEX idx_properties_city ON properties(city);
CREATE INDEX idx_inquiries_property ON inquiries(property_id);
CREATE INDEX idx_inquiries_tenant ON inquiries(tenant_id);
CREATE INDEX idx_reviews_property ON reviews(property_id);
CREATE INDEX idx_pages_slug ON pages(slug);

-- Insert Default Data
INSERT INTO users (name, email, password, role, status) VALUES 
('Admin User', 'admin@rent.com', '$2y$10$8K1p/weTIy3X3q.Kh.9H.eYKYV9VgJ8qJ3d5X5K5K5K5K5K5K5K', 'admin', 'active'),
('John Owner', 'owner@rent.com', '$2y$10$8K1p/weTIy3X3q.Kh.9H.eYKYV9VgJ8qJ3d5X5K5K5K5K5K5K5K', 'owner', 'active'),
('Jane Tenant', 'tenant@rent.com', '$2y$10$8K1p/weTIy3X3q.Kh.9H.eYKYV9VgJ8qJ3d5X5K5K5K5K5K5K5K', 'tenant', 'active');

INSERT INTO property_types (name, description) VALUES 
('House', 'Single family house'),
('Apartment', 'Apartment or flat'),
('Shop', 'Commercial shop space'),
('Office', 'Office space');

INSERT INTO pages (slug, title, content) VALUES 
('about', 'About Us', '<h1>About Rent House App</h1><p>Welcome to our property rental management system.</p>'),
('contact', 'Contact Us', '<h1>Contact Us</h1><p>Email: contact@rent.com</p><p>Phone: +1-800-RENT-NOW</p>'),
('privacy', 'Privacy Policy', '<h1>Privacy Policy</h1><p>Your privacy is important to us.</p>');
