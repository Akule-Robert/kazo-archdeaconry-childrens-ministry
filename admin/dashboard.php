<?php
require_once 'header.php';
$db = getDB();

// Count stats
$teamCount = $db->query('SELECT COUNT(*) FROM team_members')->fetchColumn();
$testimonialCount = $db->query('SELECT COUNT(*) FROM testimonials')->fetchColumn();
$galleryCount = $db->query('SELECT COUNT(*) FROM gallery')->fetchColumn();
$articleCount = $db->query('SELECT COUNT(*) FROM media_articles')->fetchColumn();
?>

<h2>Dashboard</h2>
<p style="color:#555; margin-bottom:20px;">Welcome, <?= htmlspecialchars($_SESSION['display_name']) ?>! Manage your website content from here.</p>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-users"></i></div>
    <h3><?= $teamCount ?></h3>
    <p>Team Members</p>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-quote-right"></i></div>
    <h3><?= $testimonialCount ?></h3>
    <p>Testimonials</p>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-images"></i></div>
    <h3><?= $galleryCount ?></h3>
    <p>Gallery Images</p>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
    <h3><?= $articleCount ?></h3>
    <p>Media Articles</p>
  </div>
</div>

<div class="card">
  <h2>Quick Actions</h2>
  <div style="display:flex; flex-wrap:wrap; gap:10px;">
    <a href="homepage.php" class="btn btn-primary"><i class="fas fa-home"></i> Edit Homepage</a>
    <a href="team.php" class="btn btn-primary"><i class="fas fa-users"></i> Manage Team</a>
    <a href="testimonials.php" class="btn btn-primary"><i class="fas fa-quote-right"></i> Manage Testimonials</a>
    <a href="projects.php" class="btn btn-primary"><i class="fas fa-project-diagram"></i> Edit Projects</a>
    <a href="gallery.php" class="btn btn-primary"><i class="fas fa-images"></i> Manage Gallery</a>
    <a href="media.php" class="btn btn-primary"><i class="fas fa-newspaper"></i> Manage Media</a>
    <a href="settings.php" class="btn btn-secondary"><i class="fas fa-cog"></i> Site Settings</a>
    <a href="../index.php" class="btn btn-secondary" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
  </div>
</div>

<div class="card" style="margin-top:16px;">
  <h2>Recent Content</h2>
  <p style="color:#555; font-size:14px;">Use the sidebar menu to navigate to any section and make changes. All changes save immediately to the database and appear on the live site.</p>
  <ul style="margin-top:12px; padding-left:20px; color:#555; font-size:14px; line-height:2;">
    <li><strong>Homepage</strong> — Edit hero slideshow text/images, program cards, gallery</li>
    <li><strong>Team</strong> — Add/edit/remove leadership, executive members, coordinators, teachers</li>
    <li><strong>Testimonials</strong> — Manage sponsor, child, and community testimonials</li>
    <li><strong>Projects</strong> — Update Farm to Fork, Resource Centre, Sponsor a Child content</li>
    <li><strong>Gallery</strong> — Upload and organize images for the photo gallery</li>
    <li><strong>Media</strong> — Add articles, press releases, and success stories</li>
    <li><strong>Settings</strong> — Update contact info, social media links, site name</li>
  </ul>
</div>

<?php require_once 'footer.php'; ?>
