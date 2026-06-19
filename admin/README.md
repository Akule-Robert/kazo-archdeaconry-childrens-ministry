# KACM Content Management System

## Setup Instructions

### 1. Requirements
- WAMP Server (or XAMPP) with PHP 7.4+ and MySQL running
- Web browser

### 2. Install the Database
1. Make sure WAMP is running (green icon in system tray)
2. Open your browser and go to:
   **http://localhost/kazo-archdeaconry-childrens-ministry/admin/setup.php**
3. Click "Create Database & Tables"
4. Set your admin password (default: `kacm2025`)
5. Click "Set Password & Finish"

### 3. Login to Admin Panel
- Go to: **http://localhost/kazo-archdeaconry-childrens-ministry/admin/login.php**
- Username: `publicity`
- Password: the one you set (default: `kacm2025`)

### 4. What the Publicity Secretary Can Do

| Menu | What You Can Edit |
|------|-------------------|
| **Dashboard** | Overview of site content |
| **Homepage** | Hero slideshow text & images (up to 4 slides) |
| **Team** | Add/edit/remove Leadership, Executive Members, Coordinators, Teachers |
| **Testimonials** | Add/edit/remove Sponsor, Child & Community testimonials |
| **Projects** | Update Farm to Fork, Resource Centre, Sponsor a Child content |
| **Gallery** | Upload and manage images for the photo gallery |
| **Media** | Add articles, press releases & success stories |
| **Settings** | Update email, phone, social media links, site name |
| **Change Password** | Update your login password |

### 5. How to Switch Your Site to Dynamic Mode

The admin panel manages content in the database. To make the frontend pages use database content:

1. Rename `.html` files to `.php`
2. Replace the nav section with: `<?php require_once 'includes/site_header.php'; ?>`
3. Replace the footer section with: `<?php require_once 'includes/site_footer.php'; ?>`
4. The page hero and content will still work from the HTML
5. Future updates can pull team members, testimonials, etc. from the database

For now, the static `.html` pages still work as-is. The admin panel lets you prepare content in the database, and the pages can be converted to PHP one at a time.

### Default Login
- **URL**: http://localhost/kazo-archdeaconry-childrens-ministry/admin/login.php
- **Username**: `publicity`
- **Password**: Set during setup (default: `kacm2025`)
