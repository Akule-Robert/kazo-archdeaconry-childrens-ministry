<?php
require_once 'header.php';
$db = getDB();
$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    
    $stmt = $db->prepare('SELECT password_hash FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if (!password_verify($current, $user['password_hash'])) {
        $error = 'Current password is incorrect.';
    } elseif (strlen($new) < 6) {
        $error = 'New password must be at least 6 characters.';
    } elseif ($new !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $hash = password_hash($new, PASSWORD_BCRYPT);
        $stmt = $db->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
        $stmt->execute([$hash, $_SESSION['user_id']]);
        $msg = 'Password changed successfully!';
    }
}
?>

<h2>Change Password</h2>
<p style="color:#555; margin-bottom:20px;">Update your admin login password.</p>
<?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="card" style="max-width:500px;">
  <form method="POST">
    <div class="form-group">
      <label>Current Password</label>
      <input type="password" name="current_password" required>
    </div>
    <div class="form-group">
      <label>New Password</label>
      <input type="password" name="new_password" required minlength="6">
    </div>
    <div class="form-group">
      <label>Confirm New Password</label>
      <input type="password" name="confirm_password" required minlength="6">
    </div>
    <button type="submit" class="btn btn-primary">Change Password</button>
  </form>
</div>

<?php require_once 'footer.php'; ?>
