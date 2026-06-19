/* ============================================================
   KACM — Footer Settings Loader
   Loads site settings from Supabase and updates footer elements
   ============================================================ */
document.addEventListener('DOMContentLoaded', async function() {
  var supabaseClient = window.__kacmSupabase;
  if (!supabaseClient) return;

  var { data: settings, error } = await supabaseClient.from('settings').select('*');
  if (error || !settings) return;

  var map = {};
  settings.forEach(function(s) { map[s.setting_key] = s.setting_value; });

  function update(id, prop, val) {
    var el = document.getElementById(id);
    if (!el || !val) return;
    if (prop === 'text') el.textContent = val;
    else if (prop === 'html') el.innerHTML = val;
    else if (prop === 'href') el.href = val;
  }

  update('footer-site-name', 'text', map.site_name);
  update('footer-tagline', 'text', map.site_tagline);
  if (map.contact_email) update('footer-email', 'html', '<i class="fas fa-envelope"></i> ' + map.contact_email.replace(/</g, '&lt;'));
  if (map.contact_phone) update('footer-phone', 'html', '<i class="fas fa-phone"></i> ' + map.contact_phone.replace(/</g, '&lt;'));
  if (map.address) update('footer-address', 'html', '<i class="fas fa-map-marker-alt"></i> ' + map.address.replace(/</g, '&lt;'));
  update('footer-copyright', 'text', map.footer_copyright);
  update('footer-facebook', 'href', map.facebook_url);
  update('footer-instagram', 'href', map.instagram_url);
  update('footer-youtube', 'href', map.youtube_url);
});
