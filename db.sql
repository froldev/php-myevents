DROP DATABASE IF EXISTS olympic_db;
CREATE DATABASE olympic_db;
USE olympic_db;

CREATE TABLE `users`(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(80) NOT NULL
);

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
    date_time DATETIME NULL,
    email VARCHAR(255) NULL
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

CREATE TABLE partner(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    link VARCHAR(255) NULL
);

INSERT INTO event (title, date_time, price, description, image, video, link)
VALUES
('Kassav', '2019-10-18', 25,
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a quam congue, pretium velit nec, egestas lacus. Quisque sagittis odio in nisi facilisis, ut pellentesque felis egestas. Praesent pharetra eros orci, at feugiat augue finibus eu. Suspendisse tristique sem nec nibh dapibus faucibus. Ut at sollicitudin turpis. Mauris sagittis ante sed aliquam efficitur. Vivamus quam arcu, tempus semper tortor malesuada, pulvinar molestie mauris. Fusce in vestibulum ex. Cras vel justo eget dui tempus ullamcorper.
Morbi et laoreet massa, vel luctus lacus. Donec facilisis leo ex, nec maximus velit porttitor eget. Cras bibendum tempor est, viverra efficitur urna tincidunt ac. Etiam eget velit vitae neque venenatis tempor. Curabitur eu massa velit. Quisque a porta velit. Nullam feugiat commodo efficitur. Proin ullamcorper, mauris ut pulvinar imperdiet, lorem est ullamcorper eros',
'https://www.zenith-nantesmetropole.com/media/ic/resize/load.php?src=/images/stories/manifestations/kassav.jpg&width=240&height=315&crop=1',
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
)
;

INSERT INTO comment (firstname, lastname, email, date_time, object,message)
VALUES
('Robert', 'Michu', 'robert.michu@gmail.com', '2019-10-29', 'Demande de renseignement', 'Bonjour, pouvez me dire quand le spectacle de Johnny arrivera ?'),
('Macron', 'Emmanuel', 'president@repubmlique.fr', '2019-10-28', 'Question au ministres', 'Bonjour, pouvez me dire quand le spectacle avec Brigitte arrivera ?')
;

INSERT INTO category (category)
VALUES
('Rock'),
('Pop')
;

INSERT INTO partner (name, link)
VALUES
('Les Pays De La Loire', 'http://www.paysdelaloire.fr/'),
('Stereolux', 'https://www.stereolux.org/')
;
