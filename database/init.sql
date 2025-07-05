-- CTF Database Setup
-- Create database
CREATE DATABASE IF NOT EXISTS ctf_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user and grant privileges
CREATE USER IF NOT EXISTS 'ctf_user'@'localhost' IDENTIFIED BY 'ctf_password';
GRANT ALL PRIVILEGES ON ctf_database.* TO 'ctf_user'@'localhost';
FLUSH PRIVILEGES;

-- Use the database
USE ctf_database;

-- Create users table (main table for login)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- Create config table (mentioned in schema hint)
CREATE TABLE config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    config_key VARCHAR(100) UNIQUE NOT NULL,
    config_value TEXT,
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample users for CTF
INSERT INTO users (username, password, email, role) VALUES
('admin', 'admin123', 'admin@ctf.local', 'user'),
('user1', 'password123', 'user1@ctf.local', 'user'),
('testuser', 'test123', 'test@ctf.local', 'user'),
('guest', 'guest123', 'guest@ctf.local', 'user'),
('ctf_admin', 'super_secret_flag{SQL_INJECTION_MASTER}', 'ctfadmin@ctf.local', 'user');


-- Show tables and sample data
SHOW TABLES;

-- Display sample data for verification
SELECT 'Users Table:' as Info;
SELECT id, username, email, role FROM users;
