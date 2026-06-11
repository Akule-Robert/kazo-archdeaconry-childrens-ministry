# BWAT.md

This file provides guidance to Bwat when working with code in this repository.

## Tech Stack
- Static website — plain HTML5, CSS3, vanilla JavaScript (ES5-compatible)
- No framework, no build tools, no package manager, no Node.js dependency
- Google Fonts: Inter (body, weights 400/500/600/700), Lora (headings, weights 400/600/700 + italic variants)
- Font Awesome 6.5.1 via CDN (`cdnjs.cloudflare.com`) for all icons
- Flutterwave payment gateway (to be integrated on donate.html)
- Target domain: www.kacm.org

## Brand Identity

**Colors** (use existing CSS custom properties; never introduce new palette values):
- Primary: `#5B2D8E` (`--primary`) — Anglican purple, used for nav, footer, CTAs, section backgrounds
- Primary dark: `#45206B` (`--primary-dark`) — hover states
- Primary light: `#7B4DB8` (`--primary-light`)
- Secondary: `#C9A84C` (`--secondary`) — gold accent, used for donate buttons, dividers, badges, hover states
- Secondary dark: `#A88A35` (`--secondary-dark`) — hover states
- Secondary light: `#DBC06E` (`--secondary-light`)
- Background light purple: `#EDE7F6` (`--bg-light-purple`) — alternating section backgrounds, card fills
- Background light gold: `#FFF8E1` (`--bg-light-gold`) — highlight boxes, call-to-action backgrounds
- Text dark: `#1A1A2E` (`--text-dark`) — body text
- Text gray: `#555555` (`--text-gray`) — captions, secondary text, metadata
- White: `#FFFFFF` (`--white`) — card backgrounds, button text
- WhatsApp green: `#25D366` (`--whatsapp-green`) — floating WhatsApp button only

**Typography**:
- Display / headings: `'Lora', Georgia, serif` — H1–H4, scripture quotes, testimonial quotes
- Body: `'Inter', Arial, sans-serif` — paragraphs, buttons, forms, captions, UI text
- No mono font is used in this project

**Geometry**:
- Border radius: `6px` (sm), `10px` (md), `16px` (lg) from `--radius-sm/md/lg`
- Spacing: default CSS — sections use `80px` vertical padding, cards use `24px` internal padding
- Nav height: `72px` (`--nav-height`) — used for `scroll-padding-top`
- Max content width: `1200px` (`--max-width`)

**Visual language**: Warm, trustworthy, and institutional — rooted in Anglican church identity. Gold accents on deep purple. Scripture quotes styled with italic Lora + left gold border. Cards have subtle shadows and lift on hover. Generous whitespace with alternating section backgrounds (white / light purple / gold CTA strips). Rounded buttons in uppercase bold Inter with letter-spacing.

## Coding Conventions

- **CSS**: Single stylesheet at `css/style.css`. All design tokens as CSS custom properties in `:root`. Class naming is kebab-case with descriptive prefixes (`.card-`, `.nav-`, `.footer-`, `.team-`, `.media-`). Responsive breakpoints are ad-hoc via `clamp()`, grid `repeat()`, and a single mobile media query at the end of the stylesheet — no formal breakpoint system.
- **JavaScript**: Single file at `js/main.js`. Vanilla JS, ES5-compatible (no arrow functions in production code, uses `function` declarations). All code wrapped in `DOMContentLoaded`. Uses `IntersectionObserver` for scroll-triggered `.fade-in` animations. No external JS dependencies.
- **HTML**: All pages share the same `<head>` boilerplate (Google Fonts preconnect, Font Awesome CDN, single CSS link). Nav and footer are copy-pasted across every page — there is no templating or include system. Each page follows the same structure: nav → page hero with breadcrumb → sections → CTA strip → footer → WhatsApp float.
- **Icons**: Font Awesome classes only (`fa-solid`, `fa-brands`, `fa-download`, etc.) — do not introduce emoji or inline SVGs for icons in new work. The emoji placeholders in the existing code are temporary stand-ins pending real photos.

## Architecture Notes

- **No build step**: This is a pure static site. To preview, open any `.html` file directly in a browser. There is no dev server, no compilation, no minification.
- **10 pages**: `index.html`, `about.html`, `team.html`, `programs.html`, `projects.html`, `what-we-do.html`, `donate.html`, `media.html`, `testimonies.html`, `contact.html`.
- **Single-file CSS/JS**: All styles in `css/style.css` (~1700 lines), all scripts in `js/main.js` (~360 lines). No per-page CSS or JS files.
- **No shared HTML partials**: Nav, footer, and WhatsApp button markup is duplicated across all 10 pages. When modifying these global components, every page must be updated individually.
- **Flutterwave integration is pending**: The Donate page references Flutterwave but the actual payment integration is not yet implemented. The "Donate Now" buttons currently have placeholder behavior.
- **Contact form**: Client-side validation only in `main.js` — no server-side endpoint. Form submission currently prevented with a placeholder alert. A real backend or form service (e.g. Formspree, Netlify Forms) is needed before production.
- **Images are placeholder SVGs**: Nearly all images are inline `data:image/svg+xml` URIs or CSS gradient backgrounds. Real photographs must replace these before launch. The README.md specifies KACM should provide real photos.
- **README.md is the developer brief**: The project's README.md contains the complete page-by-page content specification, design system, and functional requirements. It is the authoritative reference for what each page should contain.

## Commands

- **Preview**: Open `index.html` in a browser — no build step required.
- **No test/lint/build commands exist** for this project.

## Gotchas

- **No templating**: Updating the nav or footer requires editing all 10 HTML files. Keep changes identical across pages.
- **Font Awesome version**: The site loads Font Awesome 6.5.1 from CDN. Do not use v6 icons that were added after 6.5.1 without verifying availability.
- **Mobile nav JS**: The hamburger menu relies on the `.nav-links.active` class being toggled by JS. The CSS only shows `.nav-links` as a flex row by default — the mobile styles are at the bottom of the CSS file in a media query. Make sure both CSS and JS are updated if nav structure changes.
- **Sponsorship email**: `sponsorship@kacm.org` is the primary donor conversion contact. Confirm it is live and monitored before launch.
- **Child protection**: Per the README spec, children's surnames must never appear on the website. Photos of children require written parental/guardian consent.
- **Contact form has no backend**: The contact form on `contact.html` and newsletter form on `index.html` both lack server-side handling. They need a form service or backend endpoint before going live.
- **WhatsApp link**: The floating WhatsApp button needs the actual KACM WhatsApp number. The current `href` in the HTML may be a placeholder.
- **`.qodo/` directory**: A `.qodo/` folder exists at the workspace root — this is a tool directory, not part of the KACM website. Ignore it.
