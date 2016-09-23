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

UPDATE mitglied SET fk_status=2, fk_instrument=1 WHERE id=51; # Eliane
UPDATE mitglied SET fk_status=2, fk_instrument=1 WHERE id=52; # Joni
UPDATE mitglied SET fk_status=2, fk_instrument=1 WHERE id=53; # Sämi
UPDATE mitglied SET fk_status=2, fk_instrument=1 WHERE id=54; # Ronny
UPDATE mitglied SET fk_status=2, fk_instrument=1 WHERE id=55; # Nicole

### TODO: Auftritte hinzufügen