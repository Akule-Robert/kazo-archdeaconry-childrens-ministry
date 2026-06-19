<?php
$settings = isset($settings) ? $settings : getAllSettings();
$email = $settings['contact_email'] ?? 'kazoarchdeaconry@yahoo.com';
$phone = $settings['contact_phone'] ?? '0771 905 447 / 0709 754 900';
$whatsapp = $settings['whatsapp_number'] ?? '0771905447';
$copyright = $settings['footer_copyright'] ?? '© 2025 Kazo Archdeaconry Children\'s Ministry. Registered under Church of Uganda, Namirembe Diocese.';
?>
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo"><span class="logo-icon"><i class="fas fa-cross"></i></span><span><?= htmlspecialchars($settings['site_name'] ?? 'Kazo Archdeaconry Children\'s Ministry') ?></span></div>
          <p class="footer-tagline"><?= htmlspecialchars($settings['site_tagline'] ?? 'Nurturing Every Child in the Love of Christ') ?></p>
          <div class="footer-social">
            <a href="<?= htmlspecialchars($settings['facebook_url'] ?? '#') ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="<?= htmlspecialchars($settings['instagram_url'] ?? '#') ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="<?= htmlspecialchars($settings['youtube_url'] ?? '#') ?>" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div>
          <h4>Quick Links</h4>
          <ul class="footer-links">
            <li><a href="index.php">Home</a></li><li><a href="about.php">About</a></li><li><a href="team.php">Our Team</a></li><li><a href="projects.php">Projects</a></li><li><a href="testimonies.php">Testimonies</a></li><li><a href="donate.php">Donate</a></li>
          </ul>
        </div>
        <div>
          <h4>Contact</h4>
          <div class="footer-contact">
            <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($email) ?></p>
            <p><i class="fas fa-phone"></i> <?= htmlspecialchars($phone) ?></p>
          </div>
        </div>
        <div>
          <h4>Affiliation</h4>
          <div class="footer-contact">
            <p>Church of Uganda</p><p>Namirembe Diocese</p><p>Kazo Archdeaconry</p><p>Kawempe, Kampala, Uganda</p>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p><?= htmlspecialchars($copyright) ?></p>
        <div class="footer-badges"><span class="badge">Church of Uganda</span><span class="badge">Namirembe Diocese</span><span class="badge">Flutterwave Secure</span><a href="admin.html" class="badge admin-badge" style="text-decoration:none; cursor:pointer;"><i class="fas fa-lock"></i> Admin</a></div>
      </div>
    </div>
  </footer>

  <a href="#" class="whatsapp-float" data-phone="<?= htmlspecialchars($whatsapp) ?>" aria-label="Chat on WhatsApp"><i class="fab fa-whatsapp"></i></a>
  <script src="js/main.js"></script>
</body>
</html>
