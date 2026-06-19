<?php
require_once 'header.php';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keys = ['site_name','site_tagline','contact_email','contact_phone','facebook_url','instagram_url','youtube_url','whatsapp_number','address','footer_copyright','about_blurb'];
    foreach ($keys as $key) {
        $value = $_POST[$key] ?? '';
        $stmt = $db->prepare('UPDATE settings SET setting_value = ? WHERE setting_key = ?');
        $stmt->execute([$value, $key]);
    }
    $settings = getAllSettings();
    $msg = 'Settings saved!';
}

$settings = getAllSettings();
?>

<h2>Site Settings</h2>
<p style="color:#555; margin-bottom:20px;">Update global site information.</p>
<?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<form method="POST">
  <div class="card">
    <h2>Site Information</h2>
    <div class="form-group">
      <label>Site Name</label>
      <input type="text" name="site_name" value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Site Tagline</label>
      <input type="text" name="site_tagline" value="<?= htmlspecialchars($settings['site_tagline'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>About KACM Blurb (Homepage)</label>
      <textarea name="about_blurb" rows="4"><?= htmlspecialchars($settings['about_blurb'] ?? '') ?></textarea>
      <div class="help-text">This appears on the homepage under "About KACM".</div>
    </div>
  </div>
  
  <div class="card">
    <h2>Contact Information</h2>
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="contact_email" value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Phone Number(s)</label>
      <input type="text" name="contact_phone" value="<?= htmlspecialchars($settings['contact_phone'] ?? '') ?>">
      <div class="help-text">Displayed in footer.</div>
    </div>
    <div class="form-group">
      <label>WhatsApp Number</label>
      <input type="text" name="whatsapp_number" value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '') ?>">
      <div class="help-text">Used for the floating WhatsApp button (numbers only, no spaces).</div>
    </div>
    <div class="form-group">
      <label>Address</label>
      <input type="text" name="address" value="<?= htmlspecialchars($settings['address'] ?? '') ?>">
    </div>
  </div>
  
  <div class="card">
    <h2>Social Media</h2>
    <div class="form-group">
      <label>Facebook URL</label>
      <input type="url" name="facebook_url" value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Instagram URL</label>
      <input type="url" name="instagram_url" value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>YouTube URL</label>
      <input type="url" name="youtube_url" value="<?= htmlspecialchars($settings['youtube_url'] ?? '') ?>">
    </div>
  </div>
  
  <div class="card">
    <h2>Footer</h2>
    <div class="form-group">
      <label>Copyright Text</label>
      <input type="text" name="footer_copyright" value="<?= htmlspecialchars($settings['footer_copyright'] ?? '') ?>">
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Save All Settings</button>
</form>

<?php require_once 'footer.php'; ?>
