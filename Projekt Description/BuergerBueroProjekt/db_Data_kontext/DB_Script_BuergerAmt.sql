
DROP DATABASE IF EXISTS burgerAmt;

CREATE DATABASE burgerAmt;

USE burgerAmt;
CREATE TABLE IF NOT EXISTS Feiertage (
    Feiertags_ID INT AUTO_INCREMENT PRIMARY KEY,
    Termin_FeiertagsName VARCHAR(255) NOT NULL,
    Termin_FeiertagsDatum DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS Orte (
    Ort_ID INT AUTO_INCREMENT PRIMARY KEY,
    PLZ VARCHAR(10) NOT NULL,
    Ort VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Strassen (
    Strasse_ID INT AUTO_INCREMENT PRIMARY KEY,
    Strasse VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Artikel (
    Artikel_ID INT AUTO_INCREMENT PRIMARY KEY,
    ArtikelTitel VARCHAR(255) NOT NULL,
    ArtikelDatum DATE NOT NULL,
    ArtikelBild LONGBLOB,
    ArtikelText TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS Gruppen (
    Gruppen_ID INT AUTO_INCREMENT PRIMARY KEY,
    Gruppe VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS Adressen (
    Adresse_ID INT AUTO_INCREMENT PRIMARY KEY,
    Strasse_ID INT NOT NULL,
    Adresse_Hausnummer VARCHAR(50) NOT NULL,
    Ort_ID INT NOT NULL,
    FOREIGN KEY (Strasse_ID) REFERENCES Strassen(Strasse_ID),
    FOREIGN KEY (Ort_ID) REFERENCES Orte(Ort_ID)
);
CREATE TABLE IF NOT EXISTS Personen (
    Pers_ID INT AUTO_INCREMENT PRIMARY KEY,
    Pers_Name VARCHAR(255) NOT NULL,
    Pers_Vorname VARCHAR(255) NOT NULL,
    Pers_Geb_Datum DATE NOT NULL,
    Pers_Geb_Ort_ID INT,
    Pers_Adress_ID INT,
    FOREIGN KEY (Pers_Geb_Ort_ID) REFERENCES Orte(Ort_ID),
    FOREIGN KEY (Pers_Adress_ID) REFERENCES Adressen(Adresse_ID)
);
CREATE TABLE IF NOT EXISTS Mitarbeiter (
    Mitarbeiter_ID INT AUTO_INCREMENT PRIMARY KEY,
    Personen_ID INT NOT NULL,
    Gruppen_ID INT NOT NULL,
    FOREIGN KEY (Personen_ID) REFERENCES Personen(Pers_ID),
    FOREIGN KEY (Gruppen_ID) REFERENCES Gruppen(Gruppen_ID)
);

CREATE TABLE IF NOT EXISTS Termin_Urlaub (
    Termin_Urlaub_ID INT AUTO_INCREMENT PRIMARY KEY,
    Termin_Urlaub DATE NOT NULL,
    Termin_Mitarbeiter_ID INT NOT NULL,
    FOREIGN KEY (Termin_Mitarbeiter_ID) REFERENCES Mitarbeiter(Mitarbeiter_ID)
);

CREATE TABLE IF NOT EXISTS Termine (
    Termin_ID INT AUTO_INCREMENT PRIMARY KEY,
    Termin_Mitarbeiter_ID INT NOT NULL,
    Termin_Termin DATE NOT NULL,
    Termin_Startzeitpunkt TIME NOT NULL,
    Termin_Dauer INT NOT NULL,
    Termin_Titel VARCHAR(255) NOT NULL,
    FOREIGN KEY (Termin_Mitarbeiter_ID) REFERENCES Mitarbeiter(Mitarbeiter_ID)
);


CREATE TABLE IF NOT EXISTS Anträge (
    Antrag_ID INT AUTO_INCREMENT PRIMARY KEY,
    Gruppe_ID INT NOT NULL,
    file_data LONGBLOB NOT NULL,
    FOREIGN KEY (Gruppe_ID) REFERENCES Gruppen(Gruppen_ID)
);

INSERT INTO Feiertage (Termin_FeiertagsName, Termin_FeiertagsDatum) VALUES
('Neujahr', '2024-01-01'),
('Karfreitag', '2024-03-29'),
('Ostersonntag', '2024-03-31'),
('Ostermontag', '2024-04-01'),
('Tag der Arbeit', '2024-05-01'),
('Christi Himmelfahrt', '2024-05-09'),
('Pfingstsonntag', '2024-05-19'),
('Pfingstmontag', '2024-05-20'),
('Tag der Deutschen Einheit', '2024-10-03'),
('Weihnachten', '2024-12-25'),
('Zweiter Weihnachtsfeiertag', '2024-12-26'),
('Neujahr', '2025-01-01'),
('Karfreitag', '2025-04-18'),
('Ostersonntag', '2025-04-20'),
('Ostermontag', '2025-04-21'),
('Tag der Arbeit', '2025-05-01'),
('Christi Himmelfahrt', '2025-05-29'),
('Pfingstsonntag', '2025-06-08'),
('Pfingstmontag', '2025-06-09'),
('Tag der Deutschen Einheit', '2025-10-03');

INSERT INTO Orte (PLZ, Ort) VALUES
('10115', 'Berlin'),
('80331', 'München'),
('20095', 'Hamburg'),
('60311', 'Frankfurt am Main'),
('70173', 'Stuttgart'),
('40213', 'Düsseldorf'),
('30159', 'Hannover'),
('04109', 'Leipzig'),
('01067', 'Dresden'),
('45127', 'Essen'),
('50667', 'Köln'),
('33602', 'Bielefeld'),
('44135', 'Dortmund'),
('48143', 'Münster'),
('45127', 'Bochum'),
('69117', 'Heidelberg'),
('79098', 'Freiburg im Breisgau'),
('23552', 'Lübeck'),
('24103', 'Kiel'),
('26122', 'Oldenburg');

INSERT INTO Strassen (Strasse) VALUES
('Hauptstraße'),
('Bahnhofstraße'),
('Kirchplatz'),
('Schulweg'),
('Marktplatz'),
('Lindenallee'),
('Gartenstraße'),
('Birkenweg'),
('Am Hang'),
('Friedhofsweg'),
('Eichenweg'),
('Bergstraße'),
('Tannenweg'),
('Rosenstraße'),
('Dorfplatz'),
('Ahornweg'),
('Brunnenweg'),
('Buchenweg'),
('Bachstraße'),
('Mühlenweg');

INSERT INTO Gruppen (Gruppe) VALUES
('Entwicklung'),
('Vertrieb'),
('Marketing'),
('Finanzen'),
('Personal'),
('Qualitätssicherung'),
('Kundenservice'),
('Projektmanagement'),
('Einkauf'),
('Logistik'),
('Forschung und Entwicklung'),
('Kundendienst'),
('Informationstechnologie'),
('Buchhaltung'),
('Öffentlichkeitsarbeit'),
('Recht'),
('Design'),
('Produktion'),
('Administration'),
('Geschäftsentwicklung');

INSERT INTO Artikel (ArtikelTitel, ArtikelDatum, ArtikelBild, ArtikelText) VALUES
('Die Zukunft der künstlichen Intelligenz', '2024-03-15', LOAD_FILE('C:/Bilder/ki_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Bedeutung von erneuerbaren Energien', '2024-03-16', LOAD_FILE('C:/Bilder/erneuerbare_energien.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Auswirkungen von COVID-19 auf die Wirtschaft', '2024-03-17', LOAD_FILE('C:/Bilder/covid_wirtschaft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Mobilität', '2024-03-18', LOAD_FILE('C:/Bilder/mobilitaet_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Rolle der Blockchain in der Finanzbranche', '2024-03-19', LOAD_FILE('C:/Bilder/blockchain_finanz.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Arbeit nach COVID-19', '2024-03-20', LOAD_FILE('C:/Bilder/arbeit_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft des Einzelhandels', '2024-03-21', LOAD_FILE('C:/Bilder/einzelhandel_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Auswirkungen von Automatisierung auf die Arbeitsplätze', '2024-03-22', LOAD_FILE('C:/Bilder/automatisierung.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft des Gesundheitswesens', '2024-03-23', LOAD_FILE('C:/Bilder/gesundheitswesen_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft des Bildungssystems', '2024-03-24', LOAD_FILE('C:/Bilder/bildung_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Automobilindustrie', '2024-03-25', LOAD_FILE('C:/Bilder/autoindustrie_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft des Online-Handels', '2024-03-26', LOAD_FILE('C:/Bilder/online_handel_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Raumfahrt', '2024-03-27', LOAD_FILE('C:/Bilder/raumfahrt_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Landwirtschaft', '2024-03-28', LOAD_FILE('C:/Bilder/landwirtschaft_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Telekommunikation', '2024-03-29', LOAD_FILE('C:/Bilder/telekommunikation_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Energiegewinnung', '2024-03-30', LOAD_FILE('C:/Bilder/energie_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.'),
('Die Zukunft der Medien', '2024-03-31', LOAD_FILE('C:/Bilder/medien_zukunft.jpg'), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada augue eu odio cursus, vel finibus magna accumsan. Nullam facilisis tempor libero, nec rhoncus nisi dignissim in. Phasellus auctor dolor magna, eget viverra elit venenatis in. Nam aliquet justo nec velit rutrum, nec ultrices elit varius. Suspendisse nec sollicitudin nisi, sit amet tempus odio. Sed sem odio, pellentesque eu metus non, feugiat aliquam sapien. Proin sed nulla magna. Integer in est eu purus pharetra luctus. Duis nec justo enim.');

INSERT INTO Adressen (Strasse_ID, Adresse_Hausnummer, Ort_ID) VALUES
(1, '12a', 1),
(2, '45', 2),
(3, '78', 3),
(4, '101', 4),
(5, '13b', 5),
(6, '15', 6),
(7, '17c', 7),
(8, '19', 8),
(9, '21', 9),
(10, '23', 10),
(11, '25', 11),
(12, '27', 12),
(13, '29', 13),
(14, '31', 14),
(15, '33', 15),
(16, '35', 16),
(17, '37', 17),
(18, '39', 18),
(19, '41', 19),
(20, '43', 20);

INSERT INTO Personen (Pers_Name, Pers_Vorname, Pers_Geb_Datum, Pers_Geb_Ort_ID, Pers_Adress_ID) VALUES
('Müller', 'Peter', '1990-05-15', 1, 1),
('Schmidt', 'Anna', '1985-09-20', 2, 2),
('Schneider', 'Michael', '1978-03-10', 3, 3),
('Fischer', 'Maria', '1995-11-25', 4, 4),
('Weber', 'Thomas', '1980-07-12', 5, 5),
('Meyer', 'Sarah', '1992-01-03', 6, 6),
('Wagner', 'Stefan', '1976-08-28', 7, 7),
('Becker', 'Julia', '1983-04-17', 8, 8),
('Schulz', 'David', '1987-06-30', 9, 9),
('Hoffmann', 'Laura', '1998-02-22', 10, 10),
('Koch', 'Daniel', '1989-12-05', 11, 11),
('Bauer', 'Lena', '1979-10-08', 12, 12),
('Richter', 'Jan', '1993-07-19', 13, 13),
('Klein', 'Nicole', '1982-09-14', 14, 14),
('Wolf', 'Kevin', '1975-11-28', 15, 15),
('Schröder', 'Jessica', '1991-03-01', 16, 16),
('Lange', 'Patrick', '1984-08-18', 17, 17),
('Hofmann', 'Christina', '1996-04-12', 18, 18),
('Schäfer', 'Max', '1981-06-09', 19, 19),
('König', 'Vanessa', '1977-12-24', 20, 20);

INSERT INTO Mitarbeiter (Personen_ID, Gruppen_ID) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

INSERT INTO Termine (Termin_Mitarbeiter_ID, Termin_Termin, Termin_Startzeitpunkt, Termin_Dauer, Termin_Titel) VALUES
(1, '2024-03-15', '09:00:00', 60, 'Meeting mit Kunden'),
(2, '2024-03-16', '10:30:00', 45, 'Projektbesprechung'),
(3, '2024-03-17', '14:00:00', 30, 'Telefoninterview'),
(4, '2024-03-18', '11:00:00', 90, 'Workshop Planung'),
(5, '2024-03-19', '08:30:00', 120, 'Schulung neuer Mitarbeiter'),
(1, '2024-03-20', '13:00:00', 60, 'Besprechung Marketingstrategie'),
(2, '2024-03-21', '09:30:00', 45, 'Feedbackgespräch'),
(3, '2024-03-22', '16:00:00', 30, 'Statusupdate Meeting'),
(4, '2024-03-23', '10:30:00', 90, 'Budgetüberprüfung'),
(5, '2024-03-24', '11:00:00', 120, 'Präsentation Vorstand'),
(1, '2024-03-25', '09:00:00', 60, 'Kundengespräch'),
(2, '2024-03-26', '10:30:00', 45, 'Produktentwicklungstreffen'),
(3, '2024-03-27', '14:00:00', 30, 'Besprechung Marketingkampagne'),
(4, '2024-03-28', '11:00:00', 90, 'Projektfortschrittsbericht'),
(5, '2024-03-29', '08:30:00', 120, 'Teamtraining'),
(1, '2024-03-30', '13:00:00', 60, 'Verkaufsgespräch'),
(2, '2024-03-31', '09:30:00', 45, 'Qualitätssicherungstreffen'),
(3, '2024-04-01', '16:00:00', 30, 'Abteilungsmeeting'),
(4, '2024-04-02', '10:30:00', 90, 'Strategieplanung'),
(5, '2024-04-03', '11:00:00', 120, 'Kreativitätssitzung');

INSERT INTO Termin_Urlaub (Termin_Urlaub, Termin_Mitarbeiter_ID) VALUES
('2024-04-01', 1),
('2024-06-15', 2),
('2024-08-23', 3),
('2024-10-10', 4),
('2024-12-05', 5),
('2025-01-20', 6),
('2025-03-08', 7),
('2025-05-02', 8),
('2025-07-18', 9),
('2025-09-30', 10),
('2025-11-11', 11),
('2026-02-14', 12),
('2026-04-09', 13),
('2026-06-21', 14),
('2026-09-05', 15),
('2026-11-30', 16),
('2027-01-03', 17),
('2027-03-18', 18),
('2027-05-28', 19),
('2027-08-10', 20);

INSERT INTO Anträge (Gruppe_ID, file_data) VALUES
(1, LOAD_FILE('C:/PDF/dok_ba024340.pdf')),
(2, LOAD_FILE('C:/PDF/berufecheck-passt-der-beruf-zu-mir_ba036875.pdf')),
(3, LOAD_FILE('C:/PDF/dok_ba024525.pdf')),
(4, LOAD_FILE('C:/PDF/dok_ba029450.pdf')),
(5, LOAD_FILE('C:/PDF/dok_ba033205.pdf')),
(6, LOAD_FILE('C:/PDF/dok_ba034925.pdf')),
(7, LOAD_FILE('C:/PDF/dok_ba036880.pdf')),
(8, LOAD_FILE('C:/PDF/duale-ausbildung-en_ba026740.pdf')),
(9, LOAD_FILE('C:/PDF/eltern-ins-boot-holen_ba031005.pdf')),
(10, LOAD_FILE('C:/PDF/flyer-zum-berufswahltest-infos-fuer-eltern-und-lehrkraefte_ba037979.pdf')),
(11, LOAD_FILE('C:/PDF/handicap-na-und_ba026295.pdf')),
(12, LOAD_FILE('C:/PDF/info-ferienbeschaeftigung_ba036085.pdf')),
(13, LOAD_FILE('C:/PDF/merkblatt-11-berufsberatung_ba033920.pdf')),
(14, LOAD_FILE('C:/PDF/young-refugees-en-fr-ar-de_ba035585.pdf')),
(15, LOAD_FILE('C:/PDF/budget-fuer-ausbildung-flyer_ba038174.pdf')),
(16, LOAD_FILE('C:/PDF/dok_ba026115.pdf')),
(17, LOAD_FILE('C:/PDF/dok_ba029450.pdf')),
(18, LOAD_FILE('C:/PDF/dok_ba036880.pdf')),
(19, LOAD_FILE('C:/PDF/budget-fuer-ausbildung-flyer_ba038174.pdf')),
(20, LOAD_FILE('C:/PDF/eltern-ins-boot-holen_ba031005.pdf'));