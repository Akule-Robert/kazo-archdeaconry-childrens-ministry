<?php
require_once __DIR__ . '/config.php';
requireLogin();
$settings = getAllSettings();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KACM Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
  <div class="admin-header">
    <h1><i class="fas fa-cross"></i> KACM Admin Panel</h1>
    <div class="admin-user">
      <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['display_name']) ?>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
  <div class="admin-container">
    <nav class="admin-sidebar">
      <a href="dashboard.php" class="<?= $currentPage === 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
      <a href="homepage.php" class="<?= $currentPage === 'homepage.php' ? 'active' : '' ?>"><i class="fas fa-home"></i> <span>Homepage</span></a>
      <a href="team.php" class="<?= $currentPage === 'team.php' ? 'active' : '' ?>"><i class="fas fa-users"></i> <span>Team</span></a>
      <a href="testimonials.php" class="<?= $currentPage === 'testimonials.php' ? 'active' : '' ?>"><i class="fas fa-quote-right"></i> <span>Testimonials</span></a>
      <a href="projects.php" class="<?= $currentPage === 'projects.php' ? 'active' : '' ?>"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
      <a href="gallery.php" class="<?= $currentPage === 'gallery.php' ? 'active' : '' ?>"><i class="fas fa-images"></i> <span>Gallery</span></a>
      <a href="media.php" class="<?= $currentPage === 'media.php' ? 'active' : '' ?>"><i class="fas fa-newspaper"></i> <span>Media</span></a>
      <a href="settings.php" class="<?= $currentPage === 'settings.php' ? 'active' : '' ?>"><i class="fas fa-cog"></i> <span>Settings</span></a>
      <a href="password.php" class="<?= $currentPage === 'password.php' ? 'active' : '' ?>"><i class="fas fa-key"></i> <span>Change Password</span></a>
    </nav>
    <div class="admin-content">
