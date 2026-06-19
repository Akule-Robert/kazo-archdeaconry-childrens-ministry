# KACM — Kazo Archdeaconry Children's Ministry

A full-featured website for the Kazo Archdeaconry Children's Ministry (Church of Uganda, Namirembe Diocese). The site showcases the ministry's programs, team, projects, gallery, and media — with a content management system that allows administrators to update content in real time.

## Live Site

**Render Static Site** — _hosted on Render free tier_

## Pages

| Page | Description |
|------|-------------|
| **Home** (`index.html`) | Hero slideshow, impact counters, program highlights, testimonials carousel, media tabs, gallery, newsletter signup |
| **About Us** (`about.html`) | History, vision, mission, core beliefs, affiliation |
| **Our Team** (`team.html`) | Leadership, executive members, parish coordinators, Sunday school teachers — all dynamic from database |
| **Our Projects** (`projects.html`) | Farm to Fork, Resource Centre, Sponsor a Child — dynamic project cards |
| **Testimonies** (`testimonies.html`) | Sponsor, child, and community stories — dynamic from database |
| **Donate** (`donate.html`) | Donation amounts, payment methods (Flutterwave), transparency info |
| **Admin Panel** (`admin.html`) | Full content management system with login |

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Frontend** | Vanilla HTML, CSS, JavaScript (no framework) |
| **Styling** | Custom CSS with CSS variables, responsive design |
| **Icons** | Font Awesome 6 |
| **Fonts** | Inter (body), Lora (headings) — Google Fonts |
| **Backend / Database** | **Supabase** (PostgreSQL) |
| **Authentication** | Supabase Auth (email/password) |
| **File Storage** | Supabase Storage (images and PDFs) |
| **Hosting** | **Render** (Static Site) |
| **Payment** | Flutterwave (MTN Mobile Money, Airtel Money, Visa, Mastercard, PayPal) |

## Admin Panel

The admin panel at `admin.html` provides a password-protected dashboard with the following tabs:

| Tab | Function |
|-----|----------|
| **Team Members** | Add, edit, delete leadership, executive, coordinators, teachers |
| **Testimonials** | Manage sponsor, child, and community stories |
| **Projects** | Update Farm to Fork, Resource Centre, Sponsor a Child cards |
| **Hero Slides** | Manage the homepage slideshow (text, buttons, images) |
| **Media** | Add articles, press releases, events, library PDFs, success stories |
| **Gallery** | Manage gallery images displayed on the homepage |
| **Settings** | Update site name, tagline, contact info, social links, copyright |

### Default Admin Login

- **URL**: `admin.html` (linked from the footer of every page)
- **Email**: Set during Supabase setup
- **Password**: Set during Supabase setup

## Database Schema (Supabase)

The project uses the following tables in Supabase PostgreSQL:

- `team_members` — Church leadership, executives, coordinators, teachers
- `testimonials` — Sponsor, child, and community testimonial stories
- `projects` — Ministry projects (Farm to Fork, Resource Centre, Sponsor a Child)
- `hero_slides` — Homepage slideshow content (headings, buttons, background images)
- `media_articles` — Articles, press releases, events, stories, newsletters
- `gallery` — Homepage gallery images
- `settings` — Global site settings (name, contact, social links, copyright)
- `contact_messages` — Contact form submissions

## Design System

| Element | Specification |
|---------|--------------|
| **Primary Color** | `#5B2D8E` — Purple (Anglican identity) |
| **Secondary Color** | `#C9A84C` — Gold (warmth, royalty) |
| **Background Light** | `#EDE7F6` — Light purple |
| **Text Dark** | `#1A1A2E` |
| **Headings** | Lora / Georgia, serif |
| **Body** | Inter / Arial, sans-serif |
| **Payment Gateway** | Flutterwave |

## Features

- **Dynamic content** — All content managed through the admin panel, displayed live on the site
- **Responsive design** — Works on mobile, tablet, and desktop
- **Hero slideshow** — Rotating background images with text overlays
- **Impact counters** — Animated statistics that count up on scroll
- **Testimonial carousel** — Rotating testimonial cards on the homepage
- **Media tabs** — Articles, press releases, events, success stories with tab switching
- **Gallery modal** — Full-screen image gallery with lightbox
- **WhatsApp chat** — Floating WhatsApp button on every page
- **Image upload** — Upload images directly from the admin panel (stored in Supabase Storage)
- **PDF upload** — Upload press releases and library PDFs from the admin panel
- **Search Engine Optimized** — Meta descriptions, semantic HTML, Open Graph ready

## Development

The site is built with plain HTML/CSS/JS — no build tools, no bundlers, no frameworks. This makes it lightweight, fast to load, and easy to maintain.

### Project Structure

```
kazo-archdeaconry-childrens-ministry/
├── index.html            # Homepage
├── about.html            # About Us
├── team.html             # Our Team (dynamic)
├── projects.html         # Our Projects (dynamic)
├── testimonies.html      # Testimonies (dynamic)
├── donate.html           # Donate page
├── admin.html            # Admin panel
├── css/
│   └── style.css         # Website styles
├── admin/
│   └── css/
│       └── admin.css     # Admin panel styles
├── js/
│   ├── main.js           # Website interactivity
│   ├── supabase-config.js # Supabase client config
│   └── load-footer.js    # Footer settings loader
├── assets/               # Images and videos
├── includes/             # PHP files (legacy, not used on Render)
└── seed-*.sql            # Database seed files (one-time use)
```
