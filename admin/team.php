<?php
require_once 'header.php';
$db = getDB();
$msg = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    
    if ($action === 'save') {
        $category = $_POST['category'] ?? '';
        $name = $_POST['name'] ?? '';
        $role_title = $_POST['role_title'] ?? '';
        $bio = $_POST['bio'] ?? '';
        $parish = $_POST['parish'] ?? '';
        $church = $_POST['church'] ?? '';
        $order = (int)($_POST['display_order'] ?? 0);
        
        $image = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($_FILES['image'], 'team');
            if ($upload['success']) $image = $upload['filename'];
        }
        
        if ($id > 0) {
            $stmt = $db->prepare('UPDATE team_members SET category=?, name=?, role_title=?, bio=?, image=?, parish=?, church=?, display_order=? WHERE id=?');
            $stmt->execute([$category, $name, $role_title, $bio, $image, $parish, $church, $order, $id]);
        } else {
            $stmt = $db->prepare('INSERT INTO team_members (category, name, role_title, bio, image, parish, church, display_order) VALUES (?,?,?,?,?,?,?,?)');
            $stmt->execute([$category, $name, $role_title, $bio, $image, $parish, $church, $order]);
        }
        $msg = 'Team member saved!';
    }
    
    if ($action === 'delete') {
        $stmt = $db->prepare('DELETE FROM team_members WHERE id=?');
        $stmt->execute([$id]);
        $msg = 'Team member deleted.';
    }
    
    if ($action === 'toggle') {
        $stmt = $db->prepare('UPDATE team_members SET visible = NOT visible WHERE id=?');
        $stmt->execute([$id]);
    }
}

$categories = ['leadership' => 'Leadership', 'executive' => 'Executive Members', 'coordinator' => 'Parish Coordinators', 'teacher' => 'Sunday School Teachers'];
$activeTab = $_GET['tab'] ?? 'leadership';
$members = $db->prepare('SELECT * FROM team_members WHERE category = ? ORDER BY display_order ASC');
$members->execute([$activeTab]);
$members = $members->fetchAll();
?>

<h2>Team Manager</h2>
<p style="color:#555; margin-bottom:20px;">Manage leadership, executive members, coordinators, and teachers.</p>

<?php if ($msg): ?>
  <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="card" style="padding:0; background:none; box-shadow:none;">
  <div style="display:flex; gap:0; margin-bottom:20px; border-bottom:2px solid #EDE7F6;">
    <?php foreach ($categories as $key => $label): ?>
      <a href="?tab=<?= $key ?>" style="padding:10px 20px; font-size:14px; font-weight:600; border-bottom:2px solid <?= $activeTab === $key ? '#5B2D8E' : 'transparent' ?>; color:<?= $activeTab === $key ? '#5B2D8E' : '#555' ?>; margin-bottom:-2px;">
        <?= $label ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>

<div class="card">
  <div class="page-header">
    <h2><?= $categories[$activeTab] ?></h2>
    <button class="btn btn-primary" onclick="showForm(0)">Add New</button>
  </div>
  
  <div class="table-wrap">
    <table>
      <thead><tr><th>Order</th><th>Name</th><th>Role</th><th>Parish</th><th>Image</th><th>Visible</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach ($members as $m): ?>
        <tr>
          <td><?= $m['display_order'] ?></td>
          <td><?= htmlspecialchars($m['name'] ?: '—') ?></td>
          <td><?= htmlspecialchars($m['role_title']) ?></td>
          <td><?= htmlspecialchars($m['parish']) ?></td>
          <td><?php if ($m['image']): ?><img src="uploads/team/<?= htmlspecialchars($m['image']) ?>" class="img-preview" alt=""><?php else: ?>—<?php endif; ?></td>
          <td><?= $m['visible'] ? 'Yes' : 'No' ?></td>
          <td class="actions">
            <a href="#" onclick="showForm(<?= $m['id'] ?>, '<?= htmlspecialchars(addslashes($m['category'])) ?>', '<?= htmlspecialchars(addslashes($m['name'])) ?>', '<?= htmlspecialchars(addslashes($m['role_title'])) ?>', '<?= htmlspecialchars(addslashes($m['bio'])) ?>', '<?= htmlspecialchars(addslashes($m['parish'])) ?>', '<?= htmlspecialchars(addslashes($m['church'])) ?>', <?= $m['display_order'] ?>, '<?= htmlspecialchars(addslashes($m['image'])) ?>')">Edit</a>
            <form method="POST" style="display:inline">
              <input type="hidden" name="action" value="toggle">
              <input type="hidden" name="id" value="<?= $m['id'] ?>">
              <button type="submit" class="btn btn-sm btn-secondary"><?= $m['visible'] ? 'Hide' : 'Show' ?></button>
            </form>
            <form method="POST" style="display:inline" onsubmit="return confirm('Remove this member?')">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $m['id'] ?>">
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($members)): ?>
        <tr><td colspan="7" style="text-align:center;color:#555;">No members in this category yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="card" id="memberForm" style="display:none;">
  <div class="page-header"><h2 id="formTitle">Add Team Member</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" id="memId" value="0">
    <input type="hidden" name="existing_image" id="memImage" value="">
    <input type="hidden" name="category" id="memCategory" value="<?= $activeTab ?>">
    
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="name" id="f_mem_name" required>
    </div>
    <div class="form-group">
      <label>Role / Title</label>
      <input type="text" name="role_title" id="f_mem_role">
    </div>
    <div class="form-group">
      <label>Bio / Description</label>
      <textarea name="bio" id="f_mem_bio" rows="3"></textarea>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Parish</label>
        <input type="text" name="parish" id="f_mem_parish">
      </div>
      <div class="form-group">
        <label>Church</label>
        <input type="text" name="church" id="f_mem_church">
      </div>
    </div>
    <div class="form-group">
      <label>Display Order</label>
      <input type="number" name="display_order" id="f_mem_order" value="0">
    </div>
    <div class="form-group">
      <label>Photo</label>
      <input type="file" name="image" accept="image/*">
      <div id="memImagePreview" class="help-text"></div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary" onclick="document.getElementById('memberForm').style.display='none'">Cancel</button>
  </form>
</div>

<script>
function showForm(id, category, name, role, bio, parish, church, order, image) {
  document.getElementById('memberForm').style.display = 'block';
  document.getElementById('formTitle').textContent = id ? 'Edit Team Member' : 'Add Team Member';
  document.getElementById('memId').value = id || 0;
  document.getElementById('memCategory').value = category || '<?= $activeTab ?>';
  document.getElementById('f_mem_name').value = name || '';
  document.getElementById('f_mem_role').value = role || '';
  document.getElementById('f_mem_bio').value = bio || '';
  document.getElementById('f_mem_parish').value = parish || '';
  document.getElementById('f_mem_church').value = church || '';
  document.getElementById('f_mem_order').value = order || 0;
  document.getElementById('memImage').value = image || '';
  document.getElementById('memImagePreview').innerHTML = image ? 'Current: ' + image : '';
  window.scrollTo({ top: document.getElementById('memberForm').offsetTop - 80, behavior: 'smooth' });
}
</script>

<?php require_once 'footer.php'; ?>
