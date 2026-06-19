-- Seed data for team_members (from current team.html)
-- Paste this into Supabase SQL Editor and run it after the schema

-- ====== LEADERSHIP ======
INSERT INTO team_members (category, name, role_title, bio, image, display_order, visible) VALUES
('leadership', 'Rt. Rev. Dr. Moses Banja', 'Bishop, Namirembe Diocese', 'Rt. Rev. Dr. Moses Banja serves as the Bishop of Namirembe Diocese, providing spiritual oversight and apostolic leadership under which KACM operates. His visionary leadership continues to strengthen children''s ministry across the diocese.', 'assets/bishop-banja.jpg', 1, true),
('leadership', 'Ven. Canon David Mpagi', 'Archdeacon, Kazo Archdeaconry', 'Ven. Canon David Mpagi serves as the Archdeacon of Kazo Archdeaconry, providing spiritual leadership across all parishes and championing the cause of children''s welfare throughout the Archdeaconry.', 'assets/archdeacon-mpagi.jpg', 2, true),
('leadership', 'Rev. Semei Sebina Sekiziyivu', 'KACM Rev. Coordinator', 'Rev. Semei Sebina Sekiziyivu coordinates all KACM activities across parishes, working tirelessly to ensure every programme aligns with our mission of nurturing children in the love of Christ.', 'assets/Cordinator Rev semei.jpeg', 3, true),
('leadership', 'Ms. Betty Kibirango', 'Council Coordinator', 'Ms. Betty Kibirango leads the KACM Council, ensuring effective governance, strategic planning, and accountability across all ministry operations and partnerships.', '', 4, true);

-- ====== EXECUTIVE MEMBERS ======
INSERT INTO team_members (category, name, role_title, bio, image, display_order, visible) VALUES
('executive', 'Chairperson', 'Chairperson', 'Provides overall leadership and coordination of the children''s ministry across the Archdeaconry. Also serves as a Sunday school teacher at St. Peter''s Kisaasi, Kisaasi Parish.', 'assets/chairperson.jpeg', 1, true),
('executive', 'Vice Chairperson', 'Vice Chairperson', 'Supports the Chairperson in overall ministry coordination and deputises in their absence. Oversees parish-level programme implementation across the Archdeaconry.', '', 2, true),
('executive', 'Mrs. Agnes K. Nantume', 'Secretary', 'Oversees all administrative records, meeting minutes, and official correspondence for KACM.', '', 3, true),
('executive', 'Mr. Robert M. Byaruhanga', 'Treasurer', 'Manages KACM''s finances with transparency, ensuring every donation is stewarded faithfully.', '', 4, true),
('executive', 'Publicity Secretary', 'Publicity', 'Manages media, communications, and public awareness for KACM programmes. Also serves as a Sunday school teacher at All Saints Kabunza, Lwadda Parish.', 'assets/publicity.jpeg', 5, true),
('executive', 'Mrs. Florence A. Kansiime', 'Programs Coordinator', 'Leads the design and implementation of all child-focused programmes across the Archdeaconry.', '', 6, true),
('executive', 'Mr. Patrick K. Turyamureeba', 'Sponsorship Lead', 'Coordinates the Sponsor a Child programme, matching children in need with generous sponsors worldwide.', '', 7, true),
('executive', 'Babirye Tabitha', 'Disciplinary', 'Responsible for maintaining discipline and child protection standards across all KACM activities and Sunday school programmes.', 'assets/coordinators/tabitha.png', 8, true),
('executive', 'Musisi Douglas', 'Sports & MDD', 'Coordinates sports and music, dance & drama activities across the Archdeaconry. Serves at St. Peter''s Kawaala, Kawaala Parish.', 'assets/sports and mdd.jpeg', 9, true),
('executive', 'Kweronda Charity', 'Good Samaritan', 'Leads community outreach and welfare support for vulnerable children and families. Serves at St. Peter''s Kisaasi, Kisaasi Parish.', 'assets/good samaritan.jpeg', 10, true),
('executive', 'Ssekatawa Hamann', 'Transport', 'Manages transportation logistics for KACM programmes and events. Serves at St. Apollo Kivebulaya, Maganjo Parish.', 'assets/transport.jpeg', 11, true),
('executive', 'Nampijja Maureen', 'Assistant Games & Sports', 'Assists in organising and coaching sports activities for children across parishes. Serves at St. Paul Ebenezeri, Kazo Parish.', 'assets/Assistant games and sports.jpeg', 12, true),
('executive', 'Bogere Richard', 'Development', 'Oversees resource mobilisation, project development, and income-generating initiatives for the ministry. Serves at St. Apollo Kivebulaya, Maganjo Parish.', 'assets/Development Tr Bogere Richard  part of executive and also Sunday school teachers at st apollo kivebulaya.jpeg', 13, true);

-- ====== PARISH COORDINATORS ======
INSERT INTO team_members (category, name, role_title, bio, image, parish, display_order, visible) VALUES
('coordinator', 'Ssalongo Kato Emmanuel Ssonko', 'Kazo Parish', 'Coordinates all children''s activities at the Archdeaconry headquarters parish.', 'assets/coordinators/kazo.jpeg', 'Kazo', 1, true),
('coordinator', 'Luyinda Enock', 'Kawempe Parish', 'Leads sports ministry and Sunday school programmes in Kawempe.', 'assets/coordinators/kawempe.jpeg', 'Kawempe', 2, true),
('coordinator', 'Harriet Ssenengo', 'Maganjo Parish', 'Champions community outreach and child sponsorship in Maganjo.', 'assets/coordinators/maganjo.jpeg', 'Maganjo', 3, true),
('coordinator', 'Kweronda Charity', 'Kisaasi Parish', 'Coordinates children''s ministry, music and arts programmes in Kisaasi.', 'assets/coordinators/kisasi.jpeg', 'Kisaasi', 4, true),
('coordinator', 'Lwanga Fredrick', 'Lwadda Parish', 'Coordinates sponsorship and child welfare programmes across Lwadda.', 'assets/coordinators/lwadda.jpeg', 'Lwadda', 5, true),
('coordinator', 'Ayebale Loyce', 'Kawaala Parish', 'Leads community outreach and children''s ministry programmes in Kawaala.', 'assets/coordinators/kawaala.jpeg', 'Kawaala', 6, true),
('coordinator', 'Nabweru Parish', 'Nabweru', 'Coordinates children''s ministry activities at St. Luke Nabweru and surrounding churches.', '', 'Nabweru', 7, true),
('coordinator', 'Kasubi Parish', 'Kasubi', 'Coordinates children''s ministry across St. Andrew''s Kasubi and surrounding churches.', '', 'Kasubi', 8, true),
('coordinator', 'Kiwunya Parish', 'Kiwunya', 'Coordinates children''s ministry at St. Thomas Kiwunya and surrounding churches.', '', 'Kiwunya', 9, true),
('coordinator', 'Kyebando Parish', 'Kyebando', 'Coordinates children''s ministry at St. Paul Kyebando and surrounding churches.', '', 'Kyebando', 10, true),
('coordinator', 'Mrs. Agnes K. Nantume', 'Mpwelerwe Parish', 'Oversees children''s ministry administration across Mpwelerwe parishes.', '', 'Mpwelerwe', 11, true),
('coordinator', 'Mr. Robert M. Byaruhanga', 'Kawanda Parish', 'Coordinates Sunday school and youth activities in Kawanda.', '', 'Kawanda', 12, true);

-- ====== SUNDAY SCHOOL TEACHERS ======
INSERT INTO team_members (category, name, role_title, bio, image, parish, church, display_order, visible) VALUES
('teacher', 'Mrs. Annet K. Tibihika', 'St. Luke Kazo, Kazo Parish', 'Dedicated teacher nurturing faith in young children through Bible stories and song.', 'assets/coordinators/sunday school teacher.jpeg', 'Kazo', 'St. Luke Kazo', 1, true),
('teacher', 'Babirye Tabitha', 'Disciplinary / Sunday School Teacher', 'Dedicated teacher committed to nurturing children in faith and guiding them in the love of Christ. Also serves as KACM Disciplinary head.', 'assets/coordinators/tabitha.png', 'Kazo', 'St. Luke Kazo', 2, true),
('teacher', 'Chairperson', 'St. Peter''s Kisaasi, Kisaasi Parish', 'Leads by example, teaching Sunday school at St. Peter''s Kisaasi while coordinating the overall children''s ministry across the Archdeaconry.', 'assets/chairperson.jpeg', 'Kisaasi', 'St. Peter''s Kisaasi', 3, true),
('teacher', 'Publicity Secretary', 'All Saints Kabunza, Lwadda Parish', 'Faithful Sunday school teacher at All Saints Kabunza, sharing God''s word with children while managing KACM''s communications.', 'assets/publicity.jpeg', 'Lwadda', 'All Saints Kabunza', 4, true),
('teacher', 'Musisi Douglas', 'St. Peter''s Kawaala, Kawaala Parish', 'Teachers Sunday school and coordinates sports & MDD activities, helping children grow in faith through physical activity and the arts.', 'assets/sports and mdd.jpeg', 'Kawaala', 'St. Peter''s Kawaala', 5, true),
('teacher', 'Kweronda Charity', 'St. Peter''s Kisaasi, Kisaasi Parish / Good Samaritan', 'Teaches Sunday school at St. Peter''s Kisaasi and leads the Good Samaritan outreach programme supporting vulnerable children.', 'assets/good samaritan.jpeg', 'Kisaasi', 'St. Peter''s Kisaasi', 6, true),
('teacher', 'Ssekatawa Hamann', 'St. Apollo Kivebulaya, Maganjo Parish', 'Dedicated Sunday school teacher at St. Apollo Kivebulaya, also managing transport logistics for KACM programmes.', 'assets/transport.jpeg', 'Maganjo', 'St. Apollo Kivebulaya', 7, true),
('teacher', 'Nampijja Maureen', 'St. Paul Ebenezeri, Kazo Parish', 'Teaches Sunday school and assists in organising games and sports activities for children at St. Paul Ebenezeri.', 'assets/Assistant games and sports.jpeg', 'Kazo', 'St. Paul Ebenezeri', 8, true),
('teacher', 'Bogere Richard', 'St. Apollo Kivebulaya, Maganjo Parish / Development', 'Faithful Sunday school teacher at St. Apollo Kivebulaya and leads development initiatives for the ministry.', 'assets/Development Tr Bogere Richard  part of executive and also Sunday school teachers at st apollo kivebulaya.jpeg', 'Maganjo', 'St. Apollo Kivebulaya', 9, true),
('teacher', 'Kakeeto Ivan', 'St. James Bwaise, Kazo Parish', 'Dedicated Sunday school teacher at St. James Bwaise, committed to nurturing children in faith and guiding them in the love of Christ.', 'assets/kakeeto ivan sunday school teacher st jamesbwaise.jpeg', 'Kazo', 'St. James Bwaise', 10, true);
