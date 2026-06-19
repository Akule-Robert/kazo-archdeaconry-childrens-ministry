<?php
require_once 'header.php';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'upload') {
        if (isset($_FILES['images'])) {
            $files = $_FILES['images'];
            $count = count($files['name']);
            $uploaded = 0;
            for ($i = 0; $i < $count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $file = ['name' => $files['name'][$i], 'type' => $files['type'][$i], 'tmp_name' => $files['tmp_name'][$i], 'error' => $files['error'][$i], 'size' => $files['size'][$i]];
                    $upload = uploadImage($file, 'gallery');
                    if ($upload['success']) {
                        $label = $_POST['label'] ?? '';
                        $stmt = $db->prepare('INSERT INTO gallery (filename, alt_text, label, display_order) VALUES (?,?,?,0)');
                        $stmt->execute([$upload['filename'], $label, $label]);
                        $uploaded++;
                    }
                }
            }
            $msg = "$uploaded image(s) uploaded.";
        }
    }
    
    if ($action === 'delete') {
        $stmt = $db->prepare('DELETE FROM gallery WHERE id=?');
        $stmt->execute([(int)$_POST['id']]);
        $msg = 'Image removed from gallery.';
    }
    
    if ($action === 'toggle') {
        $stmt = $db->prepare('UPDATE gallery SET visible = NOT visible WHERE id=?');
        $stmt->execute([(int)$_POST['id']]);
    }
}

$images = $db->query('SELECT * FROM gallery ORDER BY display_order ASC, id DESC')->fetchAll();
?>

<h2>Gallery</h2>
<p style="color:#555; margin-bottom:20px;">Upload and manage gallery images for the homepage.</p>
<?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<div class="card">
  <div class="page-header"><h2>Upload Images</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="upload">
    <div class="form-group">
      <label>Select Images (can select multiple)</label>
      <input type="file" name="images[]" accept="image/*" multiple required>
    </div>
    <div class="form-group">
      <label>Default Label (applies to all)</label>
      <input type="text" name="label" placeholder="e.g. KACM Activity">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
  </form>
</div>

<div class="card">
  <div class="page-header"><h2>Gallery Images (<?= count($images) ?>)</h2></div>
  <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(150px,1fr)); gap:12px;">
    <?php foreach ($images as $img): ?>
    <div style="background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.1);">
      <img src="uploads/gallery/<?= htmlspecialchars($img['filename']) ?>" alt="<?= htmlspecialchars($img['alt_text']) ?>" style="width:100%; height:120px; object-fit:cover; display:block;">
      <div style="padding:8px; font-size:11px; color:#555;">
        <div><?= htmlspecialchars($img['label']) ?></div>
        <div style="margin-top:4px;">
          <form method="POST" style="display:inline"><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $img['id'] ?>"><button type="submit" class="btn btn-sm btn-secondary" style="font-size:10px;"><?= $img['visible'] ? 'Hide' : 'Show' ?></button></form>
          <form method="POST" style="display:inline" onsubmit="return confirm('Remove?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $img['id'] ?>"><button type="submit" class="btn btn-sm btn-danger" style="font-size:10px;">Delete</button></form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once 'footer.php'; ?>
