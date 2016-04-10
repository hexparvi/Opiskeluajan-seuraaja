INSERT INTO course (name, credits, startdate, enddate, ispublic) VALUES ('otm', 5, '2016-04-02', '2016-08-25', true);
INSERT INTO course (name, credits, startdate, enddate, ispublic) VALUES ('tsoha', 5, '2016-03-15', '2016-05-04', true);
INSERT INTO course (name, credits, startdate, enddate, ispublic) VALUES ('ohja', 5, '2016-01-01', '2016-03-01', true);

INSERT INTO person (username, pw) VALUES ('pekka', 'hessuhopo');

INSERT INTO personcourse (person, course) VALUES ((SELECT id FROM person WHERE username='pekka'), (SELECT id FROM course WHERE name='otm'));
INSERT INTO personcourse (person, course) VALUES ((SELECT id FROM person WHERE username='pekka'), (SELECT id FROM course WHERE name='tsoha'));

INSERT INTO test (personcourse, takendate, points) VALUES (1, now(), 0);

INSERT INTO note (personcourse, content) VALUES (1, 'Hei, olen muistiinpano.');
INSERT INTO note (personcourse, content) VALUES (1, 'Samoin minä.');

INSERT INTO studysession (personcourse, completiondate, time, technique) VALUES (1, now(), 240, 'pomodoro');
INSERT INTO studysession (personcourse, completiondate, time, technique) VALUES (1, now(), 120, 'luento');
