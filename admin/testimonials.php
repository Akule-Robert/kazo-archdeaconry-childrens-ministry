<?php
require_once 'header.php';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    
    if ($action === 'save') {
        $category = $_POST['category'] ?? '';
        $author = $_POST['author'] ?? '';
        $location = $_POST['location'] ?? '';
        $content = $_POST['content'] ?? '';
        $order = (int)($_POST['display_order'] ?? 0);
        
        $image = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($_FILES['image'], 'testimonials');
            if ($upload['success']) $image = $upload['filename'];
        }
        
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE testimonials SET category=?, author=?, location=?, content=?, image=?, display_order=? WHERE id=?');
            $stmt->execute([$category, $author, $location, $content, $image, $order, $id]);
        } else {
            $stmt = $db->prepare('INSERT INTO testimonials (category, author, location, content, image, display_order) VALUES (?,?,?,?,?,?)');
            $stmt->execute([$category, $author, $location, $content, $image, $order]);
        }
        $msg = 'Testimonial saved!';
    }
    
    if ($action === 'delete') {
        $db->prepare('DELETE FROM testimonials WHERE id=?')->execute([$id]);
        $msg = 'Testimonial deleted.';
    }
    if ($action === 'toggle') {
        $db->prepare('UPDATE testimonials SET visible = NOT visible WHERE id=?')->execute([$id]);
    }
}

$cats = ['sponsor' => 'Sponsors', 'child' => 'Sponsored Children', 'community' => 'Community'];
$tab = $_GET['tab'] ?? 'sponsor';
$stmt = $db->prepare('SELECT * FROM testimonials WHERE category = ? ORDER BY display_order ASC');
$stmt->execute([$tab]);
$items = $stmt->fetchAll();
?>

<h2>Testimonials</h2>
<p style="color:#555; margin-bottom:20px;">Manage sponsor, child, and community testimonials.</p>
<?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<div style="display:flex; gap:0; margin-bottom:20px; border-bottom:2px solid #EDE7F6;">
  <?php foreach ($cats as $k => $l): ?>
    <a href="?tab=<?= $k ?>" style="padding:10px 20px; font-size:14px; font-weight:600; border-bottom:2px solid <?= $tab === $k ? '#5B2D8E' : 'transparent' ?>; color:<?= $tab === $k ? '#5B2D8E' : '#555' ?>; margin-bottom:-2px;"><?= $l ?></a>
  <?php endforeach; ?>
</div>

<div class="card">
  <div class="page-header"><h2><?= $cats[$tab] ?></h2><button class="btn btn-primary" onclick="showForm(0)">Add New</button></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Author</th><th>Location</th><th>Content</th><th>Image</th><th>Visible</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($items as $i): ?>
        <tr>
          <td><?= htmlspecialchars($i['author']) ?></td>
          <td><?= htmlspecialchars($i['location']) ?></td>
          <td style="max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?= htmlspecialchars(substr($i['content'], 0, 80)) ?>...</td>
          <td><?php if ($i['image']): ?><img src="uploads/testimonials/<?= htmlspecialchars($i['image']) ?>" class="img-preview" alt=""><?php else: ?>—<?php endif; ?></td>
          <td><?= $i['visible'] ? 'Yes' : 'No' ?></td>
          <td class="actions">
            <a href="#" onclick="edit(<?= $i['id'] ?>, '<?= htmlspecialchars(addslashes($i['author'])) ?>', '<?= htmlspecialchars(addslashes($i['location'])) ?>', '<?= htmlspecialchars(addslashes($i['content'])) ?>', <?= $i['display_order'] ?>, '<?= htmlspecialchars(addslashes($i['image'])) ?>')">Edit</a>
            <form method="POST" style="display:inline"><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $i['id'] ?>"><button type="submit" class="btn btn-sm btn-secondary"><?= $i['visible'] ? 'Hide' : 'Show' ?></button></form>
            <form method="POST" style="display:inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $i['id'] ?>"><button type="submit" class="btn btn-sm btn-danger">Delete</button></form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="card" id="formContainer" style="display:none;">
  <div class="page-header"><h2 id="formTitle">Add Testimonial</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" id="itemId" value="0">
    <input type="hidden" name="existing_image" id="itemImage" value="">
    <input type="hidden" name="category" value="<?= $tab ?>">
    <div class="form-group"><label>Author Name</label><input type="text" name="author" id="f_author" required></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group"><label>Location (e.g. United Kingdom, Kazo Parish)</label><input type="text" name="location" id="f_location"></div>
      <div class="form-group"><label>Display Order</label><input type="number" name="display_order" id="f_order" value="0"></div>
    </div>
    <div class="form-group"><label>Testimonial Content</label><textarea name="content" id="f_content" rows="4" required></textarea></div>
    <div class="form-group"><label>Photo</label><input type="file" name="image" accept="image/*"><div id="imgPreview" class="help-text"></div></div>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary" onclick="document.getElementById('formContainer').style.display='none'">Cancel</button>
  </form>
</div>

<script>
function showForm(id) { document.getElementById('formContainer').style.display='block'; document.getElementById('formTitle').textContent='Add Testimonial'; document.getElementById('itemId').value=0; window.scrollTo({top:document.getElementById('formContainer').offsetTop-80,behavior:'smooth'}); }
function edit(id,author,location,content,order,image) {
  document.getElementById('formContainer').style.display='block'; document.getElementById('formTitle').textContent='Edit Testimonial';
  document.getElementById('itemId').value=id; document.getElementById('f_author').value=author; document.getElementById('f_location').value=location;
  document.getElementById('f_content').value=content; document.getElementById('f_order').value=order; document.getElementById('itemImage').value=image;
  document.getElementById('imgPreview').innerHTML=image?'Current: '+image:''; window.scrollTo({top:document.getElementById('formContainer').offsetTop-80,behavior:'smooth'});
}
</script>

<?php require_once 'footer.php'; ?>
