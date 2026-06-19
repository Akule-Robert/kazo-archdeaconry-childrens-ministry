-- Seed Media Articles and Gallery
-- Run in Supabase SQL Editor

-- ====== MEDIA ARTICLES ======
INSERT INTO media_articles (title, excerpt, image, article_date, category, visible) VALUES
('Why Child Sponsorship Works', 'How child sponsorship transforms entire communities, not just individual children.', 'assets/media-sponsorship.jpg', '2025-02-14', 'article', true),
('Integrating Faith and Education', 'How KACM combines spiritual formation with educational support.', 'assets/media-faith-education.jpg', '2024-12-08', 'article', true),
('Child Rights in Uganda', 'An overview of child welfare policy and the role of faith-based organisations.', 'assets/media-child-rights.jpg', '2024-10-20', 'article', true),
('KACM 2024 Annual Report Released', 'Comprehensive report on programme impact and financial stewardship.', '', '2025-03-10', 'press', true),
('Namirembe Diocese Endorses Child Protection Policy', 'Official diocesan statement affirming KACM''s child safeguarding framework.', '', '2025-01-22', 'press', true),
('Farm to Fork Project Wins Community Impact Award', 'KACM recognised for innovative approach to tackling child malnutrition.', '', '2024-11-05', 'press', true),
('Children''s Sunday — All Parishes', 'Youth-led services across all parishes. 9:00 AM', '', '2025-03-15', 'event', true),
('Easter Sports Tournament', 'Annual football & netball tournament. Kazo Sports Ground · 8:00 AM', 'assets/program-sports.jpg', '2025-04-05', 'event', true),
('Child Protection Training', 'Training for Sunday school teachers on safeguarding. KACM HQ · 10:00 AM', '', '2025-04-28', 'event', true),
('From Dropout to University: Grace''s Story', 'How the Sponsor a Child programme helped Grace overcome poverty.', 'assets/media-grace-story.jpg', '2025-01-15', 'story', true),
('Farm to Fork Transforms Livelihoods', 'Three families share how sustainable farming changed their lives.', 'assets/media-farm-fork.jpg', '2024-11-20', 'story', true),
('ICT Skills Open Doors for Youth', 'How the Resource Centre is equipping young people with digital skills.', 'assets/media-ict-skills.jpg', '2024-09-10', 'story', true),
('KACM Quarterly — Q1 2025', 'Children''s Sunday highlights, new sponsors, Farm to Fork harvest report.', '', '2025-03-31', 'newsletter', true),
('KACM Quarterly — Q4 2024', 'Year-end review, Christmas outreach report, 2025 plans.', '', '2024-12-31', 'newsletter', true);

-- ====== GALLERY ======
INSERT INTO gallery (filename, alt_text, label, display_order, visible) VALUES
('assets/Sunday school children kawanda parish.jpeg', 'Children at KACM', 'Children''s Programme', 1, true),
('assets/program-sports.jpg', 'Sports', 'Sports Ministry', 2, true),
('assets/program-arts.jpg', 'Music and dance', 'Music Dance & Drama', 3, true),
('assets/Sunday school lwadda parish.jpeg', 'Community outreach', 'Community Outreach', 4, true),
('assets/project-farming.jpg', 'Farm to Fork', 'Farm to Fork', 5, true),
('assets/project-computer-lab.jpg', 'Resource Centre', 'Resource Centre', 6, true),
('assets/sunday school children group photos/sunday school children all combined.jpeg', 'Children learning', 'Education Support', 7, true),
('assets/sunday school children group photos/sunday school children all raising hands up.jpeg', 'Church service', 'Worship & Fellowship', 8, true);
