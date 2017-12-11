INSERT INTO agenda (start, name, ort) VALUES ('2017-11-25', 'Grunzerparty', 'Ebersecken');
INSERT INTO agenda (start, name, ort) VALUES ('2018-01-06', 'Fasnachtseröffnung', 'Schlierbach');
INSERT INTO agenda (start, ende, name, ort) VALUES ('2018-01-13', '2018-01-14', 'Weekend', 'Saas-Fee');
INSERT INTO agenda (start, name, ort) VALUES ('2018-01-20', 'All-Ball', 'Schlierbach');
INSERT INTO agenda (start, name, ort) VALUES ('2018-01-21', 'Verwünschter Sonntag', 'Büron');
INSERT INTO agenda (start, name, ort) VALUES ('2018-01-26', 'Suugerball', 'Schlierbach');
INSERT INTO agenda (start, name, ort) VALUES ('2018-01-27', 'BTS-Ball', 'Schwarzenbach');
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-03', 'QQT-Ball', 'Triengen');
INSERT INTO agenda (start, name, ort, highlight, ordnung) VALUES ('2018-02-03', 'Kinderfasnacht', 'Schlierbach', 1, 3);
INSERT INTO agenda (start, name, ort, highlight) VALUES ('2018-02-07', 'Rammlerball', 'Schlierbach', 1);
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-08', 'Schmudo-Fäscht', 'Winikon');
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-09', 'Oelibrönnerball', 'Gunzwil');
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-10', 'Fläckefasnacht', 'Beromünster');
INSERT INTO agenda (start, name, ort, ordnung) VALUES ('2018-02-10', 'Zunftball', 'Schlierbach', 7);
INSERT INTO agenda (start, name, ort, highlight, ordnung) VALUES ('2018-02-11', 'Rammlerstöbli', 'Schlierbach', 1, 3);
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-11', 'Umzug', 'Schlierbach');
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-12', 'Easyball', 'Geuensee');
INSERT INTO agenda (start, name, ort) VALUES ('2018-02-13', 'Umzug/Uslompete', 'Triengen');

INSERT INTO saison (name) VALUES ('Candy Shop');
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUE ('Was macht dech so süess', 2);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUE ('Wie süess esch di Kontostand', 2);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUE ('Wer wettisch du gärn mol vernasche', 2);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUE ('Wenn du ei Monet kei süesses chasch nasche, wersch du...', 2);
INSERT INTO mitgliederportrait_frage (frage, fk_saison) VALUE ('Was esch dis Lieblingsschläckzüg', 2);

UPDATE mitglied SET fk_status = 1 WHERE fk_status=2;
UPDATE mitglied SET fk_status = 3 WHERE id IN (34);
UPDATE mitglied SET fk_status = 4 WHERE id IN (17, 27, 35, 37, 41);

INSERT INTO mitglied (vorname, nachname, eintritt, fk_instrument, fk_status) VALUES ('Nora', 'Polesel', '2017/2018', 2, 2);
INSERT INTO mitglied (vorname, nachname, eintritt, fk_instrument, fk_status) VALUES ('Adrian', 'Küng', '2017/2018', 5, 2);
INSERT INTO mitglied (vorname, nachname, eintritt, fk_instrument, fk_status) VALUES ('Manuela', 'Habermacher', '2017/2018', 3, 2);
INSERT INTO mitglied (vorname, nachname, eintritt, fk_instrument, fk_status) VALUES ('Tobias', 'Schwegler', '2017/2018', 3, 2);
INSERT INTO mitglied (vorname, nachname, eintritt, fk_instrument, fk_status) VALUES ('Raphael', 'Troxler', '2017/2018', 7, 2);
INSERT INTO mitglied (vorname, nachname, eintritt, fk_instrument, fk_status) VALUES ('Severin', 'Troxler', '2017/2018', 7, 2);

UPDATE mitglied SET fk_instrument=5 WHERE id=54;
UPDATE mitglied SET fk_instrument=7 WHERE id=4;

