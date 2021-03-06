ALTER TABLE saison ADD jahr VARCHAR(7) DEFAULT NULL;
UPDATE saison SET jahr='2016/17' WHERE id=1;
UPDATE saison SET jahr='2017/18' WHERE id=2;
INSERT INTO saison (name, jahr) VALUES ('Einfach aber göttlich', '2015/16');

ALTER TABLE galerie ADD fk_saison INT(4) UNSIGNED NOT NULL DEFAULT '2';
UPDATE galerie SET fk_saison=3 WHERE datum BETWEEN '2015-09-15' AND '2016-09-14';
UPDATE galerie SET fk_saison=1 WHERE datum BETWEEN '2016-09-15' AND '2017-09-14';
UPDATE galerie SET fk_saison=2 WHERE datum BETWEEN '2017-09-15' AND '2018-09-14';


INSERT INTO galerie (name, ort, datum, fk_saison) VALUES ('OV', 'Schlierbach', '2017-09-23', 2);
INSERT INTO galerie (name, ort, datum, fk_saison) VALUES ('Grunzerparty', 'Ebersecken', '2017-11-25', 2);
INSERT INTO galerie (name, ort, datum, fk_saison) VALUES ('Probeweekend', 'Schlierbach', '2017-12-01', 2);
INSERT INTO galerie (name, ort, datum, fk_saison) VALUES ('Fasnachtseröffnung', 'Schlierbach', '2018-01-06', 2);

INSERT INTO bild (name, fk_galerie) VALUES ('image001.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image002.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image003.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image004.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image005.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image006.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image007.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image008.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image009.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image010.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image011.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image012.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image013.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image014.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image015.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image016.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image017.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image018.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image019.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image020.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image021.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image022.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image023.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image024.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image025.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image026.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image027.jpg', 66);
INSERT INTO bild (name, fk_galerie) VALUES ('image001.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image002.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image003.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image004.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image005.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image006.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image007.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image008.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image009.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image010.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image011.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image012.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image013.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image014.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image015.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image016.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image017.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image018.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('image019.jpg', 67);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8220', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8221', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8222', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8223', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8224', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8225', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8227', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8232', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8236', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8241', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8242', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8243', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8245', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8247', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8248', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8249', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8251', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8252', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8253', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8254', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8256', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8257', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8258', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8259', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8260', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8261', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8263', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8267', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8271', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8272', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8273', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8274', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8276', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8278', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8279', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8280', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8281', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8282', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8284', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8286', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8289', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8290', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8293', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8294', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8296', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8297', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8304', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8305', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8306', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8307', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8308', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8310', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8311', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8315', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8316', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8317', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8319', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8320', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8321', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8322', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8325', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8326', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8330', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8333', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8334', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8336', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('IMG_3124', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('IMG_3125', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('IMG_3126', 68);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8337', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8338', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8339', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8341', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8342', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8343', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8344', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8346', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8347', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8348', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8349', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8350', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8351', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8352', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8353', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8354', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8355', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8356', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8357', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8358', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8359', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8363', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8365', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8366', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8370', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8373', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8374', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8377', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8381', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8382', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8383', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8384', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8387', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8392', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8396', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8398', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8399', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8401', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8403', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8404', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8405', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8406', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8407', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8408', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8409', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8410', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8413', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8414', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8416', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8417', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8421', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8423', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8426', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8427', 69);
INSERT INTO bild (name, fk_galerie) VALUES ('CIMG8428', 69);