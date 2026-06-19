-- KACM Content Management System Database
-- Run this in phpMyAdmin (http://localhost/phpmyadmin) or MySQL CLI

CREATE DATABASE IF NOT EXISTS kacm_cms;
USE kacm_cms;

-- ====== USERS (Admin Login) ======
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    display_name VARCHAR(100) NOT NULL,
    role ENUM('admin','editor') DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ====== HERO SLIDES (Homepage) ======
CREATE TABLE hero_slides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    heading VARCHAR(255) NOT NULL,
    subtitle VARCHAR(500) DEFAULT '',
    scripture VARCHAR(500) DEFAULT '',
    button1_text VARCHAR(100) DEFAULT '',
    button1_link VARCHAR(255) DEFAULT '',
    button2_text VARCHAR(100) DEFAULT '',
    button2_link VARCHAR(255) DEFAULT '',
    background_image VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    visible TINYINT(1) DEFAULT 1
);

-- ====== PAGES (Content sections per page) ======
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(100) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    meta_description VARCHAR(500) DEFAULT '',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ====== SECTIONS (Editable content blocks within pages) ======
CREATE TABLE sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT NOT NULL,
    section_key VARCHAR(100) NOT NULL,
    heading VARCHAR(255) DEFAULT '',
    content TEXT DEFAULT '',
    image VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    FOREIGN KEY (page_id) REFERENCES pages(id) ON DELETE CASCADE
);

-- ====== TEAM MEMBERS ======
CREATE TABLE team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category ENUM('leadership','executive','coordinator','teacher') NOT NULL,
    name VARCHAR(200) NOT NULL,
    role_title VARCHAR(200) DEFAULT '',
    bio TEXT DEFAULT '',
    image VARCHAR(255) DEFAULT '',
    parish VARCHAR(200) DEFAULT '',
    church VARCHAR(200) DEFAULT '',
    display_order INT DEFAULT 0,
    visible TINYINT(1) DEFAULT 1
);

-- ====== TESTIMONIALS ======
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category ENUM('sponsor','child','community') NOT NULL,
    author VARCHAR(200) NOT NULL,
    location VARCHAR(200) DEFAULT '',
    content TEXT NOT NULL,
    image VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    visible TINYINT(1) DEFAULT 1
);

-- ====== PROJECTS ======
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    tagline VARCHAR(500) DEFAULT '',
    description TEXT DEFAULT '',
    image VARCHAR(255) DEFAULT '',
    features TEXT DEFAULT '',
    display_order INT DEFAULT 0,
    visible TINYINT(1) DEFAULT 1
);

-- ====== GALLERY ======
CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) DEFAULT '',
    label VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    visible TINYINT(1) DEFAULT 1
);

-- ====== MEDIA ARTICLES ======
CREATE TABLE media_articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    excerpt TEXT DEFAULT '',
    image VARCHAR(255) DEFAULT '',
    article_date DATE DEFAULT NULL,
    category VARCHAR(100) DEFAULT 'article',
    link VARCHAR(500) DEFAULT '',
    visible TINYINT(1) DEFAULT 1
);

-- ====== SETTINGS (Global site settings) ======
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT DEFAULT ''
);

-- ====== DEFAULT DATA ======

-- Default admin user (password: kacm2025)
INSERT INTO users (username, password_hash, display_name, role) VALUES
('publicity', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Publicity Secretary', 'editor');

-- Default pages
INSERT INTO pages (slug, title, meta_description) VALUES
('index', 'Home', 'Kazo Archdeaconry Childrens Ministry Home'),
('about', 'About Us', 'About KACM ministry'),
('team', 'Our Team', 'KACM team members'),
('projects', 'Our Projects', 'KACM projects'),
('testimonies', 'Testimonies', 'KACM testimonies'),
('donate', 'Donate', 'Support KACM');

-- Default settings
INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'Kazo Archdeaconry Children''s Ministry'),
('site_tagline', 'Nurturing Every Child in the Love of Christ'),
('contact_email', 'kazoarchdeaconry@yahoo.com'),
('contact_phone', '0771 905 447 / 0709 754 900'),
('facebook_url', 'https://facebook.com/KACMUganda'),
('instagram_url', 'https://instagram.com/KACMUganda'),
('youtube_url', 'https://youtube.com/KACMUganda'),
('whatsapp_number', '0771905447'),
('address', 'Kazo Archdeaconry Headquarters, Kazo, Kawempe, Kampala, Uganda'),
('footer_copyright', '© 2025 Kazo Archdeaconry Children''s Ministry. Registered under Church of Uganda, Namirembe Diocese.');
