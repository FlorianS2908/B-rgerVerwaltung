
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

CREATE TABLE IF NOT EXISTS Personen (
    Pers_ID INT AUTO_INCREMENT PRIMARY KEY,
    Pers_Name VARCHAR(255) NOT NULL,
    Pers_Vorname VARCHAR(255) NOT NULL,
    Pers_Email VARCHAR(255) NOT NULL,
    Pers_Geb_Datum DATE NOT NULL,
    Pers_Geb_Ort_ID INT,
    Pers_Adress_ID INT,
    Pers_Salt VARCHAR(255) NOT NULL,
    Pers_Password VARCHAR(255) NOT NULL,
    FOREIGN KEY (Pers_Geb_Ort_ID) REFERENCES Orte(Ort_ID),
    FOREIGN KEY (Pers_Adress_ID) REFERENCES Adressen(Adresse_ID)
);

CREATE TABLE IF NOT EXISTS Adressen (
    Adresse_ID INT AUTO_INCREMENT PRIMARY KEY,
    Strasse_ID INT NOT NULL,
    Adresse_Hausnummer VARCHAR(50) NOT NULL,
    Ort_ID INT NOT NULL,
    FOREIGN KEY (Strasse_ID) REFERENCES Strassen(Strasse_ID),
    FOREIGN KEY (Ort_ID) REFERENCES Orte(Ort_ID)
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

INSERT INTO Personen (
        Pers_Name,
        Pers_Vorname,
        Pers_Email,
        Pers_Geb_Datum,
        Pers_Geb_Ort_ID,
        Pers_Adress_ID,
        Pers_Salt,
        Pers_Password
    ) VALUES(
        'Candan',
        'Adem',
        'Adem.Candan@gfn.education',
        '1990-05-15',
        1,
        1,
        'ac7b8194e4ecfccecf2983397ae70ada',
        '$2y$10$qJ0/9L2EUm.st.7iM4Q9QuVJ7ibjJjadL/hI2MslAxpcdxnqyCj8y'
    ),
    (
        'Arriaga',
        'Andrea',
        'A.A@mail.com',
        '1985-09-20',
        2,
        2,
        '0c3a20a6105333b712edadbe51be8a86',
        '$2y$10$EPTrkQuh1m4bv6UjystrK.WP08SMugz7yXL9IOtH2aaetZXM8DFdq'
    ),
    (
        'Kosztolanyi',
        'Attila',
        'K.A@mail.com',
        '1978-03-10',
        3,
        3,
        'b1f8085328c47e7872c14706b85c42f3',
        '$2y$10$POsrr5dZzN3gG6Ajo5v.9uIRn86cV0E4YHkkh9k00K/fgezodSWS6'
    ),
    (
        'Castrillón',
        'Natalia',
        'natalia.castrillon.hernandez@hotmail.com',
        '1984-12-26',
        4,
        4,
        'ad9916926cf33bf8f0c78fb2d7ae7b40',
        '$2y$10$81cFcCPTxItbnpKQEHVsZ.6EXfirhdRChgY1rmMd8Whj19QcYUwfK'
    ),
    (
        'Kara',
        'Mustafa',
        'mustafa.kara@gfn.education',
        '1980-07-12',
        5,
        5,
        '3c155ac06fb80e8b86f8812ceb50a8b5',
        '$2y$10$sVgfzF6FiKPDOU0wexPTruXR97rLJUWIxe7YP.EzSC163y7C7mVim'
    ),
    (
        'Motruc',
        'Dan',
        'dan.motruc@gfn.education',
        '1995-07-14',
        6,
        6,
        'a304200a95e3867045e7c0ae56868856',
        '$2y$10$Lmu0CC4nx8ybA3cRBJONDOnHrKXVvyHM1zBvH0Kotde9e9jbSeKNW'
    ),
    (
        'Jahmurataj',
        'Bekim',
        'bekim.jahmurataj@gfn.education',
        '1990-01-29',
        7,
        7,
        'edc1fa43cbb8099c7960ce95e881d216',
        '$2y$10$5d5VJ9WvcddAf/5DBpLHGevEpFSwh1IILF6m91OEvbwwQulRsykaq'
    ),
    (
        'Nelke',
        'Patrycja',
        'patrycja.nelke@gfn.education',
        '1983-04-17',
        8,
        8,
        'b541b41f2fc32a6284b496c6d4493f38',
        '$2y$10$3lV8dCqk5cd43LYCDlzsQuwIYDV/EanQfw0BiRTdc/RRzA0K2sN.K'
    ),
    (
        'Siebler',
        'Johannes',
        'johannes.siebler@gfn.education',
        '1987-06-30',
        9,
        9,
        '17c5b7f04b4060197b7696231cd00d24',
        '$2y$10$CPFecmUZM0vdkSKH.J22QOOILDX.V4zQRslgxsdymW/P431Z0GrCS'
    ),
    (
        'Othmer',
        'Markus',
		'markus.othmer@gfn.education.de',
        '1978-07-05',
        10,
        10,
        '8cd2079e1e29fea2a2b790bcb6614cea',
        '$2y$10$niZLMW5mcaaOIK7W7NHVo.QpDDdhjcdyMz9Qo6GCLG7F5jWBqYW6C'
    ),
    (
        'Brunnenkant',
        'Robin',
        'robin@mail.de',
		'1989-12-05',
        11,
        11,
        '478b4e3b40a17a3c18e44af1a4b7f2b1',
        '$2y$10$LJcg3t2h86.TME4e3Lxcn.NwZ/hxrbjc0ZZPhl..6Sv5Yrxq7MGAW'
    ),
    (
        'Bauer',
        'Lena',
		'florian.schaffer1@gfn.de',
        '1979-10-08',
        12,
        12,
        '6aff457b0ce5af553d4a1bdb0b8e2572',
        '$2y$10$wxr.ytTujsdJRq/td6c7tuCYT/YbuQ8a0YaArwZvpXBILuk1Tcoki'
    ),
    (
        'Richter',
        'Jan',
		'florian.schaffer2@gfn.de',
        '1993-07-19',
        13,
        13,
        'b6f37dbfe7d26bd05f71fd9849bd4dd2',
        '$2y$10$mYDH/dgXy.ModCYEYwgmBu/d07JgcEBRRUo79eEkI4uF38xLuV48u'
    ),
    (
        'Klein',
        'Nicole',
		'florian.schaffer3@gfn.de',
        '1982-09-14',
        14,
        14,
        '330289412b805bab6f7b177c800eb056',
        '$2y$10$rLsnS9zWS3Egn3CgynuOQ.44k0f/9HgWHo3hUyrVdnxSEqn6Cmtba'
    ),
    (
        'Wolf',
        'Kevin',
		'florian.schaffer4@gfn.de',
        '1975-11-28',
        15,
        15,
        'cea6ac3955026f3a97592d0008a41254',
        '$2y$10$2laVpBOe8KC5AE1kgRqfWe8.oGdku1Dc4nytUGy.OQuBfRPyPg.wC'
    ),
    (
        'Beqiri',
        'Valdrin',
        'valdrin98@hotmail.com',
        '1991-03-01',
        16,
        16,
        'ad476df0da7eee4c37ef70bc12e92d62',
        '$2y$10$VoKkHWsAkb0GCzgGCXRPne.OKAqhKK3.qjiDyjaRqeJe4AY/AkXgu'
    ),
    (
        'Lange',
        'Patrick',
		'florian.schaffer5@gfn.de',
        '1984-08-18',
        17,
        17,
        'e6facbe9279b4740c6d2f0ccce3bfd2b',
        '$2y$10$1G669mGbtb/bhkDVHFKlDueeAIRC5TuoKPSrwCeWlDTCJ3Cv3ajCe'
    ),
    (
        'Hofmann',
        'Christina',
		'florian.schaffer6@gfn.de',
        '1996-04-12',
        18,
        18,
        '4bf73431a92d39eb32a42940d4f93a4a',
        '$2y$10$XSHK7f5MeSRUVnB5u6lQJOA7bzFqIwL460VD6dIVPWK7TkSUoUhjq'
    ),
    (
        'Schäfer',
        'Max',
		'florian.schaffer7@gfn.de',
        '1981-06-09',
        19,
        19,
        '8007153fb685af9b8bbf69c4eb773764',
        '$2y$10$r9gGmRP0JbsuvMB.2wcqj.ekZumZjA1mVQFwYdJK.z6PcagVXJFKi'
    ),
    (
        'König',
        'Vanessa',
		'florian.schaffer8@gfn.de',
        '1977-12-24',
        20,
        20,
        '7532899dd33b211a4c47f0eda1124521',
        '$2y$10$G9vvUeqXMROWsnElvaDBLeK/U1.uZNeZvDZmdWkUkKbZavO6oKXWG'
    );

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
(1, '2024-03-15', '09:00:00', 30, 'Meeting mit Kunden'),
(2, '2024-03-16', '10:30:00', 30, 'Projektbesprechung'),
(3, '2024-03-17', '14:00:00', 30, 'Telefoninterview'),
(4, '2024-03-18', '11:00:00', 30, 'Workshop Planung'),
(5, '2024-03-19', '08:30:00', 30, 'Schulung neuer Mitarbeiter'),
(1, '2024-03-20', '13:00:00', 30, 'Besprechung Marketingstrategie'),
(2, '2024-03-21', '09:30:00', 30, 'Feedbackgespräch'),
(3, '2024-03-22', '16:00:00', 30, 'Statusupdate Meeting'),
(4, '2024-03-23', '10:30:00', 30, 'Budgetüberprüfung'),
(5, '2024-03-24', '11:00:00', 30, 'Präsentation Vorstand'),
(1, '2024-03-25', '09:00:00', 30, 'Kundengespräch'),
(2, '2024-03-26', '10:30:00', 30, 'Produktentwicklungstreffen'),
(3, '2024-03-27', '14:00:00', 30, 'Besprechung Marketingkampagne'),
(4, '2024-03-28', '11:00:00', 30, 'Projektfortschrittsbericht'),
(5, '2024-03-29', '08:30:00', 30, 'Teamtraining'),
(1, '2024-03-30', '13:00:00', 30, 'Verkaufsgespräch'),
(2, '2024-03-31', '09:30:00', 30, 'Qualitätssicherungstreffen'),
(3, '2024-04-01', '16:00:00', 30, 'Abteilungsmeeting'),
(4, '2024-04-02', '10:30:00', 30, 'Strategieplanung'),
(5, '2024-04-03', '11:00:00', 30, 'Kreativitätssitzung');

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
(1, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(2, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(3, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(4, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(5, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(6, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(7, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(8, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(9,LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(10, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(11, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(12, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(13,LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(14, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(15, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(16,LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(17, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(18, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(19, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf')),
(20, LOAD_FILE('C:/PDF/Ticket_02_Registrierung.pdf'));