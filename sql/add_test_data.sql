INSERT INTO Course (name, credits, ispublic) VALUES ('otm', 5, true);
INSERT INTO Course (name, credits, ispublic) VALUES ('tsoha', 5, true);
INSERT INTO Course (name, credits, ispublic) VALUES ('ohja', 5, true);
INSERT INTO Course (name, credits, ispublic) VALUES ('yksityinen', 0, false);

INSERT INTO Person (username, pw) VALUES ('pekka', 'hessuhopo');

INSERT INTO PersonCourse (person, course, ongoing) VALUES ((SELECT personid FROM person WHERE username='pekka'), (SELECT courseid FROM course WHERE name='yksityinen'), true);
INSERT INTO PersonCourse (person, course, ongoing) VALUES ((SELECT personid FROM person WHERE username='pekka'), (SELECT courseid FROM course WHERE name='otm'), true);
INSERT INTO PersonCourse (person, course, ongoing) VALUES ((SELECT personid FROM person WHERE username='pekka'), (SELECT courseid FROM course WHERE name='tsoha'), false);

INSERT INTO Test (person, course, takendate, points) VALUES (1, 4, now(), 0);

INSERT INTO Note (person, course, content) VALUES (1, 4, 'Hei, olen muistiinpano.');
INSERT INTO Note (person, course, content) VALUES (1, 4, 'Samoin minä.');

INSERT INTO StudySession (person, course, completiondate, time, technique) VALUES (1, 4, now(), 240, 'pomodoro');
INSERT INTO StudySession (person, course, completiondate, time, technique) VALUES (1, 4, now(), 120, 'luento');
