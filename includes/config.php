<?php
// KACM CMS Configuration
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'kacm_cms');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Site paths
define('SITE_URL', 'http://localhost/kazo-archdeaconry-childrens-ministry');
define('ADMIN_URL', SITE_URL . '/admin');
define('ASSETS_URL', SITE_URL . '/assets');
define('UPLOADS_URL', ADMIN_URL . '/uploads');

// File paths
define('ROOT_PATH', __DIR__ . '/..');
define('ADMIN_PATH', ROOT_PATH . '/admin');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('UPLOADS_PATH', ADMIN_PATH . '/uploads');

// Database connection
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
    return $pdo;
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Require login - redirect if not authenticated
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . ADMIN_URL . '/login.php');
        exit;
    }
}

// Get a single setting value
function getSetting($key) {
    $db = getDB();
    $stmt = $db->prepare('SELECT setting_value FROM settings WHERE setting_key = ?');
    $stmt->execute([$key]);
    $row = $stmt->fetch();
    return $row ? $row['setting_value'] : '';
}

// Get all settings as key => value array
function getAllSettings() {
    $db = getDB();
    $stmt = $db->query('SELECT setting_key, setting_value FROM settings');
    $settings = [];
    while ($row = $stmt->fetch()) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    return $settings;
}

// Get sections for a page
function getPageSections($pageSlug) {
    $db = getDB();
    $stmt = $db->prepare('
        SELECT s.* FROM sections s 
        JOIN pages p ON s.page_id = p.id 
        WHERE p.slug = ? 
        ORDER BY s.display_order ASC
    ');
    $stmt->execute([$pageSlug]);
    return $stmt->fetchAll();
}

// Get a single section by key on a page
function getSection($pageSlug, $sectionKey) {
    $db = getDB();
    $stmt = $db->prepare('
        SELECT s.* FROM sections s 
        JOIN pages p ON s.page_id = p.id 
        WHERE p.slug = ? AND s.section_key = ?
    ');
    $stmt->execute([$pageSlug, $sectionKey]);
    return $stmt->fetch();
}

// Get hero slides
function getHeroSlides() {
    $db = getDB();
    $stmt = $db->query('SELECT * FROM hero_slides WHERE visible = 1 ORDER BY display_order ASC');
    return $stmt->fetchAll();
}

// Get team members by category
function getTeamByCategory($category) {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM team_members WHERE category = ? AND visible = 1 ORDER BY display_order ASC');
    $stmt->execute([$category]);
    return $stmt->fetchAll();
}

// Get testimonials by category
function getTestimonialsByCategory($category) {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM testimonials WHERE category = ? AND visible = 1 ORDER BY display_order ASC');
    $stmt->execute([$category]);
    return $stmt->fetchAll();
}

// Get all projects
function getProjects() {
    $db = getDB();
    $stmt = $db->query('SELECT * FROM projects WHERE visible = 1 ORDER BY display_order ASC');
    return $stmt->fetchAll();
}

// Get gallery images
function getGalleryImages() {
    $db = getDB();
    $stmt = $db->query('SELECT * FROM gallery WHERE visible = 1 ORDER BY display_order ASC');
    return $stmt->fetchAll();
}

// Get media articles
function getMediaArticles($category = null) {
    $db = getDB();
    if ($category) {
        $stmt = $db->prepare('SELECT * FROM media_articles WHERE category = ? AND visible = 1 ORDER BY article_date DESC');
        $stmt->execute([$category]);
    } else {
        $stmt = $db->query('SELECT * FROM media_articles WHERE visible = 1 ORDER BY article_date DESC');
    }
    return $stmt->fetchAll();
}

// Upload an image
function uploadImage($file, $subfolder = '') {
    $targetDir = UPLOADS_PATH . ($subfolder ? '/' . $subfolder : '');
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ['success' => false, 'error' => 'Only JPG, PNG, GIF and WebP images are allowed.'];
    }
    
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower(pathinfo($file['name'], PATHINFO_FILENAME))) . '.' . $ext;
    $filepath = $targetDir . '/' . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        $relativePath = 'admin/uploads' . ($subfolder ? '/' . $subfolder : '') . '/' . $filename;
        return ['success' => true, 'filename' => $filename, 'path' => $relativePath];
    }
    
    return ['success' => false, 'error' => 'Failed to upload file.'];
}
