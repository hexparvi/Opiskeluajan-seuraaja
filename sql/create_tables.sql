CREATE TABLE Course(
	courseid SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	credits INTEGER NOT NULL,
	ispublic BOOLEAN NOT NULL
);

CREATE TABLE Person(
	personid SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
	pw TEXT NOT NULL CHECK(length(pw) > 5)
);

CREATE TABLE PersonCourse(
	person INTEGER NOT NULL REFERENCES Person(personid) ON DELETE CASCADE,
	course INTEGER NOT NULL REFERENCES Course(courseid) ON DELETE CASCADE,
	ongoing BOOLEAN NOT NULL,
	grade INTEGER,
	PRIMARY KEY (person, course)
);

CREATE TABLE Test(
	testid SERIAL PRIMARY KEY,
	person INTEGER NOT NULL,
	course INTEGER NOT NULL,
	FOREIGN KEY (person, course) REFERENCES PersonCourse(person, course) ON DELETE CASCADE,
	takendate DATE NOT NULL,
	points INTEGER
);

CREATE TABLE Note(
	noteid SERIAL PRIMARY KEY,
	person INTEGER NOT NULL,
	course INTEGER NOT NULL,
	FOREIGN KEY (person, course) REFERENCES PersonCourse(person, course) ON DELETE CASCADE,
	content TEXT NOT NULL
);

CREATE TABLE StudySession(
	sessionid SERIAL PRIMARY KEY,
	person INTEGER NOT NULL,
	course INTEGER NOT NULL,
	FOREIGN KEY (person, course) REFERENCES PersonCourse(person, course) ON DELETE CASCADE,
	completiondate DATE NOT NULL,
	time INTEGER NOT NULL,
	technique TEXT
);
