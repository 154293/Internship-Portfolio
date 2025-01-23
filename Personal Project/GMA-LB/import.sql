DROP DATABASE IF EXISTS `gma`;

CREATE DATABASE `gma`;

USE `gma`;

CREATE TABLE games (
    g_id INT NOT NULL,
    name varchar(255),
    PRIMARY KEY (g_id)
);

INSERT INTO games (g_id, name)
VALUES
(1, '1'),
(2, 'Wonderlands'),
(3, '2');

CREATE TABLE challenge_types (
    ct_id INT NOT NULL,
    g_id INT NOT NULL,
    tt_hs varchar(2) NOT NULL CHECK (tt_hs = 'TT' OR tt_hs = 'HS'),
    ct_name varchar(255), 
    lb_bool BOOLEAN,
    FOREIGN KEY (game_id) REFERENCES games (g_id),
    PRIMARY KEY (ct_id)
);

INSERT INTO challenge_types (ct_id, g_id, tt_hs, ct_name, lb_bool)
VALUES
(1, 1, 'TT', 'Race', TRUE),
(2, 1, 'TT', 'Trial', TRUE),
(3, 1, 'TT', 'Top To Bottom', TRUE),
(4, 1, 'HS', 'Rail', FALSE),
(5, 1, 'HS', 'Slap', TRUE),
(6, 1, 'HS', 'Airtime', TRUE),
(7, 1, 'HS', 'Long Jump', TRUE),
(8, 1, 'HS', 'Distance', TRUE),
(9, 1, 'HS', 'Single Drop', TRUE),
(10, 1, 'HS', 'Triple Drop', TRUE),
(11, 1, 'HS', 'Single Trick', TRUE),
(12, 1, 'HS', 'Gated Trick', TRUE),
(13, 1, 'HS', 'Open Trick', TRUE);

CREATE TABLE mountains (
    m_id INT NOT NULL,
    game_id INT NOT NULL,
    m_name varchar(255),
    FOREIGN KEY (game_id) REFERENCES games (g_id),
    PRIMARY KEY (m_id)
);

INSERT INTO mountains (m_id, game_id, m_name)
VALUES
(1, 1, 'Hirschalm'),
(2, 1, 'Waldtal'),
(3, 1, 'Elnakka'),
(4, 1, 'Dalarna'),
(5, 1, 'Rotkamm'),
(6, 1, 'Saint Luvette'),
(7, 1, 'Passo Grolla'),
(8, 1, 'Ben Ailig'),
(9, 1, 'Mount Fairview'),
(10, 1, 'Pinecone Peaks'),
(11, 1, 'Agpat Island'),
(12, 2, 'Hirschalm'),
(13, 2, 'Waldtal'),
(14, 2, 'Elnakka'),
(15, 2, 'Dalarna'),
(16, 2, 'Gaupefjord'),
(17, 2, 'Rotkamm'),
(18, 2, 'Saint Luvette'),
(19, 2, 'Passo Grolla'),
(20, 2, 'Ben Ailig'),
(21, 2, 'Charyn Canyon'),
(22, 2, 'Mount Fairview'),
(23, 2, 'Pinecone Peaks'),
(24, 3, 'Dornberg'),
(25, 3, 'Alvdalen'),
(26, 3, 'Fiedeljoch'),
(27, 3, 'Col de Ghironda');

CREATE TABLE challenges (
    c_id int NOT NULL,
    m_id int NOT NULL,
    ct_id int NOT NULL,
    name varchar(255),
    bronze DECIMAL(7, 2),
    silver DECIMAL(7, 2),
    gold DECIMAL(7, 2),
    dd DECIMAL(7, 2),
    td DECIMAL(7, 2),
    FOREIGN KEY (m_id) REFERENCES mountains (m_id),
    FOREIGN KEY (ct_id) REFERENCES challenge_types (ct_id),
    PRIMARY KEY (c_id)
);

INSERT INTO challenges (c_id, m_id, ct_id, name, bronze, silver, gold, dd, td)
VALUES
(1, 1, 1, 'The First Turns', 40.00, 35.00, 33.00, 30.00, 28.00),
(2, 1, 1, 'The Little Adventure', 36.00, 32.00, 30.00, 29.00, 26.50),
(3, 1, 1, 'The Offpist Trail', 50.00, 41.00, 38.00, 36.50, 32.00),
(4, 1, 1, 'The Winding Road', 52.00, 45.00, 43.00, 42.00, 38.50),
(5, 1, 1, 'Brumal Bolt I', 50.00, 46.00, 45.00, 44.00, 40.00),
(6, 1, 2, 'Over The Fence', 70.00, NULL, NULL, NULL, 20.00),
(7, 1, 2, 'The Shortcut', 70.00, NULL, NULL, NULL, 26.00),
(8, 1, 2, 'Jumping The Cracks', 70.00, NULL, NULL, NULL, 25.00),
(9, 1, 2, 'Sightseeing Tour', 70.00, NULL, NULL, NULL, 24.00),
(10, 1, 2, 'The Descent', 70.00, NULL, NULL, NULL, 29.00),
(11, 1, 3, 'Hirschpeak Voyage', 55.00, 45.00, 40.00, NULL, 36.00),
(12, 1, 3, 'Hirschalm Show Off', 45.00, 41.00, 39.00, NULL, 35.00),
(13, 1, 7, 'The Glacier Kicker', 30.0, 35.0, NULL, NULL, 45.0),
(14, 1, 13, 'Glacier Park', 1000, 2000, 3500, 5000, 17000),
(15, 2, 1, 'The Woodland Slalom', 29.00, 27.00, 26.00, 25.50, 24.50),
(16, 2, 1, 'The Woodland Track', 27.00, 25.00, 24.00, 22.20, 21.50),
(17, 2, 1, 'Gemsgully Whites', 41.00, 36.00, 34.00, 32.20, 31.50),
(18, 2, 1, 'Peak To Valley Run', 63.00, 56.00, 54.50, 53.50, 51.00),
(19, 2, 1, 'The Siriside Slalom', 17.00, 16.00, 15.00, 14.60, 14.10),
(20, 2, 1, 'Selme Narrows', 45.00, 42.00, 40.50, 39.50, 37.50),
(21, 2, 1, 'Selme Valley Race', 63.00, 58.00, 55.00, 53.00, 48.50),
(22, 2, 1, 'The Swing Passage', 27.00, 24.00, 21.00, 18.50, 18.00),
(23, 2, 1, 'Brumal Bolt II', 40.00, 34.50, 33.20, 32.00, 29.00),
(24, 2, 2, 'Over The Pist', 70.00, NULL, NULL, NULL, 9.15),
(25, 2, 2, 'Woodland Deep Trail', 70.00, NULL, NULL, NULL, 14.60),
(26, 2, 2, 'The Crowd Pleaser', 70.00, NULL, NULL, NULL, 14.20),
(27, 2, 2, 'The Three Trees', 70.00, NULL, NULL, NULL, 11.50),
(28, 2, 2, 'The Big Kicker', 70.00, NULL, NULL, NULL, 18.50),
(29, 2, 2, 'Little Drops', 70.00, NULL, NULL, NULL, 10.75),
(30, 2, 2, 'A Balancing Act', 70.00, NULL, NULL, NULL, 26.50),
(31, 2, 2, 'The Fatal Drops', 70.00, NULL, NULL, NULL, 13.50),
(32, 2, 3, 'Waldhorn Voyage', 80.00, 75.00, 68.00, NULL, 62.00),
(33, 2, 8, 'The Fork', 225.00, 250.00, 275.00, 295.00, 350.00),
(34, 2, 10, 'Rigid Jumps', 30.00, 38.00, 41.00, 44.00, 55.00),
(35, 2, 10, 'The Waldhorn Falls', 65.00, 73.00, 78.00, 83.00, 90.00),
(36, 2, 12, 'Waldhorn Slopestyle', 4000.00, 5000.00, 7000.00, 10000.00, 28000.00)
(37, 3, 1, 'The Elements', 32.00, 30.00, 29.00, 28.00, 27.50),
(38, 3, 1, 'The Perfect Turns', 18.00, 16.50, 15.50, 15.00, 14.50),
(39, 3, 1, 'The Path Finder', 39.00, 37.00, 35.50, 34.79, 34.00),
(40, 3, 1, 'Super G', 42.00, 40.00, 38.50, 37.50, 37.00),
(41, 3, 1, 'Ellnau Shoulder Track', 42.00, 40.00, 38.00, 36.50, 35.00),
(42, 3, 1, 'Swivel Loop', 18.00, 16.00, 14.00, 11.80, 11.20),
(43, 3, 1, 'Pristine Rush', 30.00, 28.00, 26.50, 25.00, 23.00),
(44, 3, 1, 'Brumal Bolt III', 50.00, 47.00, 45.00, 44.00, 41.00),
(45, 3, 2, 'Clover Road Trail', 70.00, NULL, NULL, NULL, 18.00),
(46, 3, 2, 'Ellnau River Rush', 70.00, NULL, NULL, NULL, 22.00),
(47, 3, 2, 'Across The Clover Ridge', 70.00, NULL, NULL, NULL, 41.00),
(48, 3, 2, 'The Pillow Pass', 70.00, NULL, NULL, NULL, 16.50),
(49, 3, 2, 'Forest Excursion', 70.00, NULL, NULL, NULL, 23.00),
(50, 3, 2, 'The Boulder Valley Pass', 70.00, NULL, NULL, NULL, 21.50),
(51, 3, 2, 'High Jump', 70.00, NULL, NULL, NULL, 8.50),
(52, 3, 2, 'Around Clover Falls', 70.00, NULL, NULL, NULL, 17.00),
(53, 3, 3, 'Elnakka West', 36.00, 32.00, 30.00, NULL, 29.00),
(54, 3, 5, 'Bear Cub Run', 5.00, NULL, NULL, NULL, 12.00),
(55, 3, 5, 'The Pist Bully', 10.00, 16.00, NULL, NULL, 24.00),
(56, 3, 7, 'The Yards', 30.00, 35.00, NULL, NULL, 50.00),
(57, 3, 8, 'Boulder Hill Escape', 200.00, 210.00, 220.00, 240.00, 280.00),
(58, 3, 9, 'Overshooting', 20.00, 35.00, NULL, NULL, 60.00),
(59, 3, 10, 'The Road Gaps', 50.00, 70.00, 90.00, 95.00, 105.00),
(60, 3, 12, 'The Boulder Hill Descent', 3000.00, 6000.00, 9000.00, 12000.00, 30000.00),
(61, 3, 12, 'XL Park World', 4000.00, 7000.00, 9500.00, 14000.00, 30000.00),
(62, 3, 12, 'Terve Jumping', 4000.00, 6000.00, 8000.00, 16000.00, 25000.00),
(63, 3, 13, 'Elnakka Freedom', 5000.00, 7000.00, 8000.00, 10000.00, 22000.00);

CREATE TABLE versions (
    v_id int NOT NULL,
    g_id int NOT NULL,
    platform varchar(255) NOT NULL,
    v_name varchar(255) NOT NULL,
    beta_bool BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (g_id) REFERENCES games (g_id),
    PRIMARY KEY (v_id)
);

INSERT INTO versions (v_id, g_id, platform, v_name, beta_bool)
VALUES
(1, 1, 'Android', 230, FALSE),
(2, 1, 'Android', 231, FALSE),
(3, 1, 'Android', 232, TRUE),
(4, 1, 'iOS', 225, FALSE);

CREATE TABLE user_roles (
    ur_id int NOT NULL,
    ur_name varchar(50),
    PRIMARY KEY (ur_id)
);

INSERT INTO user_roles (ur_id, ur_name)
VALUES
(1, 'User'),
(2, 'Moderator'),
(3, 'Admin');

CREATE TABLE users (
    u_id int NOT NULL AUTO_INCREMENT,
    ur_id int NOT NULL,
    username varchar(32),
    email varchar(320),
    password varchar(60),
    FOREIGN KEY (ur_id) REFERENCES user_roles (ur_id),
    PRIMARY KEY (u_id)
);

INSERT INTO users (ur_id, username, email, password)
VALUES
(3, 'Sven', 'Sven@gmail.com', 'code1234');

CREATE TABLE scores (
    s_id int NOT NULL,
    u_id int NOT NULL,  -- foreign key restraint
    c_id int NOT NULL,  -- foreign key restraint
    date datetime DEFAULT current_timestamp(),
    img_url varchar(255),
    vid_url varchar(255),
    v_id INT NOT NULL,   -- foreign key constraint
    score varchar(8),   -- do checks with php to make it match the challenge format
    comment varchar(255),
    FOREIGN KEY (u_id) REFERENCES users (u_id),
    FOREIGN KEY (c_id) REFERENCES challenges (c_id),
    FOREIGN KEY (v_id) REFERENCES versions (v_id),
    PRIMARY KEY (s_id)
)

-- make verification ticket table
-- foreign key to u_id and s_id