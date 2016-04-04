CREATE TABLE Kurssi(
	id SERIAL PRIMARY KEY,
	opintopisteet INTEGER NOT NULL,
	alkamispvm DATE NOT NULL,
	loppumispvm DATE NOT NULL
);

CREATE TABLE Opiskelija(
	id SERIAL PRIMARY KEY,
	kayttajanimi TEXT NOT NULL UNIQUE CHECK(length(kayttajanimi) > 3),
	salasana TEXT NOT NULL CHECK(length(salasana) > 5)
);

CREATE TABLE Kurssisuoritus(
	id SERIAL PRIMARY KEY,
	opiskelija INTEGER NOT NULL,
	kurssi INTEGER NOT NULL,
	FOREIGN KEY opiskelija REFERENCES Opiskelija(id),
	FOREIGN KEY kurssi REFERENCES Kurssi(id)
);

CREATE TABLE Koe(
	id SERIAL PRIMARY KEY,
	kurssisuoritus INTEGER NOT NULL,
	pvm DATE NOT NULL,
	pisteet INTEGER,
	arvosana INTEGER,
	FOREIGN KEY kurssi REFERENCES Kurssisuoritus(id)
);

CREATE TABLE Muistiinpano(
	id SERIAL PRIMARY KEY,
	kurssisuoritus INTEGER NOT NULL,
	sisalto TEXT NOT NULL.
	FOREIGN KEY kurssisuoritus REFERENCES Kurssisuoritus(id)
);

CREATE TABLE Opiskelusessio(
	id SERIAL PRIMARY KEY,
	kurssisuoritus INTEGER NOT NULL,
	pvm DATE NOT NULL,
	kesto INTEGER NOT NULL,
	tekniikka TEXT,
	FOREIGN KEY kurssi REFERENCES Kurssisuoritus(id)
);
