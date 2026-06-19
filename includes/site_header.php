<?php
require_once __DIR__ . '/config.php';
$settings = getAllSettings();
$siteName = $settings['site_name'] ?? 'Kazo Archdeaconry Children\'s Ministry';
$siteTagline = $settings['site_tagline'] ?? 'Nurturing Every Child in the Love of Christ';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= $pageDesc ?? 'Kazo Archdeaconry Children\'s Ministry (KACM) — Nurturing Every Child in the Love of Christ' ?>">
  <title><?= ($pageTitle ?? 'KACM') ?> | Kazo Archdeaconry Children's Ministry</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <a href="index.php" class="nav-logo"><span class="logo-icon"><i class="fas fa-cross"></i></span><span><?= htmlspecialchars($siteName) ?></span></a>
      <ul class="nav-links">
        <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="team.php">Our Team</a></li>
        <li><a href="projects.php">Our Projects</a></li>
        <li><a href="testimonies.php">Testimonies</a></li>
        <li><a href="donate.php" class="nav-donate">Donate</a></li>
      </ul>
      <button class="hamburger" aria-label="Toggle navigation"><span></span><span></span><span></span></button>
    </div>
  </nav>
