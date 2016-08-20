CREATE TABLE saison (
  `id`        INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(100)    NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;
INSERT INTO  saison (name) VALUES ('District 6231 - lasst die Spiele beginnen');

CREATE TABLE mitgliederportrait_frage (
  id            INT(4) UNSIGNED AUTO_INCREMENT,
  frage         VARCHAR(100) NOT NULL,
  fk_saison INT(4) UNSIGNED,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_saison)
  REFERENCES saison (id)
    ON UPDATE CASCADE
    ON DELETE SET NULL
)
  ENGINE = InnoDB;
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUES ('Din Kämpfername', 1);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUES ('Was wördsch du nie opfere', 1);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUES ('I welem Distrikt wohnsch du', 1);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUES ('Was esch dini Gheimwaffe', 1);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUES ('För was wörsch hongere', 1);

CREATE TABLE mitgliederportrait_antwort (
  id            INT(4) UNSIGNED AUTO_INCREMENT,
  antwort         VARCHAR(255) NOT NULL,
  fk_frage INT(4) UNSIGNED,
  fk_mitglied INT(4) UNSIGNED,
  PRIMARY KEY (id),
  UNIQUE KEY (fk_mitglied, fk_frage),
  FOREIGN KEY (fk_frage)
  REFERENCES mitgliederportrait_frage (id)
    ON UPDATE CASCADE
    ON DELETE SET NULL,
  FOREIGN KEY (fk_mitglied)
  REFERENCES mitglied (id)
    ON UPDATE CASCADE
    ON DELETE SET NULL
)
  ENGINE = InnoDB;
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Babett Pugnatrix Everdeen', 1, 38);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('mis Bett... (ond mini Allerliebschte)', 2, 38);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Im Distrikt 6231 (s'' sonnigschte wos ged!)', 3, 38);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('d Wempere lo klempere (falls das nüd nötzt hemmer jo da Johr Pfiil ond Boge debi...)', 4, 38);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('ech hongere gärn bes am Obe, wenni weiss ases denne e 6-Gänger ged!', 5, 38);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Orsula Hestia von Panem', 1, 25);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Mini Kämpfergschpändli', 2, 25);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Nr. 6207 Sämpisee Wescht', 3, 25);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('De Bleck vo minne grosse Ouge lod di grad lo erblende.', 4, 25);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Nüd, ech esse vel z''gärn.', 5, 25);

CREATE TABLE fototermin (
  id            INT(4) UNSIGNED AUTO_INCREMENT,
  termin        VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB;
INSERT INTO fototermin (termin) VALUES ('Friitig, 26. August 2016 ab 19.00 Uhr');
INSERT INTO fototermin (termin) VALUES ('Sonntig, 28. August 2016 ab 16.00 Uhr');
INSERT INTO fototermin (termin) VALUES ('Mettwoch, 31. August 2016 ab 19.00 Uhr');
INSERT INTO fototermin (termin) VALUES ('Friitig, 2. September 2016 ab 19.00 Uhr (Reservedatom)');
INSERT INTO fototermin (termin) VALUES ('Cha leider a kem Datom');

CREATE TABLE fototermin_mitglied (
  id            INT(4) UNSIGNED AUTO_INCREMENT,
  fk_termin INT(4) UNSIGNED,
  fk_mitglied INT(4) UNSIGNED,
  PRIMARY KEY (id),
  UNIQUE KEY (fk_mitglied, fk_termin),
  FOREIGN KEY (fk_termin)
  REFERENCES fototermin (id)
    ON UPDATE CASCADE
    ON DELETE SET NULL,
  FOREIGN KEY (fk_mitglied)
  REFERENCES mitglied (id)
    ON UPDATE CASCADE
    ON DELETE SET NULL
)
  ENGINE = InnoDB;
INSERT INTO fototermin_mitglied (fk_termin, fk_mitglied) VALUES (1, 38);
INSERT INTO fototermin_mitglied (fk_termin, fk_mitglied) VALUES (1, 25);

# Neumitglieder
INSERT INTO mitglied (vorname, nachname, eintritt) VALUES ('Eliane', 'Arnold', '2016/2017');
INSERT INTO mitglied (vorname, nachname, eintritt) VALUES ('Jonas', 'Galliker', '2016/2017');
INSERT INTO mitglied (vorname, nachname, eintritt) VALUES ('Samuel', 'Galliker', '2016/2017');
INSERT INTO mitglied (vorname, nachname, eintritt) VALUES ('Ronny', 'Koch', '2016/2017');
INSERT INTO mitglied (vorname, nachname, eintritt) VALUES ('Nicole', 'Schnüriger', '2016/2017');