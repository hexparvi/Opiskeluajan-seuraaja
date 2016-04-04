CREATE TABLE Kurssi(
	id SERIAL PRIMARY KEY,
	nimi TEXT NOT NULL,
	opintopisteet INTEGER NOT NULL,
	alkamispvm DATE NOT NULL,
	loppumispvm DATE NOT NULL
);

CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	kayttajanimi TEXT NOT NULL UNIQUE CHECK(length(kayttajanimi) > 3),
	salasana TEXT NOT NULL CHECK(length(salasana) > 5)
);

CREATE TABLE Kurssisuoritus(
	id SERIAL PRIMARY KEY,
	kayttaja INTEGER NOT NULL REFERENCES Kayttaja(id),
	kurssi INTEGER NOT NULL REFERENCES Kurssi(id),
	nimi TEXT NOT NULL
);

CREATE TABLE Koe(
	id SERIAL PRIMARY KEY,
	kurssisuoritus INTEGER NOT NULL REFERENCES Kurssisuoritus(id),
	pvm DATE NOT NULL,
	pisteet INTEGER,
	arvosana INTEGER
);

CREATE TABLE Muistiinpano(
	id SERIAL PRIMARY KEY,
	kurssisuoritus INTEGER NOT NULL REFERENCES Kurssisuoritus(id),
	sisalto TEXT NOT NULL
);

CREATE TABLE Opiskelusessio(
	id SERIAL PRIMARY KEY,
	kurssisuoritus INTEGER NOT NULL REFERENCES Kurssisuoritus(id),
	pvm DATE NOT NULL,
	kesto INTEGER NOT NULL,
	tekniikka TEXT
);
