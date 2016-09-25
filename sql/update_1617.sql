  CREATE TABLE status (
    id   INT(4) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY name (name)
  );
  INSERT INTO status (name) VALUES ('Aktiv');
  INSERT INTO status (name) VALUES ('Neumitglied');
  INSERT INTO status (name) VALUES ('Dispens');
  INSERT INTO status (name) VALUES ('Ausgetreten');
  ALTER TABLE mitglied ADD fk_status INT(4) UNSIGNED DEFAULT 1;

##### Nach OV ######

UPDATE vorstand SET fk_mitglied=46 WHERE reihenfolge=4; # Kassier Sabi

UPDATE mitglied SET fk_status=4 WHERE id IN (6, 19, 20, 26, 32); # Austritte

UPDATE mitglied SET fk_status=3  WHERE id=48; # Denis
UPDATE mitglied SET fk_status=3  WHERE id=50; # Prisi

UPDATE mitglied SET fk_status=2, fk_instrument=3 WHERE id=51; # Eliane
UPDATE mitglied SET fk_status=2, fk_instrument=2 WHERE id=52; # Joni
UPDATE mitglied SET fk_status=2, fk_instrument=2 WHERE id=53; # Sämi
UPDATE mitglied SET fk_status=2, fk_instrument=7 WHERE id=54; # Ronny
UPDATE mitglied SET fk_status=2, fk_instrument=3 WHERE id=55; # Nicole

INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Friesör', 1, 8);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('mini wisse Läderhändsche', 2, 8);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('6208', 3, 8);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Villiger Export', 4, 8);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('ha fasch ke ziit zom hongere', 5, 8);

INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('MvB', 1, 1);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('', 2, 1);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('6210 §31c', 3, 1);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Die esch so gheim, die könn ned emou ech', 4, 1);
INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ('Ha bes jetzt no nüd gfonde', 5, 1);

### TODO: Auftritte hinzufügen