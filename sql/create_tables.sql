CREATE TABLE course(
	courseid SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	credits INTEGER NOT NULL,
	startdate DATE NOT NULL,
	enddate DATE NOT NULL,
	ispublic BOOLEAN NOT NULL
);

CREATE TABLE person(
	personid SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
	pw TEXT NOT NULL CHECK(length(pw) > 5)
);

CREATE TABLE personcourse(
	pcid SERIAL PRIMARY KEY,
	person INTEGER NOT NULL REFERENCES Person(personid) ON DELETE CASCADE,
	course INTEGER NOT NULL REFERENCES Course(courseid) ON DELETE CASCADE,
	grade INTEGER
);

CREATE TABLE test(
	testid SERIAL PRIMARY KEY,
	personcourse INTEGER NOT NULL REFERENCES PersonCourse(pcid) ON DELETE CASCADE,
	takendate DATE NOT NULL,
	points INTEGER
);

CREATE TABLE note(
	noteid SERIAL PRIMARY KEY,
	personcourse INTEGER NOT NULL REFERENCES PersonCourse(pcid) ON DELETE CASCADE,
	content TEXT NOT NULL
);

CREATE TABLE studysession(
	sessionid SERIAL PRIMARY KEY,
	personcourse INTEGER NOT NULL REFERENCES PersonCourse(pcid) ON DELETE CASCADE,
	completiondate DATE NOT NULL,
	time INTEGER NOT NULL,
	technique TEXT
);
