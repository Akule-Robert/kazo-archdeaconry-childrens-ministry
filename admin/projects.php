<?php
require_once 'header.php';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    
    if ($action === 'save') {
        $title = $_POST['title'] ?? '';
        $tagline = $_POST['tagline'] ?? '';
        $description = $_POST['description'] ?? '';
        $features = $_POST['features'] ?? '';
        $order = (int)($_POST['display_order'] ?? 0);
        
        $image = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($_FILES['image'], 'projects');
            if ($upload['success']) $image = $upload['filename'];
        }
        
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE projects SET title=?, tagline=?, description=?, features=?, image=?, display_order=? WHERE id=?');
            $stmt->execute([$title, $tagline, $description, $features, $image, $order, $id]);
        } else {
            $stmt = $db->prepare('INSERT INTO projects (title, tagline, description, features, image, display_order) VALUES (?,?,?,?,?,?)');
            $stmt->execute([$title, $tagline, $description, $features, $image, $order]);
        }
        $msg = 'Project saved!';
    }
    if ($action === 'delete') { $db->prepare('DELETE FROM projects WHERE id=?')->execute([$id]); $msg = 'Project deleted.'; }
    if ($action === 'toggle') { $db->prepare('UPDATE projects SET visible = NOT visible WHERE id=?')->execute([$id]); }
}

$projects = $db->query('SELECT * FROM projects ORDER BY display_order ASC')->fetchAll();
?>

<h2>Projects</h2>
<p style="color:#555; margin-bottom:20px;">Update the three KACM projects.</p>
<?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<div class="card">
  <div class="page-header"><h2>All Projects</h2><button class="btn btn-primary" onclick="showForm(0)">Add Project</button></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Order</th><th>Title</th><th>Image</th><th>Visible</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($projects as $p): ?>
        <tr>
          <td><?= $p['display_order'] ?></td>
          <td><?= htmlspecialchars($p['title']) ?></td>
          <td><?php if ($p['image']): ?><img src="uploads/projects/<?= htmlspecialchars($p['image']) ?>" class="img-preview" alt=""><?php else: ?>—<?php endif; ?></td>
          <td><?= $p['visible'] ? 'Yes' : 'No' ?></td>
          <td class="actions">
            <a href="#" onclick="edit(<?= $p['id'] ?>, '<?= htmlspecialchars(addslashes($p['title'])) ?>', '<?= htmlspecialchars(addslashes($p['tagline'])) ?>', '<?= htmlspecialchars(addslashes($p['description'])) ?>', '<?= htmlspecialchars(addslashes($p['features'])) ?>', <?= $p['display_order'] ?>, '<?= htmlspecialchars(addslashes($p['image'])) ?>')">Edit</a>
            <form method="POST" style="display:inline"><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button type="submit" class="btn btn-sm btn-secondary"><?= $p['visible'] ? 'Hide' : 'Show' ?></button></form>
            <form method="POST" style="display:inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button type="submit" class="btn btn-sm btn-danger">Delete</button></form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="card" id="formContainer" style="display:none;">
  <div class="page-header"><h2 id="formTitle">Edit Project</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" id="itemId" value="0">
    <input type="hidden" name="existing_image" id="itemImage" value="">
    <div class="form-group"><label>Project Title</label><input type="text" name="title" id="f_title" required></div>
    <div class="form-group"><label>Tagline</label><input type="text" name="tagline" id="f_tagline" placeholder="e.g. From Our Land to Every Child's Plate"></div>
    <div class="form-group"><label>Description</label><textarea name="description" id="f_desc" rows="4"></textarea></div>
    <div class="form-group"><label>Features (one per line)</label><textarea name="features" id="f_features" rows="4" placeholder="Organic farming of vegetables&#10;Agri-tourism activities&#10;Income reinvested into children's welfare"></textarea></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group"><label>Display Order</label><input type="number" name="display_order" id="f_order" value="0"></div>
      <div class="form-group"><label>Image</label><input type="file" name="image" accept="image/*"><div id="imgPreview" class="help-text"></div></div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary" onclick="document.getElementById('formContainer').style.display='none'">Cancel</button>
  </form>
</div>

<script>
function showForm(id) { document.getElementById('formContainer').style.display='block'; document.getElementById('formTitle').textContent='Add Project'; document.getElementById('itemId').value=0; window.scrollTo({top:document.getElementById('formContainer').offsetTop-80,behavior:'smooth'}); }
function edit(id,title,tagline,desc,features,order,image) {
  document.getElementById('formContainer').style.display='block'; document.getElementById('formTitle').textContent='Edit Project';
  document.getElementById('itemId').value=id; document.getElementById('f_title').value=title; document.getElementById('f_tagline').value=tagline;
  document.getElementById('f_desc').value=desc; document.getElementById('f_features').value=features.replace(/<br\s*\/?>/gi,"\n"); document.getElementById('f_order').value=order;
  document.getElementById('itemImage').value=image; document.getElementById('imgPreview').innerHTML=image?'Current: '+image:''; window.scrollTo({top:document.getElementById('formContainer').offsetTop-80,behavior:'smooth'});
}
</script>

<?php require_once 'footer.php'; ?>
