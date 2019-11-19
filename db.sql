DROP DATABASE IF EXISTS olympic_db;
CREATE DATABASE olympic_db;
USE olympic_db;

CREATE TABLE role(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255) NOT NULL
);

INSERT INTO role (role)
VALUES
('SuperAdmin'),
('Admin'),
('User')
;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(80) NOT NULL,
    lastname VARCHAR(80) NOT NULL,
    firstname VARCHAR(80) NOT NULL,
    role_id VARCHAR(80) NOT NULL
);

INSERT INTO users (email, password, lastname, firstname, role_id)
VALUES
('admin@admin.fr', '$2y$10$qiEdkGpA.Nr06pFXCv3p1.Xwy1WNY1GIweZL/qv1VTD03HkEe9.2u', 'Super', 'Admin', 1),
('robert@mail.fr', '$2y$10$I3WfpAWd9VkN8eNeeuYCDe8McIbAqbHwBSz0tY5vthSal6Sgr8h1a', 'Michu', 'Robert', 2),
('user@mail.fr', '$2y$10$Oh8yvSQ7zu3pwGzpe0rPzOfZR5axZSH6BZd6lboRSMVImhFCj8Cxq', 'Hue', 'Brigitte', 3)
;

CREATE TABLE event(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    date_time DATETIME NOT NULL,
    price INT NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    video VARCHAR(255) NULL,
    link VARCHAR(255) NULL
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
('Michu', 'Robert', 'robert.michu@gmail.com', '2019-10-29', 'Demande de renseignement', 'Bonjour, pouvez me dire quand le spectacle de Johnny arrivera ?'),
('Emmanuel', 'Macron', 'president@republique.fr', '2019-10-28', 'Question au ministres', 'Bonjour, pouvez me dire quand le spectacle avec Brigitte arrivera ?'),
('Guy', 'Lux', 'schalala@intervilles.fr', '2019-10-30', 'Question sur le schimilili', 'Bonjour, pouvez me dire quand reviendra le schimililili ?')
;

CREATE TABLE partner(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    link VARCHAR(255) NULL
);

INSERT INTO event (title, date_time, price, description, image, video, link)
VALUES
('Soprano', '2019-10-18', 25,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a quam congue, pretium velit nec, egestas lacus. Quisque sagittis odio in nisi facilisis, ut pellentesque felis egestas. Praesent pharetra eros orci, at feugiat augue finibus eu. Suspendisse tristique sem nec nibh dapibus faucibus. Ut at sollicitudin turpis. Mauris sagittis ante sed aliquam efficitur. Vivamus quam arcu, tempus semper tortor malesuada, pulvinar molestie mauris. Fusce in vestibulum ex. Cras vel justo eget dui tempus ullamcorper.
Morbi et laoreet massa, vel luctus lacus. Donec facilisis leo ex, nec maximus velit porttitor eget. Cras bibendum tempor est, viverra efficitur urna tincidunt ac. Etiam eget velit vitae neque venenatis tempor. Curabitur eu massa velit. Quisque a porta velit. Nullam feugiat commodo efficitur. Proin ullamcorper, mauris ut pulvinar imperdiet, lorem est ullamcorper eros',
'https://www.zenith-nantesmetropole.com/media/ic/resize/load.php?src=/images/stories/manifestations/soprano_phoenix_tour.jpg&width=240&height=315&crop=1',
'',
''
),
('M', '2019-11-15', 20,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a quam congue, pretium velit nec, egestas lacus. Quisque sagittis odio in nisi facilisis, ut pellentesque felis egestas. Praesent pharetra eros orci, at feugiat augue finibus eu. Suspendisse tristique sem nec nibh dapibus faucibus. Ut at sollicitudin turpis. Mauris sagittis ante sed aliquam efficitur. Vivamus quam arcu, tempus semper tortor malesuada, pulvinar molestie mauris. Fusce in vestibulum ex. Cras vel justo eget dui tempus ullamcorper.
Morbi et laoreet massa, vel luctus lacus. Donec facilisis leo ex, nec maximus velit porttitor eget. Cras bibendum tempor est, viverra efficitur urna tincidunt ac. Etiam eget velit vitae neque venenatis tempor. Curabitur eu massa velit. Quisque a porta velit. Nullam feugiat commodo efficitur. Proin ullamcorper, mauris ut pulvinar imperdiet, lorem est ullamcorper eros',
'https://www.zenith-nantesmetropole.com/media/ic/resize/load.php?src=/images/stories/manifestations/m_novembre.jpg&width=240&height=315&crop=1',
'https://youtu.be/CfCxItPlidc',
'https://labo-m.net/'
),
('Angèle', '2019-11-29', 30,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a quam congue, pretium velit nec, egestas lacus. Quisque sagittis odio in nisi facilisis, ut pellentesque felis egestas. Praesent pharetra eros orci, at feugiat augue finibus eu. Suspendisse tristique sem nec nibh dapibus faucibus. Ut at sollicitudin turpis. Mauris sagittis ante sed aliquam efficitur. Vivamus quam arcu, tempus semper tortor malesuada, pulvinar molestie mauris. Fusce in vestibulum ex. Cras vel justo eget dui tempus ullamcorper.
Morbi et laoreet massa, vel luctus lacus. Donec facilisis leo ex, nec maximus velit porttitor eget. Cras bibendum tempor est, viverra efficitur urna tincidunt ac. Etiam eget velit vitae neque venenatis tempor. Curabitur eu massa velit. Quisque a porta velit. Nullam feugiat commodo efficitur. Proin ullamcorper, mauris ut pulvinar imperdiet, lorem est ullamcorper eros',
'https://www.zenith-nantesmetropole.com/media/ic/resize/load.php?src=/images/stories/manifestations/angele.jpg&width=240&height=315&crop=1',
'https://youtu.be/cA46ZNjrzeY',
''
),
('Void Shelter', '2019-11-29', 130,
'Un abri. Votre esprit. À l intérieur un côté ordonné et rassurant, l autre brumeux et tourmenté. Entouré de vide symbolisant l inconnu et l inconscient.
Void Shelter crée son univers mélancolique en apportant au rock alternatif des compositions viscérales, inspirées d expériences et de récits, aux textes surréalistes. Le groupe emporte le spectateur dans un rock ambiant, élégant et tortueux en misant sur le décalage de ses inspirations.',
'https://zupimages.net/up/19/46/y77c.jpg',
'https://www.youtube.com/watch?v=_fZ5wbzrft0',
''
),
('Claudio Capéo', '2019-11-29', 12,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a quam congue, pretium velit nec, egestas lacus. Quisque sagittis odio in nisi facilisis, ut pellentesque felis egestas. Praesent pharetra eros orci, at feugiat augue finibus eu. Suspendisse tristique sem nec nibh dapibus faucibus. Ut at sollicitudin turpis. Mauris sagittis ante sed aliquam efficitur. Vivamus quam arcu, tempus semper tortor malesuada, pulvinar molestie mauris. Fusce in vestibulum ex. Cras vel justo eget dui tempus ullamcorper.
Morbi et laoreet massa, vel luctus lacus. Donec facilisis leo ex, nec maximus velit porttitor eget. Cras bibendum tempor est, viverra efficitur urna tincidunt ac. Etiam eget velit vitae neque venenatis tempor. Curabitur eu massa velit. Quisque a porta velit. Nullam feugiat commodo efficitur. Proin ullamcorper, mauris ut pulvinar imperdiet, lorem est ullamcorper eros',
'https://www.zenith-nantesmetropole.com/media/ic/resize/load.php?src=/images/stories/manifestations/capeo2.jpg&width=240&height=315&crop=1',
'https://youtu.be/cA46ZNjrzeY',
''
),
('Trois Cafés Gourmands', '2019-11-29', 30,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a quam congue, pretium velit nec, egestas lacus. Quisque sagittis odio in nisi facilisis, ut pellentesque felis egestas. Praesent pharetra eros orci, at feugiat augue finibus eu. Suspendisse tristique sem nec nibh dapibus faucibus. Ut at sollicitudin turpis. Mauris sagittis ante sed aliquam efficitur. Vivamus quam arcu, tempus semper tortor malesuada, pulvinar molestie mauris. Fusce in vestibulum ex. Cras vel justo eget dui tempus ullamcorper.
Morbi et laoreet massa, vel luctus lacus. Donec facilisis leo ex, nec maximus velit porttitor eget. Cras bibendum tempor est, viverra efficitur urna tincidunt ac. Etiam eget velit vitae neque venenatis tempor. Curabitur eu massa velit. Quisque a porta velit. Nullam feugiat commodo efficitur. Proin ullamcorper, mauris ut pulvinar imperdiet, lorem est ullamcorper eros',
'https://www.zenith-nantesmetropole.com/media/ic/resize/load.php?src=/images/stories/manifestations/3_cafes_gourmands_.jpg&width=240&height=315&crop=1',
'https://youtu.be/cA46ZNjrzeY',
''
)
;

INSERT INTO category (category)
VALUES
('Rock'),
('Pop'),
('Jazz'),
('Metal'),
('Rap')
;

INSERT INTO partner (name, link)
VALUES
('Les Pays De La Loire', 'http://www.paysdelaloire.fr/'),
('Stereolux', 'https://www.stereolux.org/')
;

INSERT INTO event_category (event_id, category_id)
VALUES
('4', '1')
;

