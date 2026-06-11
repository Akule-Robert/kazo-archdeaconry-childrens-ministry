KAZO ARCHDEACONRY CHILDREN'S MINISTRY
(KACM)
Church of Uganda | Namirembe Diocese | Kazo

WEBSITE DEVELOPER BRIEF
Complete Page-by-Page Content, Design & Functional Specifications

---

Document Type | Details
Purpose | Full website specification for developer handoff
Prepared For | KACM Web Development Team & Bishop of Namirembe Diocese
Total Pages | 10 website pages (Home through Contact)
Primary Color | #5B2D8E — Purple (Anglican identity)
Secondary Color | #C9A84C — Gold (warmth, royalty)
Font (Headings) | Georgia or Lora — classic, trustworthy
Font (Body) | Inter or Arial — clean, readable
Payment Gateway | Flutterwave (MTN, Airtel, Visa, Mastercard, PayPal)
Contact Email | info@kacm.org | sponsorship@kacm.org
Website URL | www.kacm.org

---

# DESIGN SYSTEM & GLOBAL COMPONENTS

These specifications apply across all 10 pages. The developer must implement these as global styles and reusable components before building individual pages.

## Color Palette

Role | Value & Usage
Primary – Purple | #5B2D8E | Main brand color. Used for headers, CTAs, nav bar, footer, icon accents
Secondary – Gold | #C9A84C | Accent color. Used for badges, dividers, hover states, highlights
Background – Light Purple | #EDE7F6 | Section backgrounds, alternating rows, card fills
Background – Light Gold | #FFF8E1 | Highlight boxes, warning notes, call-to-action backgrounds
Text – Dark | #1A1A2E | All body text, paragraphs
Text – Gray | #555555 | Captions, secondary text, metadata
White | #FFFFFF | Card backgrounds, overlays, button text

## Typography

Element | Specification
H1 – Page Title | Georgia or Lora | 40–48px | Bold | Color: #5B2D8E
H2 – Section Title | Georgia or Lora | 28–32px | Bold | Color: #1A1A2E
H3 – Subsection | Georgia or Lora | 22–24px | Semi-bold | Color: #5B2D8E
Body Text | Inter or Arial | 16px | Regular | Color: #1A1A2E | Line height: 1.7
Captions / Labels | Inter or Arial | 13–14px | Color: #555555
Scripture Quotes | Georgia | Italic | 16–18px | Color: #5B2D8E | Left border accent in Gold
Button Text | Inter or Arial | 16px | Bold | Uppercase | Letter spacing: 1px

## Global Navigation Bar

Present on every page. Sticky (fixed on scroll). Background: #5B2D8E. Logo left-aligned with Church of Uganda cross symbol.

Nav Item | Links To
Home | index.html
About Us | about.html
Our Team | team.html
Program Areas | programs.html
Our Projects | projects.html
What We Do | what-we-do.html
Donate | donate.html — styled as gold CTA button
Media | media.html
Testimonies | testimonies.html
Contact Us | contact.html

## Global Footer

- KACM logo + tagline: "Nurturing Every Child in the Love of Christ"
- Quick links: Home | About | Programs | Projects | Donate | Contact
- Contact info: info@kacm.org | sponsorship@kacm.org | [Phone/WhatsApp]
- Social media icons: Facebook (facebook.com/KACMUganda) | Instagram (@KACMUganda) | YouTube (youtube.com/KACMUganda)
- Church of Uganda affiliation badge + Namirembe Diocese seal
- Copyright line: © [Year] Kazo Archdeaconry Children's Ministry | Registered under Church of Uganda, Namirembe Diocese
- Flutterwave trust badge

## Floating WhatsApp Button

A fixed WhatsApp button must appear on every page (bottom-right corner). Color: #25D366 (WhatsApp green). Links to KACM WhatsApp number. Visible on all screen sizes including mobile.

---

# PAGE 1 — HOME PAGE

📌 Note: This is the most important page. First impression for donors, sponsors, and partners worldwide.

## Hero Section (Full-Width Banner)

- Background: Real photo of KACM children (not stock photos) — authenticity drives donations
- Purple overlay at 60% opacity for text readability
- Headline: "Welcome to KACM" (H1, white, Georgia font)
- Subheadline: "Nurturing Every Child in the Love of Christ — Kazo Archdeaconry, Uganda"
- Scripture quote in styled italic box: "Train up a child in the way he should go; even when he is old he will not depart from it." — Proverbs 22:6
- Two CTA buttons side by side:
  - "Sponsor a Child" → links to projects.html#sponsor (Gold button, primary)
  - "Learn More" → links to about.html (White outline button, secondary)

## Impact Counter Section

A visually striking statistics banner — animated count-up effect on page scroll. Background: #5B2D8E (purple). Text: white.

Statistic | Display Text
500+ | Children Served
12+ | Parishes Covered
200+ | Children Sponsored
15+ | Countries Donating

## About KACM — Brief Introduction

Short 3-sentence paragraph introducing KACM:

CONTENT: Kazo Archdeaconry Children's Ministry (KACM) is a ministry of the Church of Uganda under the Namirembe Diocese, headquartered at Kazo, Kiruhura District. We exist to nurture every child in the love of Christ, equip families with tools of faith, and ensure that no child is left behind due to poverty, neglect, or lack of opportunity. Every day, children across the Kazo Archdeaconry face the risk of school dropout, malnutrition, violence, and spiritual emptiness — KACM stands in the gap.

- "Learn More About Us" link button → about.html

## Program Highlights (3-Card Grid)

Three cards in a responsive grid row. Each card: icon, title, 2-line description, "Read More" link.

Card | Content
Card 1 — Sports Ministry | ⚽ Icon. Title: Sports Ministry. Text: We share the Gospel through football, netball, and athletics — building character and faith in every child. Link → programs.html#sports
Card 2 — Music, Drama & Arts | 🎵 Icon. Title: Arts & Expression. Text: Children express their faith through music, drama, dance and poetry — developing confidence and talent for God. Link → programs.html#mddp
Card 3 — Community Outreach | 🤝 Icon. Title: Community Outreach. Text: We bring food, healthcare, education, and the Gospel to the most vulnerable families across the Archdeaconry. Link → programs.html#outreach

## Sponsor a Child — Call to Action Strip

Full-width colored strip. Background: Gold (#C9A84C). Text: dark purple.

- Headline: "Change a Child's Life Today"
- Subtext: "For as little as $20 a month, you can keep one child in school. Over 200 children are already sponsored — join us."
- CTA Button: "Sponsor a Child Now" → projects.html#sponsor (Purple button)

## Featured Testimony / Success Story

One rotating testimonial card. Photo of child or sponsor (with consent), name, short quote (2–3 lines), country of sponsor or school of child.

- "Read All Testimonies" link → testimonies.html

## Latest News / Media Preview

3 most recent posts from the Media section displayed as cards (thumbnail + title + date + short excerpt). "View All Updates" → media.html

## Newsletter Signup Strip

Simple email capture. Background: light purple (#EDE7F6).

- Headline: "Stay Connected — Get KACM Updates in Your Inbox"
- Email input field + "Subscribe" button (Purple)
- Privacy note: "We respect your privacy. Unsubscribe anytime."

---

# PAGE 2 — ABOUT US

## Page Hero Banner

- Background: church or ministry photo with purple overlay
- Page title: "About Us" (H1, white)
- Breadcrumb: Home > About Us

## Who We Are

CONTENT: Kazo Archdeaconry Children's Ministry (KACM) is a ministry of the Church of Uganda (Anglican), operating under the Namirembe Diocese with its headquarters at Kazo, Kiruhura District, Western Uganda. Founded to serve the spiritual, educational, and social needs of children across the Archdeaconry, KACM works closely with local churches, parish communities, families, and Sunday school teachers to create a comprehensive support system for every child. We believe that every child is made in the image of God and therefore deserves dignity, protection, education, and the opportunity to thrive.

## Vision & Mission

Display as two distinct styled cards side by side.

Vision | Mission
A Uganda where every child grows up knowing Christ, protected from harm, educated to their full potential, and empowered to build a better community. | To nurture and proclaim Christ's love to every child in the Kazo Archdeaconry, partnering with families and communities to build a firm foundation of faith through Scripture, the sacraments, and the teachings of the Anglican tradition, access to quality education, and freedom from poverty and exploitation.

## Core Beliefs

Display as 4 icon cards in a 2x2 grid. Each card: relevant icon, bold title, 1-line description.

Belief | Description
🚫 Free from Violence | Every child deserves a life free from violence, abuse, and exploitation
📚 Right to Education | Every child has the right to quality education regardless of family income
💧 Basic Needs | Every child should enjoy economic security and access to healthcare, nutrition, and clean water
✝️ Church Responsibility | The Church must stand with the vulnerable and speak for those who cannot speak for themselves

## Our Affiliation

- Church of Uganda logo displayed prominently
- Namirembe Diocese seal
- Text: "KACM is a registered ministry of the Church of Uganda, operating under the authority and oversight of the Namirembe Diocese."
- 📌 Note: Developer: Request the Church of Uganda logo and Namirembe Diocese seal from KACM administration in PNG/SVG format.

## Missing Information — Needs to be Provided

⚠️ ACTION REQUIRED: The following details must be provided by KACM before this page goes live: (1) Year KACM was founded — to complete the sentence "Serving Children Since [Year]". (2) Full list of parishes currently covered under the Kazo Archdeaconry. (3) NGO or CBO registration number if applicable.

---

# PAGE 3 — OUR TEAM

📌 Note: This page must be populated with real names, photos, and bios before the website is presented to the Bishop. Placeholder content is not acceptable for a bishop presentation.

## Page Layout

- Page hero banner: title "Our Team" with ministry photo background + purple overlay
- Scripture quote: "Two are better than one, because they have a good return for their labor." — Ecclesiastes 4:9
- Introductory paragraph: "KACM is led by a dedicated team of spiritual leaders, coordinators, and community volunteers who give their time and passion to serve the children of Kazo Archdeaconry."

## Team Member Card Structure

Each team member is displayed as a card with: professional passport-size photo (square crop, 200x200px), full name in bold, official title/role in gold italic, and a short 2-line biography.

## Leadership Hierarchy — Required Profiles

Role / Title | Requirements
Bishop, Namirembe Diocese | Full name | Passport photo | 2-line biography | Featured at top of page in larger card
Archdeacon, Kazo Archdeaconry | Full name | Passport photo | 2-line biography
KACM Rev. Coordinator | Full name | Passport photo | 2-line biography
Council Coordinator | Full name | Passport photo | 2-line biography
Executive Members | Full names | Passport photos | Titles | 2-line bios
Parish Coordinators | Name | Parish they serve | Photo | 2-line bio (one entry per parish)
Sunday School Teachers | Full name | Church they serve | Parish | Passport photo

⚠️ ACTION REQUIRED: KACM must supply: (1) All team members' full names and official titles. (2) Professional passport-size photos for each person. (3) 2-line bios for leadership (Bishop, Archdeacon, Coordinator, Council Coordinator). (4) Complete list of Parish Coordinators with their parishes. (5) Complete list of Sunday School Teachers with their churches and parishes.

---

# PAGE 4 — PROGRAM AREAS

## Page Hero Banner

- Title: "Our Program Areas"
- Scripture: "Whatever you do, work at it with all your heart, as working for the Lord, not for human masters." — Colossians 3:23

## Program 1 — Sports Ministry

- Icon: ⚽ Football/sport icon
- Section heading: "Sports Ministry"

CONTENT: At KACM, we believe that sport is a powerful tool for sharing the Gospel. Through football, netball, athletics, and other sports activities, we create safe spaces where children and youth engage in healthy competition while learning values of teamwork, discipline, and respect — all rooted in the teachings of Christ.

Key activities:
- Regular sports events organised across parishes in Kazo Archdeaconry
- Sports tournaments used as platforms for Gospel outreach and evangelism
- Children coached by trained volunteers who integrate Biblical teachings
- Inter-parish sports competitions to promote unity across the Archdeaconry

📌 Note: Add photo of KACM children in a sports event alongside this section.

## Program 2 — Music, Drama, Dance & Poetry (MDD&P)

- Icon: 🎵 Music/arts icon
- Section heading: "Music, Drama, Dance & Poetry"

CONTENT: Music, Drama, Dance, and Poetry are powerful expressions of faith. KACM uses the performing arts to communicate the Gospel creatively, giving children and youth a platform to express their faith, develop their God-given talents, and minister to their communities with confidence and joy.

Key activities:
- Drama performances enacting Biblical stories and moral lessons
- Children's choirs leading worship in parish churches and community events
- Poetry and spoken word competitions for children to express their faith
- Dance groups performing at outreaches, Children's Sundays, and special events
- MDD&P activities conducted in English, Luganda, and Runyakitara

📌 Note: This is a SEPARATE program from Sports. The original document had duplicate content here — this is the corrected version.

## Program 3 — Community Outreaches

- Icon: 🤝 Community/hands icon
- Section heading: "Community Outreaches"

CONTENT: Each year, KACM organises scheduled outreaches into communities across the Kazo Archdeaconry. These outreaches are moments of tangible grace — where the love of Christ is shown through practical action: food distribution, healthcare, education support, and prayer.

Key activities:
- Distribution of food, clothing, and essential supplies to vulnerable families
- Free medical and health awareness camps in underserved communities
- School visits and educational awareness campaigns to reduce dropout rates
- Child protection sensitisation for parents, teachers, and community leaders
- Prayer and evangelism sessions in homes, schools, and public spaces

---

# PAGE 5 — OUR PROJECTS

Scripture: "For I was hungry and you gave me food, I was thirsty and you gave me drink, I was a stranger and you welcomed me." — Matthew 25:35

## Project 1 — Farm to Fork

- Icon/image: farm/agriculture photo or icon
- Section heading: "Farm to Fork"
- Tagline: "From Our Land to Every Child's Plate"

CONTENT: The Farm to Fork project addresses the critical challenge of child malnutrition in the Kazo Archdeaconry. KACM cultivates organic food on ministry land, ensuring that children in our programmes have access to nutritious meals. Surplus produce is sold to generate income that is reinvested into meeting the basic needs of children.

- Organic farming of vegetables, fruits, and grains to address nutritional deficiencies
- Agri-tourism activities that invite visitors to learn about sustainable farming and support the project
- Income generated from farm sales directly supports children's welfare programmes
- Children and youth participate in the farm, learning practical agriculture and life skills

## Project 2 — Resource Centre

- Icon/image: computers or learning centre photo
- Section heading: "Resource Centre"
- Tagline: "Equipping the Next Generation with Digital Skills"

CONTENT: The KACM Resource Centre is an investment in the future. Recognising that digital skills are essential in today's world, we have established a centre where young people gain ICT competencies, life skills, and vocational training that prepare them for employment, entrepreneurship, and responsible citizenship.

- Computer literacy training for secondary school students and out-of-school youth
- Internet access and digital research support for students
- Life skills workshops covering leadership, communication, financial literacy, and health
- Vocational guidance sessions to help youth identify and pursue career pathways

## Project 3 — Sponsor a Child

- This section deserves the most visual space on the Projects page — it is the primary donor conversion point
- Scripture: "Defend the weak and the fatherless; uphold the cause of the poor and the oppressed." — Psalm 82:3

### The Problem

CONTENT: The leading cause of school dropouts in Uganda is poverty. Most families in the Kazo Archdeaconry survive on less than $1–2 per day, making it impossible for parents to afford school fees, uniforms, books, and other educational requirements. When a child drops out of school, the consequences last a lifetime — limiting their opportunities and perpetuating the cycle of poverty.

### How Sponsorship Works

- Our community-based Sunday school teachers and local leaders conduct vulnerability assessments to identify children in greatest need
- Each qualifying child's background information is carefully collected, verified, and securely stored
- When a sponsor comes forward, they are matched with a child whose profile fits their chosen category
- Sponsor receives regular progress reports, photos, and academic updates

### Sponsorship Categories & Monthly Costs

📌 Note: The original document had a pricing error (two entries at $30). The corrected table below is the official version to use.

CATEGORY | MONTHLY COST (USD) | WHAT IT COVERS
Primary – Fees Only | $20 / month | School fees paid directly to school
Primary – Full Package | $30 / month | Fees + books, uniform, pens, geometry set
Secondary – Fees Only | $35 / month | Secondary school fees only
Secondary – Full Package | $40 / month | Fees + requirements
Secondary – Boarding | $70 / month | Full boarding school package
Vocational / Tertiary | $75 / month | Vocational or tertiary education fees
University Tuition | $116 / month | Average university tuition (varies by course)

### How to Become a Sponsor

- "Sponsor a Child Now" CTA button — prominent, gold, large
- Email link: sponsorship@kacm.org (this is the verified contact for sponsorship enquiries)
- 4-step visual process flow:
  - Step 1: Send an email to sponsorship@kacm.org expressing interest
  - Step 2: Our team responds with programme details and available children
  - Step 3: Choose your sponsorship category and be matched with a child
  - Step 4: Complete payment and receive your child's profile and first update

⚠️ ACTION REQUIRED: Confirm the sponsorship email address is live and monitored: sponsorship@kacm.org. This email must be checked regularly as it is the primary sponsor conversion point.

---

# PAGE 6 — WHAT WE DO

Scripture: "Start children off on the way they should go, and even when they are old they will not turn from it." — Proverbs 22:6

Display each activity as a distinct card or section with icon, heading, and description paragraph.

## 1. Prayer and Fellowship

CONTENT: At the heart of KACM is prayer. Children are taught how to pray — both individually and corporately — and how to build meaningful, Christ-centred friendships with their peers. Regular prayer groups, devotions, and Sunday school fellowships create a community of faith where children feel safe, loved, and spiritually nourished.

## 2. Life Skills and Character Building

CONTENT: KACM designs lessons that go beyond academics to shape the values and character of every child. Through interactive activities, play, drawing, storytelling, and group discussions, children are taught respect, obedience, kindness, integrity, and responsibility — qualities that form the foundation of a Godly life and a productive citizen.

## 3. Language Integration

CONTENT: KACM is committed to reaching every child in a language they understand. While some churches teach in English, many of our programmes utilise national languages — particularly Luganda and Runyakitara — using carefully translated materials to ensure the Gospel and life lessons reach every child effectively, regardless of their language background.

## 4. Offertory and Giving

CONTENT: Children at KACM are encouraged to bring a small offering to church, teaching them from an early age the biblical principle of generosity. Through this practice, children learn the importance of giving, supporting the work of the Church, and trusting God as their provider.

## 5. Children's Sundays

CONTENT: Once a month, or at least once per quarter, churches within the Kazo Archdeaconry dedicate an entire Sunday service to the children. On these special days, the youth fully lead the service — including praise, worship, scripture reading, and prayer. Children's Sundays are a powerful celebration of the faith and gifts of the next generation.

## 6. Child Psychosocial and Legal Support

Scripture: "He heals the brokenhearted and binds up their wounds." — Psalm 147:3

CONTENT: KACM provides psychosocial and legal support to child survivors of violence, abuse, and exploitation. Our goal is to mitigate the long-term impact of trauma, restore dignity, and improve access to health and justice services for affected children.

- Counselling services delivered in partnership with CBOs and trained community volunteers
- Rehabilitation support for children who have experienced rights abuse
- Referral pathways to health services, legal aid, and safe shelter where required
- Family sensitisation and community awareness to prevent future incidents of violence

## 7. Child Rights Advocacy

CONTENT: KACM actively advocates for the rights and welfare of children within the legal and policy frameworks of Uganda. We engage with local government, community leaders, and church authorities to promote child-friendly laws, policies, and practices — and to hold accountable those who violate the rights of children.

---

# PAGE 7 — DONATE

📌 Note: This is the most critical conversion page. Every element must drive the visitor toward making a donation. No vague content allowed.

## Page Hero / Headline

- Full-width banner. Background: purple. Large white text.
- Headline: "Change a Child's Life Today"
- Subheadline: "Behind every statistic is a real child with a name, a dream, and a future that depends on your generosity."
- Scripture: "Each of you should give what you have decided in your heart to give, not reluctantly or under compulsion, for God loves a cheerful giver." — 2 Corinthians 9:7

## Impact Donation Table

Display as a visually styled table with icons. Each row: dollar amount, bold impact statement.

Monthly Amount | What It Does
$20 / month | Keeps one child in primary school for a full month
$30 / month | Covers a primary school child's fees, uniform, and books
$40 / month | Pays secondary school fees and requirements for one child
$70 / month | Fully sponsors a child in a secondary boarding school
$75 / month | Funds vocational education — giving a young person a trade and a future
$116 / month | Covers one month of university tuition — a life-changing investment
Any amount | Supports Farm to Fork, the Resource Centre, or community outreach activities

## Payment Methods Section

Display with payment method logos. Subheading: "Donating to KACM is Safe, Simple and Secure." Powered by Flutterwave.

Local Donors (Uganda) | International Donors
MTN Mobile Money / Airtel Money / Visa / Mastercard (via Flutterwave) | Visa Card / Mastercard / American Express / PayPal (international transfers)

## Donate Now Button

- Large, prominent gold button: "Donate Now" — centered, full-width on mobile
- Links to Flutterwave payment page (developer to integrate with KACM's Flutterwave account)
- Below button: padlock icon + text "Secure payments powered by Flutterwave"

## Transparency & Accountability Section

Scripture: "Whoever can be trusted with very little can also be trusted with much." — Luke 16:10

Paragraph: KACM is a registered ministry of the Church of Uganda under the Namirembe Diocese. Annual financial summaries and programme impact reports are available to all donors upon request. Every sponsoring donor receives regular updates on the child or project they are supporting.

Trust badges to display:
- Church of Uganda affiliation badge
- Namirembe Diocese seal
- Flutterwave secure payments badge
- "Annual reports available on request" statement with email link

---

# PAGE 8 — MEDIA & UPDATES

Scripture: "How beautiful on the mountains are the feet of those who bring good news." — Isaiah 52:7

This page serves as the KACM content hub — all news, updates, and resources in one place.

## Media Sections (Tab or Grid Layout)

Section | Content & Developer Notes
Press Releases | Official announcements from KACM and the Namirembe Diocese. Display as list with date, title, and short excerpt. Download as PDF option.
Articles | In-depth reads on child welfare, education, and ministry work in Uganda. Display as blog card grid: thumbnail, title, date, 2-line excerpt, "Read More" link.
Events | Past event coverage and upcoming event announcements. Include event name, date, location, and photo.
Gallery | Photo and video gallery from outreaches, Children's Sundays, sports tournaments, and MDD&P performances. Use masonry or grid layout with lightbox popup.
Library | Resources, reports, and reading materials. Downloadable PDF files. Include title, description, and download button.
Success Stories | Real-life testimonies of transformed children and communities. Feature article format with photo, name, story. Link to Testimonies page.
Newsletter | "Subscribe to Our Newsletter" form: name + email fields + Subscribe button. Display archive of past newsletters.

## Video Section

📌 Note: KACM should record a 2–3 minute ministry video (children in Sunday school, outreach, sports) as soon as possible. Even a phone-recorded video significantly increases donor engagement. Embed on this page and on the homepage.

- Video embed: YouTube or Vimeo embed (youtube.com/KACMUganda)
- If no video yet: placeholder section with text "Watch Our Story — Coming Soon"

---

# PAGE 9 — TESTIMONIES

Scripture: "I will tell of the kindnesses of the Lord, the deeds for which he is to be praised." — Isaiah 63:7

Three subsections. All content to be supplied by KACM before launch.

## From Our Sponsors

Written or video testimonials from international and local sponsors. Each entry includes:
- Sponsor's first name and last initial (e.g. "Sarah M.")
- Country of origin
- Photo (optional, if provided)
- Testimony text — 3–5 sentences about their giving experience

⚠️ ACTION REQUIRED: KACM sponsorship team must collect written or recorded testimonials from existing sponsors. Reach out to current sponsors via email. Target: at least 3 sponsor testimonials for launch.

## From Sponsored Children

Testimonials from children who have benefited from the Sponsor a Child programme. Each entry includes:
- Child's first name only (no surname for child protection)
- School level (e.g. Primary 6, Senior 2)
- Photo — with written parental/guardian consent
- Short testimony — 2–3 sentences in the child's voice

⚠️ ACTION REQUIRED: Sunday school teachers and Parish Coordinators must collect written parental consent before any child's photo or story is published online.

## From Our Communities

Testimonials from parents, local leaders, and community members. Each entry includes: name, village/parish, role (e.g. parent, local chairman), short testimony paragraph.

---

# PAGE 10 — CONTACT US

Scripture: "Ask and it will be given to you; seek and you will find; knock and the door will be opened to you." — Matthew 7:7

## Contact Details

Channel | Details
📍 Physical Address | Kazo Archdeaconry Headquarters, Kazo, Kiruhura District, Western Uganda
📧 General Enquiries | info@kacm.org
📧 Sponsorship Team | sponsorship@kacm.org
📞 Phone / WhatsApp | [INSERT KACM PHONE NUMBER — required before launch]
🌐 Website | www.kacm.org
📘 Facebook | facebook.com/KACMUganda
📸 Instagram | @KACMUganda
▶️ YouTube | youtube.com/KACMUganda

⚠️ ACTION REQUIRED: The KACM phone/WhatsApp number must be provided before launch. This is a critical contact field — many donors and sponsors will use WhatsApp to reach KACM.

## Contact Form

Embedded web form with the following fields:

Field | Type & Notes
Full Name | Text input | Required
Email Address | Email input | Required | Validated
Phone Number | Tel input | Optional
Subject | Dropdown: General Enquiry | Sponsorship | Donation | Partnership | Media | Other
Message | Textarea | Min 20 characters | Required
Submit Button | Purple button: "Send Message" | On submit: confirmation message shown + email sent to info@kacm.org and WhatsApp notification

## Interactive Map

- Embed a Google Map showing Kazo, Kiruhura District, Western Uganda
- Pin label: "Kazo Archdeaconry Headquarters — KACM"
- Map should be responsive and mobile-friendly
- Below map: note for international visitors — "Kazo is located in Kiruhura District, Western Uganda, approximately 300km from Kampala."

---

# TECHNICAL SPECIFICATIONS

## Platform Recommendations

Aspect | Recommendation
CMS (Content Mgmt) | WordPress with Elementor OR custom HTML/CSS/JS. WordPress recommended for KACM staff to update content themselves without coding.
Hosting | Any reliable host with Uganda-friendly server latency. SiteGround, Namecheap, or Afrihost recommended.
Domain | www.kacm.org — confirm ownership and DNS is pointed correctly
SSL Certificate | Required — HTTPS mandatory, especially for donation page. Free via Let's Encrypt.
Email Setup | Google Workspace or Zoho Mail for info@kacm.org and sponsorship@kacm.org
Payment Gateway | Flutterwave — developer must create and integrate a Flutterwave account for KACM. Supports MTN, Airtel, Visa, Mastercard, PayPal.
Analytics | Google Analytics 4 — install on all pages to track donor journeys
Newsletter | Mailchimp free plan — integrates with website signup forms

## Responsive Design Requirements

- Mobile-first design — majority of Uganda visitors browse on mobile
- Breakpoints: Mobile (320–767px), Tablet (768–1023px), Desktop (1024px+)
- Floating WhatsApp button must be visible and tappable on all screen sizes
- Navigation collapses to hamburger menu on mobile
- Donation table and sponsorship table must scroll horizontally on mobile

## Performance & Accessibility

- Page load target: under 3 seconds on mobile (compress all images)
- All images: compress to WebP format, max 200KB per image
- Alt text required on all images for accessibility and SEO
- All text must meet WCAG AA contrast ratio against background colors
- Forms must be keyboard-navigable

## SEO Basics

- Page title tags and meta descriptions for all 10 pages
- Structured data markup for organization (schema.org/NGO)
- XML sitemap submitted to Google Search Console
- Google My Business listing for Kazo Archdeaconry Headquarters

---

# PRE-LAUNCH CHECKLIST

All items below must be completed before the website is made public.

## Content — Must Be Provided by KACM

Item | Status / Owner
KACM phone/WhatsApp number | ⬜ KACM Admin
Year KACM was founded | ⬜ KACM Admin
Full team names, titles, photos, and bios | ⬜ All team members
Parish list for About page and Team page | ⬜ KACM Coordinator
Parental consent forms for child photos | ⬜ Parish Coordinators
3+ sponsor testimonials | ⬜ Sponsorship Team
3+ child/community testimonials (with consent) | ⬜ Sunday School Teachers
Real photos of children in ministry activities | ⬜ KACM Admin
Church of Uganda logo (PNG/SVG) | ⬜ Namirembe Diocese Office
Namirembe Diocese seal (PNG/SVG) | ⬜ Namirembe Diocese Office
NGO/CBO registration number (if applicable) | ⬜ KACM Admin
Ministry video (2–3 minutes) | ⬜ KACM Media Team

## Technical — Developer Checklist

Task | Status
Domain (kacm.org) pointed to hosting | ⬜ Developer
SSL certificate installed (HTTPS) | ⬜ Developer
Flutterwave account created and tested | ⬜ Developer + KACM Admin
Contact form connected to info@kacm.org | ⬜ Developer
WhatsApp button linked to KACM number | ⬜ Developer
Google Analytics 4 installed | ⬜ Developer
Google Map embedded on Contact page | ⬜ Developer
All 10 pages responsive on mobile | ⬜ Developer
All images compressed (WebP) | ⬜ Developer
Newsletter signup connected to Mailchimp | ⬜ Developer
Cross-browser testing (Chrome, Safari, Firefox) | ⬜ Developer
Social media links tested (Facebook, Instagram, YouTube) | ⬜ Developer
Email addresses (info@kacm.org, sponsorship@kacm.org) live | ⬜ KACM Admin

---

KAZO ARCHDEACONRY CHILDREN'S MINISTRY (KACM)
Church of Uganda | Namirembe Diocese | www.kacm.org

"I can do all this through him who gives me strength." — Philippians 4:13
