<?php
require_once 'header.php';
$db = getDB();
$msg = '';

// Handle hero slide add/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'save_slide') {
        $id = (int)($_POST['id'] ?? 0);
        $heading = $_POST['heading'] ?? '';
        $subtitle = $_POST['subtitle'] ?? '';
        $scripture = $_POST['scripture'] ?? '';
        $btn1_text = $_POST['button1_text'] ?? '';
        $btn1_link = $_POST['button1_link'] ?? '';
        $btn2_text = $_POST['button2_text'] ?? '';
        $btn2_link = $_POST['button2_link'] ?? '';
        $order = (int)($_POST['display_order'] ?? 0);
        
        // Handle image upload
        $image = $_POST['existing_image'] ?? '';
        if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($_FILES['background_image'], 'hero');
            if ($upload['success']) {
                $image = $upload['filename'];
            }
        }
        
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE hero_slides SET heading=?, subtitle=?, scripture=?, button1_text=?, button1_link=?, button2_text=?, button2_link=?, background_image=?, display_order=? WHERE id=?');
            $stmt->execute([$heading, $subtitle, $scripture, $btn1_text, $btn1_link, $btn2_text, $btn2_link, $image, $order, $id]);
        } else {
            $stmt = $db->prepare('INSERT INTO hero_slides (heading, subtitle, scripture, button1_text, button1_link, button2_text, button2_link, background_image, display_order) VALUES (?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$heading, $subtitle, $scripture, $btn1_text, $btn1_link, $btn2_text, $btn2_link, $image, $order]);
        }
        $msg = 'Slide saved successfully!';
    }
    
    if ($_POST['action'] === 'delete_slide') {
        $stmt = $db->prepare('DELETE FROM hero_slides WHERE id=?');
        $stmt->execute([(int)$_POST['id']]);
        $msg = 'Slide deleted.';
    }
    
    if ($_POST['action'] === 'toggle_slide') {
        $stmt = $db->prepare('UPDATE hero_slides SET visible = NOT visible WHERE id=?');
        $stmt->execute([(int)$_POST['id']]);
    }
}

$slides = $db->query('SELECT * FROM hero_slides ORDER BY display_order ASC')->fetchAll();
?>

<h2>Homepage Editor</h2>
<p style="color:#555; margin-bottom:20px;">Edit the hero slideshow, program cards, and homepage content.</p>

<?php if ($msg): ?>
  <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="card">
  <div class="page-header">
    <h2>Hero Slideshow</h2>
    <button class="btn btn-primary" onclick="document.getElementById('slideForm').style.display='block'; document.getElementById('slideForm').reset(); document.getElementById('slideId').value='0'; document.getElementById('formTitle').textContent='Add New Slide';">Add Slide</button>
  </div>
  
  <div class="table-wrap">
    <table>
      <thead><tr><th>Order</th><th>Heading</th><th>Image</th><th>Visible</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($slides as $s): ?>
        <tr>
          <td><?= $s['display_order'] ?></td>
          <td><?= htmlspecialchars($s['heading']) ?></td>
          <td><?php if ($s['background_image']): ?><img src="uploads/hero/<?= htmlspecialchars($s['background_image']) ?>" class="img-preview" alt=""><?php else: ?>—<?php endif; ?></td>
          <td><?= $s['visible'] ? 'Yes' : 'No' ?></td>
          <td class="actions">
            <a href="#" onclick="editSlide(<?= $s['id'] ?>, '<?= htmlspecialchars(addslashes($s['heading'])) ?>', '<?= htmlspecialchars(addslashes($s['subtitle'])) ?>', '<?= htmlspecialchars(addslashes($s['scripture'])) ?>', '<?= htmlspecialchars(addslashes($s['button1_text'])) ?>', '<?= htmlspecialchars(addslashes($s['button1_link'])) ?>', '<?= htmlspecialchars(addslashes($s['button2_text'])) ?>', '<?= htmlspecialchars(addslashes($s['button2_link'])) ?>', <?= $s['display_order'] ?>, '<?= htmlspecialchars(addslashes($s['background_image'])) ?>')">Edit</a>
            <form method="POST" style="display:inline">
              <input type="hidden" name="action" value="toggle_slide">
              <input type="hidden" name="id" value="<?= $s['id'] ?>">
              <button type="submit" class="btn btn-sm btn-secondary"><?= $s['visible'] ? 'Hide' : 'Show' ?></button>
            </form>
            <form method="POST" style="display:inline" onsubmit="return confirm('Delete this slide?')">
              <input type="hidden" name="action" value="delete_slide">
              <input type="hidden" name="id" value="<?= $s['id'] ?>">
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($slides)): ?>
        <tr><td colspan="5" style="text-align:center;color:#555;">No slides yet. Add one below.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Slide Form -->
<div class="card" id="slideForm" style="display:none;">
  <div class="page-header"><h2 id="formTitle">Add New Slide</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="save_slide">
    <input type="hidden" name="id" id="slideId" value="0">
    <input type="hidden" name="existing_image" id="existingImage" value="">
    
    <div class="form-group">
      <label>Heading</label>
      <input type="text" name="heading" id="f_heading" required>
    </div>
    <div class="form-group">
      <label>Subtitle</label>
      <input type="text" name="subtitle" id="f_subtitle">
    </div>
    <div class="form-group">
      <label>Scripture</label>
      <input type="text" name="scripture" id="f_scripture">
    </div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Button 1 Text</label>
        <input type="text" name="button1_text" id="f_btn1_text">
      </div>
      <div class="form-group">
        <label>Button 1 Link</label>
        <input type="text" name="button1_link" id="f_btn1_link" placeholder="e.g. projects.php#sponsor">
      </div>
      <div class="form-group">
        <label>Button 2 Text</label>
        <input type="text" name="button2_text" id="f_btn2_text">
      </div>
      <div class="form-group">
        <label>Button 2 Link</label>
        <input type="text" name="button2_link" id="f_btn2_link">
      </div>
    </div>
    <div class="form-group">
      <label>Display Order</label>
      <input type="number" name="display_order" id="f_order" value="0">
    </div>
    <div class="form-group">
      <label>Background Image</label>
      <input type="file" name="background_image" accept="image/*">
      <div id="imagePreview" class="help-text"></div>
    </div>
    <button type="submit" class="btn btn-primary">Save Slide</button>
    <button type="button" class="btn btn-secondary" onclick="document.getElementById('slideForm').style.display='none'">Cancel</button>
  </form>
</div>

<div class="card">
  <h2>About KACM (Homepage)</h2>
  <p style="color:#555;">The About KACM text on the homepage is managed in the <a href="settings.php">Settings</a> page under site description.</p>
</div>

<script>
function editSlide(id, heading, subtitle, scripture, btn1, btn1link, btn2, btn2link, order, image) {
  document.getElementById('slideForm').style.display = 'block';
  document.getElementById('formTitle').textContent = 'Edit Slide';
  document.getElementById('slideId').value = id;
  document.getElementById('f_heading').value = heading;
  document.getElementById('f_subtitle').value = subtitle;
  document.getElementById('f_scripture').value = scripture;
  document.getElementById('f_btn1_text').value = btn1;
  document.getElementById('f_btn1_link').value = btn1link;
  document.getElementById('f_btn2_text').value = btn2;
  document.getElementById('f_btn2_link').value = btn2link;
  document.getElementById('f_order').value = order;
  document.getElementById('existingImage').value = image;
  document.getElementById('imagePreview').innerHTML = image ? 'Current: ' + image : '';
  window.scrollTo({ top: document.getElementById('slideForm').offsetTop - 80, behavior: 'smooth' });
}
</script>

<?php require_once 'footer.php'; ?>
