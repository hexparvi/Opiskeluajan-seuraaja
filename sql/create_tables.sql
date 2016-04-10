CREATE TABLE course(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	credits INTEGER NOT NULL,
	startdate DATE NOT NULL,
	enddate DATE NOT NULL,
	ispublic BOOLEAN NOT NULL
);

CREATE TABLE person(
	id SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
	pw TEXT NOT NULL CHECK(length(pw) > 5)
);

CREATE TABLE personcourse(
	id SERIAL PRIMARY KEY,
	person INTEGER NOT NULL REFERENCES Person(id),
	course INTEGER NOT NULL REFERENCES Course(id),
	grade INTEGER
);

CREATE TABLE test(
	id SERIAL PRIMARY KEY,
	personcourse INTEGER NOT NULL REFERENCES PersonCourse(id),
	takendate DATE NOT NULL,
	points INTEGER
);

CREATE TABLE note(
	id SERIAL PRIMARY KEY,
	personcourse INTEGER NOT NULL REFERENCES PersonCourse(id),
	content TEXT NOT NULL
);

CREATE TABLE studysession(
	id SERIAL PRIMARY KEY,
	personcourse INTEGER NOT NULL REFERENCES PersonCourse(id),
	completiondate DATE NOT NULL,
	time INTEGER NOT NULL,
	technique TEXT
);
