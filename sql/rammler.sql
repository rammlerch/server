CREATE TABLE IF NOT EXISTS `agenda` (
  `id`        INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start`     DATE            NOT NULL,
  `ende`      DATE                     DEFAULT NULL,
  `name`      VARCHAR(100)    NOT NULL,
  `ort`       VARCHAR(100)    NOT NULL,
  `auftritt`  VARCHAR(100)             DEFAULT NULL,
  `link`      VARCHAR(255)             DEFAULT NULL,
  `highlight` TINYINT(1)      NOT NULL DEFAULT '0',
  `ordnung`   INT(4) UNSIGNED NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

--
-- Daten für Tabelle `agenda`
--

INSERT INTO `agenda` (`start`, `ende`, `name`, `ort`, `auftritt`, `link`, `highlight`, `ordnung`) VALUES
  ('2015-09-05', '2015-09-06', 'Herbstreise', '???', '', '', 0, 5),
  ('2015-09-25', NULL, 'OV', 'Schlierbach', '', '', 0, 5),
  ('2015-10-07', NULL, '1. Probe', 'Schlierbach', '20:15', '', 0, 5),
  ('2015-11-21', NULL, 'Crazyparty', 'Kulmerau', '', '', 0, 5),
  ('2015-11-28', '2015-11-29', 'Probeweekend', 'Schlierbach', '', '', 0, 5),
  ('2016-01-02', NULL, 'Fasnachtseröffnung', 'Schlierbach', '', '', 0, 5),
  ('2016-01-09', NULL, 'Joggeler-Nacht', 'Neudorf', '', '', 0, 5),
  ('2016-01-16', NULL, 'Tereter Nächt', 'St. Erhard', '', '', 0, 5),
  ('2016-01-22', '2016-01-24', 'Hahnenkamm-Rennen', 'Kitzbühel', '', '', 0, 5),
  ('2016-01-30', NULL, 'Kinderfasnacht', 'MZH Schlierbach', '', '', 1, 5),
  ('2016-01-30', NULL, 'aBARtig', 'Triengen', '', '', 0, 7),
  ('2016-02-03', NULL, 'Rammlerball', 'MZH Schlierbach', '20:00', '', 1, 5),
  ('2016-02-04', NULL, 'Schmudo Fäscht', 'Winikon', '', '', 0, 5),
  ('2016-02-05', NULL, 'Narrenball', 'Schötz', '', '', 0, 5),
  ('2016-02-06', NULL, 'Fläcke Fasnacht', 'Beromünster', '', '', 0, 3),
  ('2016-02-06', NULL, 'Zunftball', 'Schlierbach', '', '', 0, 5),
  ('2016-02-07', NULL, 'Rammlerstöbli', 'Oberdorf Schlierbach', '02:00', '', 1, 5),
  ('2016-02-07', NULL, 'Umzug', 'Schlierbach', '', '', 0, 7),
  ('2016-02-08', NULL, 'Easyball', 'Geuensee', '', '', 0, 5),
  ('2016-02-09', NULL, 'Umzug / Uslompete', 'Triengen', '', '', 0, 5);


CREATE TABLE instrument (
  id   INT(4) UNSIGNED AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
);

INSERT INTO instrument (name) VALUES
  ('Tambourmajor'),
  ('Trompete'),
  ('Posaune'),
  ('Euphonium'),
  ('Bass'),
  ('Schlagzeug'),
  ('Pauke'),
  ('Glocke');

CREATE TABLE mitglied (
  id            INT(4) UNSIGNED AUTO_INCREMENT,
  nachname      VARCHAR(30) NOT NULL,
  vorname       VARCHAR(30) NOT NULL,
  spitzname     VARCHAR(100)    DEFAULT NULL,
  eintritt      VARCHAR(40),
  fk_instrument INT(4) UNSIGNED,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_instrument)
  REFERENCES instrument (id)
    ON UPDATE CASCADE
    ON DELETE SET NULL
)
  ENGINE = InnoDB;

INSERT INTO mitglied (nachname, vorname, eintritt, spitzname, fk_instrument) VALUES
  ('Ackermann', 'Jenni', '2011/2012', 'Jenny-Jenny-Baby', '8'),
  ('Aeberhard', 'Andreas', '2013/2014', 'Rolf / Ätti', '6'),
  ('Arnold', 'Marcel', '2003/2004', 'MvB', '4'),
  ('Arnold', 'Patrick', '2011/2012', 'PP', '3'),
  ('Arnold', 'Peter', '1988/1989', 'Dr. Harzer Pesche', '2'),
  ('Arnold', 'Raphael', '2009/2010', 'Gadaffi', '7'),
  ('Diener', 'Reto', '2010/2011', '', '2'),
  ('Fries', 'Fabian', '2009/2010', 'Friesör / Happy', '2'),
  ('Galliker', 'Deborah', '2009/2010', 'Debby', '3'),
  ('Galliker', 'Jolanda', '2011/2012', 'Joli', '3'),
  ('Galliker', 'Linda', '2012/2013', 'Perle / Lindi', '3'),
  ('Galliker', 'Marco', '2015/2016', '', '2'),
  ('Galliker', 'Reto', '2014/2015', 'Dödi', '5'),
  ('Galliker', 'Simon', '2009/2010', 'Simi', '1'),
  ('Gilli', 'Matthias', '2014/2015', 'Mätthu', '7'),
  ('Häfliger', 'Kevin', '2011/2012', 'Grasdeerichef / Lönzu', '6'),
  ('Hecht', 'Raphael', '2006/2007', 'Raphi', '5'),
  ('Hofer', 'Micha', '2010/2011', 'Polo / Hofermers / Sasha', '2'),
  ('Hummel', 'Raphael', '2008/2009', 'Raphi', '3'),
  ('Hunziker', 'Carol', '2014/2015', '', '3'),
  ('Kost', 'Samuel', '2015/2016', 'Sämi', '4'),
  ('Kronenberg', 'Carina', '2015/2016', 'Care', '3'),
  ('Küng', 'Fabian', '2015/2016', 'Fäbu', '2'),
  ('Lötscher', 'Andrea', '2014/2015', 'Andi', '2'),
  ('Lötscher', 'Ursula', '2013/2014', 'Ursi', '2'),
  ('Meier', 'Livia', '2012/2013', 'Liiiv', '2'),
  ('Meier', 'Marcel', '2005/2006', 'Mäsi / Mäserich / Sexy Mäsi', '7'),
  ('Meier', 'Peter', '2010/2011, 2013/2014', 'Pedro', '3'),
  ('Meier', 'Tanja', '2015/2016', 'Meierli', '2'),
  ('Moser', 'Anina', '2010/2011', 'Dorsch (h)ani', '2'),
  ('Muff', 'Daniel', '2013/2014', 'Dänu / Boumi', '4'),
  ('Oehen', 'Rahel', '2011/2012', 'Trudy / Frischit', '3'),
  ('Ruoss', 'Romana', '2009/2010', 'Romy / Römsle / Römsi', '2'),
  ('Schmidli', 'Daniel', '2015/2016', '', '3'),
  ('Schmidlin', 'Adrian', '2005/2006', 'Adi gwinnt / wenn eine spinnt ischs de Adi Mint', '7'),
  ('Stalder', 'Nicole', '2007/2008', 'Niizzi(Mizmiz) / Niizleren / Mauzi / Chräbeli', '2'),
  ('Thürig', 'Flavio', '2002/2003', 'F.T. / Flävu', '5'),
  ('Troxler', 'Barbara', '2012/2013', 'Barbarbabapa / Babra / Barabara', '2'),
  ('Troxler', 'Marcel', '2012/2013', 'Örbu / Mäsi / Troxi / Tröxu', '2'),
  ('Troxler', 'Petra', '2012/2013', 'Zemmetstärndli / Petu / Duracell-Häsli', '3'),
  ('Troxler', 'Pirmin', '2002/2003', 'PJT / Göuichöbu / Pime', '2'),
  ('Troxler', 'Roland', '2008/2009', 'Roli / PalettRoli', '4'),
  ('Troxler', 'Sabrina', '2012/2013', 'Sabi / Mailänderli', '8'),
  ('Troxler', 'Seraina', '2015/2016', 'Sere / Selle', '6'),
  ('Troxler', 'Sarah', '2009/2010, 2012/2013', 'Säru-Bäri', '4'),
  ('Weber', 'Andreas', '2015/2016', 'Resu / Andi', '5'),
  ('Weber', 'Daniel', '2009/2010', 'Dänu / Wäber 1', '2'),
  ('Weber', 'Denis', '2015/2016', 'WD 40', '3'),
  ('Weber', 'Nico', '2010/2011', 'Wäber 2', '3'),
  ('Zwimpfer', 'Priska', '2013/2014', 'Priskula / Prisi / Priseler', '2');

CREATE TABLE vorstand (
  id          INT(4) UNSIGNED AUTO_INCREMENT,
  funktion    VARCHAR(30) NOT NULL,
  adresse     VARCHAR(255)    DEFAULT NULL,
  telefon     VARCHAR(12)     DEFAULT NULL,
  email       VARCHAR(255)    DEFAULT NULL,
  reihenfolge INT(4)          DEFAULT 99,
  fk_mitglied INT(4) UNSIGNED,
  PRIMARY KEY (id),
  UNIQUE KEY (funktion),
  FOREIGN KEY (fk_mitglied)
  REFERENCES mitglied (id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)
  ENGINE = InnoDB;

INSERT INTO vorstand (funktion, adresse, telefon, email, fk_mitglied, reihenfolge) VALUES
  ('Präsident', 'Schützenstrasse 6<br />6234 Triengen', '+41792258837', 'praesident@rammler.ch', 42, 1),
  ('Tambourmajor', 'Weierbach<br />6231 Schlierbach', '+41793996091', 'tambi@rammler.ch', 14, 2);
INSERT INTO vorstand (funktion, email, fk_mitglied, reihenfolge) VALUES
  ('Aktuarin', 'aktuar@rammler.ch', 36, 3),
  ('Kassier', 'kassier@rammler.ch', 6, 4),
  ('Materialwart', 'materialwart@rammler.ch', 7, 5);

CREATE TABLE umfrage (
  id    INT(4) UNSIGNED AUTO_INCREMENT,
  titel VARCHAR(50) NOT NULL,
  start TIMESTAMP,
  ende  TIMESTAMP,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB;

INSERT INTO umfrage (titel, start, ende) VALUES
  ('Rammler der Woche 1', '2016-01-06 08:00:00', '2016-01-08 18:00:00'),
  ('Rammler der Woche 2', '2016-01-13 08:00:00', '2016-01-15 18:00:00'),
  ('Rammler der Woche 3', '2016-01-20 08:00:00', '2016-01-22 18:00:00'),
  ('Rammler der Woche 4', '2016-01-27 08:00:00', '2016-01-29 18:00:00'),
  ('Rammler der Woche 5', '2016-02-02 08:00:00', '2016-02-03 17:00:00');

CREATE TABLE umfrage_eintrag (
  id         INT(4) UNSIGNED AUTO_INCREMENT,
  text       VARCHAR(255)    DEFAULT NULL,
  foreign_id INT(4) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB;

CREATE TABLE umfrage_stimme (
  id         INT(4) UNSIGNED AUTO_INCREMENT,
  ip         VARCHAR(20),
  zeit       TIMESTAMP       DEFAULT NOW(),
  fk_eintrag INT(4) UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_eintrag)
  REFERENCES umfrage_eintrag (id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)
  ENGINE = InnoDB;

CREATE TABLE umfrage_nomination (
  id          INT(4) UNSIGNED AUTO_INCREMENT,
  text        VARCHAR(255)    NOT NULL,
  datum       TIMESTAMP       DEFAULT NOW(),
  ip          VARCHAR(20),
  fk_umfrage  INT(4) UNSIGNED NOT NULL,
  fk_mitglied INT(4) UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_umfrage)
  REFERENCES umfrage (id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  FOREIGN KEY (fk_mitglied)
  REFERENCES mitglied (id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)
  ENGINE = InnoDB;


CREATE TABLE umfrage_nomination_zeit (
  id         INT(4) UNSIGNED AUTO_INCREMENT,
  start      TIMESTAMP,
  ende       TIMESTAMP,
  fk_umfrage INT(4) UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_umfrage)
  REFERENCES umfrage (id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)
  ENGINE = InnoDB;


INSERT INTO umfrage_nomination_zeit (start, ende, fk_umfrage) VALUES
  ('2016-01-10 08:00:00', '2016-01-12 18:00:00', 2),
  ('2016-01-17 08:00:00', '2016-01-19 18:00:00', 3),
  ('2016-01-24 08:00:00', '2016-01-26 18:00:00', 4),
  ('2016-01-31 08:00:00', '2016-02-01 18:00:00', 5);