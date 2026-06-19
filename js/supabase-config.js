/* ============================================================
   KACM — Supabase Configuration
   Shared across all dynamic pages
   ============================================================ */

// Use window property to avoid redeclaration errors
if (!window.__kacmSupabase) {
  var SUPABASE_URL = 'https://rkmdzjuobofnablpxemm.supabase.co';
  var SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InJrbWR6anVvYm9mbmFibHB4ZW1tIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODE4MTQ3MjUsImV4cCI6MjA5NzM5MDcyNX0.58bWdpY_0kYw9_CdUOOxK6rCY2_y_lf49uA6z1Mtlj0';
  window.__kacmSupabase = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
}
