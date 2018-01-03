ALTER TABLE saison ADD jahr VARCHAR(7) DEFAULT NULL;
UPDATE saison SET jahr='2016/17' WHERE id=1;
UPDATE saison SET jahr='2017/18' WHERE id=2;
INSERT INTO saison (name, jahr) VALUES ('Einfach aber göttlich', '2015/16');

ALTER TABLE galerie ADD fk_saison INT(4) UNSIGNED NOT NULL AUTO_INCREMENT NOT NULL DEFAULT 2;
UPDATE galerie SET fk_saison=3 WHERE datum BETWEEN '2015-09-15' AND '2016-09-14';
UPDATE galerie SET fk_saison=1 WHERE datum BETWEEN '2016-09-15' AND '2017-09-14';
UPDATE galerie SET fk_saison=2 WHERE datum BETWEEN '2017-09-15' AND '2018-09-14';