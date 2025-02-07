DROP DATABASE IF EXISTS foodblog;

CREATE DATABASE foodblog;

USE foodblog;

CREATE TABLE auteurs (
    id int NOT NULL AUTO_INCREMENT,
    auteur varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE posts (
    id int NOT NULL AUTO_INCREMENT,
    titel varchar(255),
    datum datetime DEFAULT current_timestamp(),
    img_url varchar(255),
    inhoud TEXT,
    auteur_id int NOT NULL,
    FOREIGN KEY (auteur_id) REFERENCES auteurs (id),
    PRIMARY KEY (id)
);

INSERT INTO auteurs (auteur)
VALUES
('Wim Ballieu'),
('Mounir Toub'),
('Miljuschka');

INSERT INTO posts (titel, datum, img_url, inhoud, auteur_id)
VALUES
    ('Pindakaas', '2020:06:18 13:25:00', 'https://i.ibb.co/C0Lb7R1/pindakaas.jpg','Verwarm de oven voor op 180 °C. Verdeel de pinda’s over een met bakpapier beklede bakplaat en rooster in ca. 8 min. lichtbruin. Schep regelmatig om. Maal de warme pinda’s in de keukenmachine in 4 min. tot een grove, dikke pindakaas. Schep de rand van de kom regelmatig schoon met een spatel. Voeg het zout, de olie en honing toe en maal nog 1 min. tot een gladde pindakaas. Schep in een pot en sluit af.
        variatietip: Houd je van pindakaas met een smaakje? Voeg dan na de honing 1 el sambal badjak, 1 tl gemalen kaneel of 1 el fijngehakte pure chocolade toe. bewaartip: Je kunt de pindakaas 3 weken in de koelkast bewaren.', 1),
    ('Baklava', '2020:03:11 10:28:00', 'https://i.ibb.co/ZWVRdPT/baklava.jpg','Voorbereiding

    Verwarm de oven voor op 190 °C. Vet de bakvorm in met roomboter.
    Smelt de roomboter in een pannetje. Snijd het baklavadeeg op dezelfde breedte als de bakvorm en bewaar het in een schone droge keukendoek om uitdrogen te voorkomen. Verwarm in een pan 300 gr honing met 20 ml oranjebloesemwater en houd dit mengsel warm. Roer in een mengkom de gezouten roomboter, 500 g gemalen walnoten, de rest van de honing en het oranjebloesemwater en de kaneel door elkaar. Verdeel het mengsel in zeven gelijke porties (van circa 90 g).

    Bereiding
    Bestrijk een vel baklavadeeg met gesmolten roomboter. Leg er een tweede vel op en bestrijk dat ook. Neem één portie van het walnotenmengsel en verdeel dat onderaan over het baklavadeeg. Rol op tot een staaf, leg deze in de bakvorm en bestrijk met gesmolten roomboter. Maak de rest van de staven op dezelfde manier.
    Snijd elke staaf met een scherp mes meteen in zessen. Bak de baklava in circa 25 minuten goudbruin en krokant in de oven.
    Neem de bakvorm uit de oven en verdeel de warme honing over de baklava. Garneer meteen met de rest van de fijngemalen walnoten. Laat de baklava minimaal 3 uur afkoelen voordat je ervan gaat genieten.', 2);

ALTER TABLE posts
ADD likes int NOT NULL DEFAULT 0;

USE `foodblog`;

CREATE TABLE tags (
    id int NOT NULL AUTO_INCREMENT,
    titel varchar(255) UNIQUE,
    PRIMARY KEY (id)
);

USE `foodblog`;

CREATE TABLE posts_tags (
    post_id int NOT NULL,
    tag_id int NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts (id),
    FOREIGN KEY (tag_id) REFERENCES tags (id),
    PRIMARY KEY (post_id, tag_id) 
);