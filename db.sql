DROP DATABASE IF EXISTS olympic_db;
CREATE DATABASE olympic_db;
USE olympic_db;

CREATE TABLE role(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255) NOT NULL
);

INSERT INTO role (role)
VALUES
("SuperAdmin"),
("Admin"),
("User")
;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(80) NOT NULL,
    lastname VARCHAR(80) NOT NULL,
    firstname VARCHAR(80) NOT NULL,
    role_id VARCHAR(80) NOT NULL
);

INSERT INTO users (email, password, lastname, firstname, role_id)
VALUES
("superadmin@admin.fr", "$2y$10$Fhv9XSpyrwy9lyMYvU1joOB74jHg1FwDedPu84UU3.GosX/QNWJLG", "Super", "Admin", 1)
;

CREATE TABLE society (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    picture VARCHAR(255) NOT NULL,
    address VARCHAR(100) NOT NULL,
    cp VARCHAR(5) NOT NULL,
    town VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    twitter VARCHAR(100) NOT NULL,
    facebook VARCHAR(100) NOT NULL,
    instagram VARCHAR(100) NOT NULL
);

INSERT INTO society (name, picture, address, cp, town, mail, phone, twitter, facebook, instagram)
VALUES
("OLYMPIC NANTAIS",
"https://zupimages.net/up/20/52/xa4o.png",
"2 bis Quai François Mitterand",
"44200",
"Nantes",
"contact@olympic-nantais.com",
"99.99.99.99.99",
"https://twitter.com/Olympic-Nantais",
"https://www.facebook.com/Olympic-Nantais",
"https://www.instagram.com/Olympic-Nantais")
;

CREATE TABLE navbar (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(40) NOT NULL,
    link VARCHAR(255) NOT NULL
);

INSERT INTO navbar (title, link)
VALUES
("Tu veux du bon son ?", "/"),
("Tu veux tout savoir ?", "/show/information"),
("Tu veux connaître notre histoire ?", "/show/history"),
("Tu veux nous contacter ?", "/show/contact")
;

CREATE TABLE partner(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    link VARCHAR(255) NULL,
    picture VARCHAR(255) NOT NULL,
    position INT NOT NULL
);

INSERT INTO partner (name, link, picture, position)
VALUES
("Région Pays De La Loire", "http://www.paysdelaloire.fr/", "https://www.zenith-nantesmetropole.com/images/partenaires/nantesmetropole.png", 1),
("Wild Code School", "https://www.wildcodeschool.com/fr-FR", "https://res.cloudinary.com/wildcodeschool/image/upload/c_fill,h_50/v1/static/irjoy97aq0eol8bf6959", 2),
("La Copie Privée", "http://www.copieprivee.org//", "https://getvectorlogo.com/wp-content/uploads/2019/08/la-culture-avec-la-copie-privee-vector-logo.png", 3)
;

CREATE TABLE placement (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    placement VARCHAR(100) NOT NULL
);

INSERT INTO placement (placement)
VALUES
("Placement libre"),
("Placement numéroté"),
("Placement par zones")
;

CREATE TABLE event (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    date_time DATETIME NOT NULL,
    price INT NOT NULL,
    description TEXT NOT NULL,
    picture VARCHAR(255) NOT NULL,
    video VARCHAR(255) NULL,
    link_artist VARCHAR(255) NULL,
    organizer VARCHAR(255) NOT NULL,
    link_organizer VARCHAR(255) NULL,
    producer VARCHAR(255) NULL,
    placement_id VARCHAR(100) NOT NULL,
    reservation1_title VARCHAR(255) NOT NULL,
    reservation1_link VARCHAR(255) NOT NULL,
    reservation2_title VARCHAR(255) NULL,
    reservation2_link VARCHAR(255) NULL
);

CREATE TABLE artist(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE event_artist(
    event_id INT NOT NULL,
    artist_id INT NOT NULL,
    FOREIGN KEY (event_id)
        REFERENCES event(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
    FOREIGN KEY (artist_id)
        REFERENCES artist(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

CREATE TABLE category(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);

CREATE TABLE event_category(
    event_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (event_id)
        REFERENCES event(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
    FOREIGN KEY (category_id)
        REFERENCES category(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

CREATE TABLE answer(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    message TEXT NULL,
    date_time DATETIME NULL
);

CREATE TABLE comment(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_time DATETIME NOT NULL,
    object VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    answer_id INT NULL,
    FOREIGN KEY (answer_id)
        REFERENCES answer(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

INSERT INTO comment (firstname, lastname, email, date_time, object, message)
VALUES
("Robert", "Michu", "rober.michu@gmail.fr", "2019-10-29", "Demande de renseignement", "Bonjour, pouvez me dire quand le spectacle de Johnny arrivera ?"),
("Emmanuel", "Macron", "president@lapresidence.com", "2019-10-28", "Question au ministres", "Bonjour, pouvez me dire quand le spectacle avec Brigitte arrivera ?"),
("Guy", "Lux", "guy.lux@intervilles.fr", "2019-10-30", "Question sur le schimilili", "Bonjour, pouvez me dire quand reviendra le schimililili ?")
;

INSERT INTO event (title, date_time, price, description, picture, video, link_artist, organizer, link_organizer, producer, placement_id, reservation1_title, reservation1_link, reservation2_title, reservation2_link)
VALUES
("Jean-Louis Aubert",
"2070-03-08 21:00:00",
39,
"Jean-Louis Aubert se produit seul en scène avec des hologrammes de lui-même qu’il déclenche, en live ! Ce rendez-vous sera l’occasion de découvrir et partager les chansons du nouvel album, mais aussi ses titres incontournables.",
"https://zenith-nantesmetropole.fnacspectacles.com/static/0/visuel/600/425/JEAN-LOUIS-AUBERT-TOUR_4255485942318709046.jpg",
"https://www.youtube.com/embed/PuFFzmyAzaE",
"https://www.jeanlouisaubert.com/",
"Cheyenne Productions",
"http://www.cheyenne-prod.com/",
"Lagardère Unlimited live Entertainement",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/jean-louis-aubert-billet/idmanif/473737/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/rock-jean-louis-aubert-manshjla-lt.htm"
),
("Hoshi",
"2070-03-15 20:45:00",
34,
"Après une tournée de plus de 100 dates pour présenter son premier album « Il suffit d’y croire », certifié disque de platine, Hoshi revient avec un nouvel album ‘Sommeil Levant’ et une nouvelle tournée dans les Zéniths de France à partir de février ! Le nouvel album d’Hoshi, « Sommeil Levant », sortira le 5 juin prochain !",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/report_hoshi_d%C3%A9cembre_2021_copie.jpg",
"https://youtube.com/embed/DipEiYAyKxY",
"https://www.difymusic.com/hoshi-musique",
"0 Spectacles",
"https://www.ospectacles.fr/",
"Caramba culture live",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/hoshi-billet/idmanif/479669/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/variete-et-chanson-francaises-hoshi-manshhos-lt.htm"
),
("Christophe Mae",
"2070-03-29 21:00:00",
37,
"Christophe Maé enfin de retour ! Depuis plus d’une décennie, le chanteur enchaîne les succès, chacune de ses tournées crée l’événement. Christophe Maé sortira son nouveau single 'Les gens' le 4 septembre, extrait de son nouvel album à paraître à l’automne, et remontera sur scène dans toute la France. Ce prochain show ambitieux et généreux nous réserve de nombreuses surprises !",
"https://www.zenith-nantesmetropole.com/images/ma%C3%A9.jpg",
"https://youtube.com/embed/NQY8EhTX3tA",
"https://www.christophe-mae.fr/",
"0 Spectacles",
"https://www.ospectacles.fr/",
"Décibels Productions",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/christophe-mae-billet/idmanif/474716/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/variete-et-chanson-francaises-christophe-mae-manshmae-lt.htm"
),
("Iam",
"2070-04-05 20:50:00",
45,
"Face à la demande, IAM annonce la suite de son Rap Warrior Tour avec 12 concerts dans les Zénith à travers la France, la Belgique et la Suisse. La formation marseillaise viendra défendre sur scène son nouvel album Yasuke (déjà disponible).",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/IAM_report.jpg",
"https://youtube.com/embed/ONS45hZ4vQM",
"https://www.christophe-mae.fr/",
"0 Spectacles",
"https://www.ospectacles.fr/",
"Live Nation",
3,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/iam-billet/idmanif/482048/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/rap-hip-hop-slam-iam-mannaiam-lt.htm"
),
("Fascination",
"2070-04-19 20:30:30",
49,
"Le plus spectaculaire des shows équestres en Tournée dans toute la France ! 'Fascination' : Quand l’art équestre réunit cascades, tradition, poésie et liberté ! Ce grand spectacle, mêlant émotion et audace vous fera rêver pendant près de deux heures ! 
Pour la première fois, l’homme-orchestre du cheval à la renommée mondiale, Mario Luraschi, se met en scène ! Ce spectacle vient couronner 50 ans de carrière équestre : sur un plateau de 1000m2 avec sa troupe de 15 cavaliers, Mario vous fera voyager à travers le temps, son histoire du cheval, les grandes fresques du cinéma et de la tradition équestre. 
Musique, lumières, costumes, pyrotechnie : un véritable show à la gloire du cheval !",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/visuel_fascination.jpg",
"",
"",
"Az Prod",
"",
"",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/mario-luraschi-billet/idmanif/460020/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/spectacle-equestre-mario-luraschi-manshlur-lt.htm#/calendrier/"
),
("The Avener",
"2070-04-26 21:00:00",
39,
"Le producteur et DJ Français de Pop Electro s’est révélé au grand public avec le tube mondial Fade Out Lines, véritable hymne Electro bluesy intemporel qui figure même dans la playlist de Michelle & Barack Obama. 
Le niçois confirme son talent de producteur en 2015 avec son premier album The Wandering of The Avener, déjà certifié triple platine en France. Ses morceaux irrésistibles mêlant avec aisance Electro et Pop le voient collaborer avec les plus grands artistes, de Bob Dylan à Rodriguez en passant par Lana Del Rey ou Mylène Farmer. Avec le tubesque 'Beautiful' — joué en avant-première sur le toit du Palais des Festivals de Cannes pendant le FIF — il prépare les esprits pour son grand retour avec un nouvel album à paraître début de l'année !",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/the_avener_site_.jpg",
"https://youtube.com/embed/vrYSTFezt5s",
"http://www.theavener.com/",
"0 Spectacles",
"https://www.ospectacles.fr/",
"Miala",
3,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/the-avener-billet/idmanif/480777/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/musique-electronique-the-avener-manshtav-lt.htm"
),
("Gad Elmaleh",
"2070-05-03 21:00:00",
35,
"5 ans après 'Sans tambour' et une tournée internationale avec un spectacle en anglais dans plus de 15 pays, Gad Elmaleh est de retour avec un one-man show inédit: 'D’AILLEURS'.",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/gad.jpg",
"https://youtube.com/embed/ltRGQfXgpWY",
"https://gadelmaleh.com/",
"0 Spectacles",
"https://www.ospectacles.fr/",
"Live Nation",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/gad-elmaleh-billet/idmanif/481722/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/one-man-woman-show-gad-elmaleh-manshgad-lt.htm"
),
("Asaf Avidan & Band",
"2070-05-10 20:45:00",
41,
"Asaf Avidan est la quintessence de l’émotion à l’état brut. Originaire de Jérusalem, ce songwriter hors du commun façonne un imaginaire puissant, propulsé avec délicatesse par une voix rocailleuse et singulière. 
De nouvelles influences que l’on retrouve dans 'Earth Odyssey' et 'Lost Horse', déjà disponibles sur les plateformes. 
Fort d’un nouvel album prévu en septembre, Asaf Avidan annonce l’Anagnorisis Tour avec son nouveau groupe.",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/ASAF_.jpg",
"https://youtube.com/embed/NyS0OUhJKQM",
"https://www.asafavidanmusic.com/",
"K Production",
"",
"Gérard Drouot Productions",
3,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/asaf-avidan-band-billet/idmanif/492186/idtier/5689485",
"",
""
),
("Muriel Robin",
"2070-05-17 21:00:00",
36,
"Depuis plus de 30 ans nous vivons avec ses sketchs. L’addition, Le noir, La réunion de chantier et tant d’autres… Ils ont accompagné nos vies, marqué notre quotidien, ils font partie de notre mémoire, de notre histoire collective, de notre jeunesse. 
Les répliques sont cultes, les expressions incontournables, indissociables d’une époque qui continue de vivre en nous. Qui n’a pas rêvé de remonter le temps ? De retrouver ces instants qui nous ont rendu si heureux ? 
Muriel Robin nous fait ce cadeau fou… l’espace de quelques soirs elle reprend ses sketchs cultes ! Le passé et le présent vont danser ensemble en une grande fête de la joie pour célébrer notre si belle histoire commune. Et Pof !",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/muriel_robin.jpg",
"",
"https://www.murielrobin-etpof.com/fr",
"0 Spectacles",
"https://www.ospectacles.fr/",
"Ts3",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/muriel-robin-billet/idmanif/465370/idtier/5689485",
"",
""
),
("Patric Bruel",
"2070-05-31 21:00:00",
55,
"Nouvel album, nouveau show et toujours la touche Bruel : La tournée Ce soir on sort… de Patrick Bruel vous fait voyager ici et là entre succès mythiques et audaces toujours inattendues. 
Des millions d’albums vendus, des tournées gigantesques et des concerts qui restent gravés dans les mémoires, retrouvez Patrick Bruel dans les plus grandes salles de France, Suisse, Belgique. 
Avec 1 million de spectateurs et 120 dates programmées, l’artiste jouera les prolongations au printemps ! L’aventure continue…! Retrouvez dès à présent l’édition spéciale de l’album 'Ce soir on sort…' avec 8 titres bonus, 3 inédits dont un duo avec Boulevard Des Airs",
"https://www.zenith-nantesmetropole.com/images/stories/manifestations/bruel_2020.jpg",
"https://youtube.com/embed/5HxJNl-CfTc",
"https://www.patrickbruel.com/",
"Cheyenne Productions",
"http://www.cheyenne-prod.com/",
"14 productions",
2,
"Ticketmaster",
"https://www.ticketmaster.fr/fr/manifestation/patrick-bruel-billet/idmanif/481733/idtier/5689485",
"Fnac",
"https://zenith-nantesmetropole.fnacspectacles.com/place-spectacle/ticket-evenement/variete-et-chanson-francaises-patrick-bruel-manshpat-lt.htm"
)
;

INSERT INTO category (category)
VALUES
("Cirque"),
("Electro"),
("Humour"),
("Metal"),
("Pop / Rock / Blues"),
("Rap / hip Hop"),
("Variété française"),
("variété internationale")
;

INSERT INTO event_category (event_id, category_id)
VALUES
("1", "5"),
("2", "7"),
("3", "7"),
("4", "6"),
("5", "1"),
("6", "8"),
("7", "3"),
("8", "8"),
("9", "3"),
("10", "7")
;
