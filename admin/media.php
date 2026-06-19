<?php
require_once 'header.php';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $title = $_POST['title'] ?? '';
        $excerpt = $_POST['excerpt'] ?? '';
        $category = $_POST['category'] ?? 'article';
        $date = $_POST['article_date'] ?? date('Y-m-d');
        
        $image = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($_FILES['image'], 'media');
            if ($upload['success']) $image = $upload['filename'];
        }
        
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE media_articles SET title=?, excerpt=?, image=?, article_date=?, category=? WHERE id=?');
            $stmt->execute([$title, $excerpt, $image, $date, $category, $id]);
        } else {
            $stmt = $db->prepare('INSERT INTO media_articles (title, excerpt, image, article_date, category) VALUES (?,?,?,?,?)');
            $stmt->execute([$title, $excerpt, $image, $date, $category]);
        }
        $msg = 'Article saved!';
    }
    
    if ($action === 'delete') { $db->prepare('DELETE FROM media_articles WHERE id=?')->execute([(int)$_POST['id']]); $msg = 'Article deleted.'; }
    if ($action === 'toggle') { $db->prepare('UPDATE media_articles SET visible = NOT visible WHERE id=?')->execute([(int)$_POST['id']]); }
}

$articles = $db->query('SELECT * FROM media_articles ORDER BY article_date DESC')->fetchAll();
?>

<h2>Media & Articles</h2>
<p style="color:#555; margin-bottom:20px;">Manage articles, press releases, and success stories.</p>
<?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<div class="card">
  <div class="page-header"><h2>All Articles</h2><button class="btn btn-primary" onclick="showForm(0)">Add New</button></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Date</th><th>Title</th><th>Category</th><th>Image</th><th>Visible</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($articles as $a): ?>
        <tr>
          <td><?= $a['article_date'] ?></td>
          <td><?= htmlspecialchars($a['title']) ?></td>
          <td><?= $a['category'] ?></td>
          <td><?php if ($a['image']): ?><img src="uploads/media/<?= htmlspecialchars($a['image']) ?>" class="img-preview" alt=""><?php else: ?>—<?php endif; ?></td>
          <td><?= $a['visible'] ? 'Yes' : 'No' ?></td>
          <td class="actions">
            <a href="#" onclick="edit(<?= $a['id'] ?>, '<?= htmlspecialchars(addslashes($a['title'])) ?>', '<?= htmlspecialchars(addslashes($a['excerpt'])) ?>', '<?= $a['article_date'] ?>', '<?= $a['category'] ?>', '<?= htmlspecialchars(addslashes($a['image'])) ?>')">Edit</a>
            <form method="POST" style="display:inline"><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $a['id'] ?>"><button type="submit" class="btn btn-sm btn-secondary"><?= $a['visible'] ? 'Hide' : 'Show' ?></button></form>
            <form method="POST" style="display:inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $a['id'] ?>"><button type="submit" class="btn btn-sm btn-danger">Delete</button></form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="card" id="formContainer" style="display:none;">
  <div class="page-header"><h2 id="formTitle">Add Article</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" id="itemId" value="0">
    <input type="hidden" name="existing_image" id="itemImage" value="">
    <div class="form-group"><label>Title</label><input type="text" name="title" id="f_title" required></div>
    <div class="form-group"><label>Excerpt / Summary</label><textarea name="excerpt" id="f_excerpt" rows="3"></textarea></div>
    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
      <div class="form-group"><label>Category</label><select name="category" id="f_cat"><option value="article">Article</option><option value="press">Press Release</option><option value="stories">Success Story</option></select></div>
      <div class="form-group"><label>Date</label><input type="date" name="article_date" id="f_date"></div>
      <div class="form-group"><label>Image</label><input type="file" name="image" accept="image/*"><div id="imgPreview" class="help-text"></div></div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary" onclick="document.getElementById('formContainer').style.display='none'">Cancel</button>
  </form>
</div>

<script>
function showForm(id) { document.getElementById('formContainer').style.display='block'; document.getElementById('formTitle').textContent='Add Article'; document.getElementById('itemId').value=0; window.scrollTo({top:document.getElementById('formContainer').offsetTop-80,behavior:'smooth'}); }
function edit(id,title,excerpt,date,cat,image) {
  document.getElementById('formContainer').style.display='block'; document.getElementById('formTitle').textContent='Edit Article';
  document.getElementById('itemId').value=id; document.getElementById('f_title').value=title; document.getElementById('f_excerpt').value=excerpt;
  document.getElementById('f_date').value=date; document.getElementById('f_cat').value=cat;
  document.getElementById('itemImage').value=image; document.getElementById('imgPreview').innerHTML=image?'Current: '+image:'';
  window.scrollTo({top:document.getElementById('formContainer').offsetTop-80,behavior:'smooth'});
}
</script>

<?php require_once 'footer.php'; ?>
