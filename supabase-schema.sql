-- KACM Supabase Schema
-- Paste this into Supabase SQL Editor and run it

-- ====== TEAM MEMBERS ======
CREATE TABLE team_members (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    category TEXT NOT NULL CHECK (category IN ('leadership','executive','coordinator','teacher')),
    name TEXT NOT NULL,
    role_title TEXT DEFAULT '',
    bio TEXT DEFAULT '',
    image TEXT DEFAULT '',
    parish TEXT DEFAULT '',
    church TEXT DEFAULT '',
    display_order INT DEFAULT 0,
    visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== TESTIMONIALS ======
CREATE TABLE testimonials (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    category TEXT NOT NULL CHECK (category IN ('sponsor','child','community')),
    author TEXT NOT NULL,
    location TEXT DEFAULT '',
    content TEXT NOT NULL,
    image TEXT DEFAULT '',
    display_order INT DEFAULT 0,
    visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== PROJECTS ======
CREATE TABLE projects (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    title TEXT NOT NULL,
    tagline TEXT DEFAULT '',
    description TEXT DEFAULT '',
    image TEXT DEFAULT '',
    features TEXT DEFAULT '',
    display_order INT DEFAULT 0,
    visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== GALLERY ======
CREATE TABLE gallery (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    filename TEXT NOT NULL,
    alt_text TEXT DEFAULT '',
    label TEXT DEFAULT '',
    display_order INT DEFAULT 0,
    visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== MEDIA ARTICLES ======
CREATE TABLE media_articles (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    title TEXT NOT NULL,
    excerpt TEXT DEFAULT '',
    image TEXT DEFAULT '',
    article_date DATE DEFAULT NULL,
    category TEXT DEFAULT 'article',
    link TEXT DEFAULT '',
    visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== HERO SLIDES ======
CREATE TABLE hero_slides (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    heading TEXT NOT NULL,
    subtitle TEXT DEFAULT '',
    scripture TEXT DEFAULT '',
    button1_text TEXT DEFAULT '',
    button1_link TEXT DEFAULT '',
    button2_text TEXT DEFAULT '',
    button2_link TEXT DEFAULT '',
    background_image TEXT DEFAULT '',
    display_order INT DEFAULT 0,
    visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== SETTINGS ======
CREATE TABLE settings (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    setting_key TEXT UNIQUE NOT NULL,
    setting_value TEXT DEFAULT ''
);

-- ====== CONTACT MESSAGES ======
CREATE TABLE contact_messages (
    id BIGINT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    subject TEXT DEFAULT '',
    message TEXT NOT NULL,
    read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- ====== DEFAULT SETTINGS ======
INSERT INTO settings (setting_key, setting_value) VALUES
    ('site_name', 'Kazo Archdeaconry Children''s Ministry'),
    ('site_tagline', 'Nurturing Every Child in the Love of Christ'),
    ('contact_email', 'kazoarchdeaconry@yahoo.com'),
    ('contact_phone', '0771 905 447 / 0709 754 900'),
    ('facebook_url', 'https://facebook.com/KACMUganda'),
    ('instagram_url', 'https://instagram.com/KACMUganda'),
    ('youtube_url', 'https://youtube.com/KACMUganda'),
    ('whatsapp_number', '0771905447'),
    ('address', 'Kazo Archdeaconry Headquarters, Kazo, Kawempe, Kampala, Uganda'),
    ('footer_copyright', '© 2025 Kazo Archdeaconry Children''s Ministry. Registered under Church of Uganda, Namirembe Diocese.')
ON CONFLICT (setting_key) DO NOTHING;
