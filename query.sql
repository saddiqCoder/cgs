-- Create Database
CREATE DATABASE garment_system;
USE garment_system;

-- Customers Table
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Measurements Table
CREATE TABLE measurements (
    measurement_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    chest DECIMAL(5,2),
    waist DECIMAL(5,2),
    hips DECIMAL(5,2),
    length DECIMAL(5,2),
    shoulder DECIMAL(5,2),
    sleeve DECIMAL(5,2),
    other_details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE
);

-- Garments Table
CREATE TABLE garments (
    garment_id INT AUTO_INCREMENT PRIMARY KEY,
    garment_name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    fabric_type VARCHAR(100),
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    garment_id INT NOT NULL,
    measurement_id INT,
    quantity INT DEFAULT 1,
    total_price DECIMAL(10,2),
    order_status ENUM('Pending', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (garment_id) REFERENCES garments(garment_id) ON DELETE CASCADE,
    FOREIGN KEY (measurement_id) REFERENCES measurements(measurement_id) ON DELETE SET NULL
);

-- Admins Table (Optional for login system)
CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
