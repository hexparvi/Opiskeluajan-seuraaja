INSERT INTO Kurssi (nimi, opintopisteet, alkamispvm, loppumispvm) VALUES ('otm', 5, now(), now());
INSERT INTO Opiskelija (kayttajanimi, salasana) VALUES ('pekka', 'hessuhopo');
INSERT INTO Kurssisuoritus (opiskelija, kurssi, nimi) VALUES ((SELECT id FROM Opiskelija WHERE kayttajanimi='pekka'), (SELECT id FROM Kurssi WHERE nimi='otm'), 'testi');
INSERT INTO Koe (kurssisuoritus, pvm, pisteet, arvosana) VALUES ((SELECT id FROM Kurssisuoritus WHERE nimi='testi'), now(), 0, 0);
INSERT INTO Muistiinpano (kurssisuoritus, sisalto) VALUES ((SELECT id FROM Kurssisuoritus WHERE nimi='testi'), 'Hei, olen muistiinpano.');
INSERT INTO Opiskelusessio (kurssisuoritus, pvm, kesto, tekniikka) VALUES ((SELECT id FROM Kurssisuoritus WHERE nimi='testi'), now(), 0, 'pomodoro');
