<?php
// KACM CMS Database Setup Script
// Run this once to create the database tables
// Access at: http://localhost/kazo-archdeaconry-childrens-ministry/admin/setup.php

require_once __DIR__ . '/../includes/config.php';

$step = $_GET['step'] ?? 0;
$message = '';

if ($step === '1') {
    try {
        // Create database if not exists
        $pdo = new PDO('mysql:host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        $pdo->exec('USE `' . DB_NAME . '`');
        
        // Create tables
        $pdo->exec(file_get_contents(__DIR__ . '/../database.sql'));
        
        // Reset the admin password to something the user chooses
        // Default is 'kacm2025'
        
        $message = 'Database created successfully!';
        $step = '2';
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

if (isset($_POST['set_password'])) {
    try {
        $db = getDB();
        $password = $_POST['password'] ?? 'kacm2025';
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare('UPDATE users SET password_hash = ? WHERE username = ?');
        $stmt->execute([$hash, 'publicity']);
        $message = 'Password set! You can now <a href="login.php">login</a>.';
        $step = 'done';
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KACM CMS Setup</title>
  <link rel="stylesheet" href="css/admin.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,400;0,600;0,700&display=swap" rel="stylesheet">
</head>
<body style="display:flex; align-items:center; justify-content:center; min-height:100vh; background:#f0f0f5;">
  <div style="background:#fff; padding:40px; border-radius:12px; box-shadow:0 8px 32px rgba(0,0,0,0.1); max-width:500px; width:100%;">
    <div style="text-align:center; font-size:48px; color:#5B2D8E; margin-bottom:16px;"><i class="fas fa-cross"></i></div>
    <h1 style="font-family:'Lora',Georgia,serif; color:#5B2D8E; text-align:center; font-size:22px;">KACM CMS Setup</h1>
    
    <?php if ($message): ?>
      <div class="alert alert-success" style="margin-top:16px;"><?= $message ?></div>
    <?php endif; ?>
    
    <?php if ($step === 0): ?>
      <p style="margin-top:16px; color:#555;">This will create the database and tables needed for the CMS.</p>
      <p style="margin:8px 0 16px; color:#555; font-size:13px;">Database: <strong><?= DB_NAME ?></strong> on <strong><?= DB_HOST ?></strong></p>
      <a href="?step=1" class="btn btn-primary btn-block">Create Database & Tables</a>
    <?php elseif ($step === '2'): ?>
      <p style="margin-top:16px; color:#555;">Set the admin password for the <strong>publicity</strong> account:</p>
      <form method="POST" style="margin-top:12px;">
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" value="kacm2025" required>
          <div class="help-text">Default: kacm2025 — change this after first login.</div>
        </div>
        <button type="submit" name="set_password" class="btn btn-primary btn-block">Set Password & Finish</button>
      </form>
    <?php elseif ($step === 'done'): ?>
      <div style="text-align:center; margin-top:16px;">
        <a href="login.php" class="btn btn-primary">Go to Login</a>
        <a href="../index.php" class="btn btn-secondary" style="margin-left:8px;">View Site</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
