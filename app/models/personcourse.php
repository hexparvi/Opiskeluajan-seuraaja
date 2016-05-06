<?php
class PersonCourse extends BaseModel {
	public $person, $course, $grade, $ongoing, $name, $credits, $ispublic, $sessioncount, $timespent;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array();
	}
	
	public static function find($person, $course) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc
											INNER JOIN Course AS c ON pc.course = c.courseid
											LEFT JOIN (SELECT person, course, COUNT(sessionid), SUM(time) FROM StudySession GROUP BY person, course) AS s 
											ON pc.person = s.person AND pc.course = s.course
											WHERE pc.person = :person AND pc.course = :course');
		$query->execute(array('person' => $person, 'course' => $course));
		$row = $query->fetch();
		$course = new PersonCourse(array(
			'person' => $row['0'],
			'course' => $row['1'],
			'grade' => $row['grade'],
			'ongoing' => $row['ongoing'],
			'name' => $row['name'],
			'credits' => $row['credits'],
			'ispublic' => $row['ispublic'],
			'sessioncount' => $row['count'],
			'timespent' => $row['sum']
		));
		return $course;
	}
	
	public static function is_on_course($person, $course) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse WHERE person = :person AND course = :course LIMIT 1');
		$query->execute(array('person' => $person, 'course' => $course));
		$row = $query->fetch();
		
		if ($row) {
			return true;
		}
		return false;
	}
	
	public static function user_courses($userid) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc
											INNER JOIN Course AS c ON pc.course = c.courseid
											LEFT JOIN (SELECT person, course, COUNT(sessionid), SUM(time) FROM StudySession GROUP BY person, course) AS s 
											ON pc.person = s.person AND pc.course = s.course
											WHERE pc.person = :person');
		$query->execute(array('person' => $userid));
		$rows = $query->fetchAll();
		$courses = array();
		
		foreach ($rows as $row) {
			$courses[] = new PersonCourse(array(
				'person' => $row['0'],
				'course' => $row['1'],
				'grade' => $row['grade'],
				'ongoing' => $row['ongoing'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'ispublic' => $row['ispublic'],
				'sessioncount' => $row['count'],
				'timespent' => $row['sum']
			));
		}
		return $courses;
	}
	
	public static function ongoing($userid) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc 
											INNER JOIN Course AS c ON pc.course = c.courseid 
											WHERE pc.person = :id AND pc.ongoing = true');
		$query->execute(array('id' => $userid));
		$rows = $query->fetchAll();
		$currentcourses = array();
		
		foreach($rows as $row) {
			$currentcourses[] = new PersonCourse(array(
				'pcid' => $row['pcid'],
				'person' => $row['person'],
				'grade' => $row['grade'],
				'ongoing' => $row['ongoing'],
				'courseid' => $row['courseid'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'ispublic' => $row['ispublic']
			));
		}
		return $currentcourses;
	}
	
	public function update() {
		$bool = 'false';
		if ($this->ongoing) {
			$bool = 'true';
		}
		$query = DB::connection()->prepare('UPDATE PersonCourse SET ongoing = :bool, grade = :grade 
											WHERE person = :personid AND course = :courseid');
		$query->execute(array('bool' => $bool, 'grade' => $this->grade, 'personid' => $this->person, 'courseid' => $this->course));
	}
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO PersonCourse (person, course, ongoing) 
											VALUES (:person, :course, :ongoing)');
		$query->execute(array('person' => $this->person, 'course' => $this->course, 'ongoing' => $this->ongoing));
		$row = $query->fetch();
	}
	
	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM PersonCourse WHERE person = :personid AND course = :courseid');
		$query->execute(array('personid' => $this->person, 'courseid' => $this->course));
	}
}
