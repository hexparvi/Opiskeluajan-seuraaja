<?php
class PersonCourse extends BaseModel {
	public $person, $course, $grade, $ongoing, $name, $credits, $ispublic;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array();
	}
	
	public static function find($personid, $courseid) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc
											INNER JOIN Course AS c ON pc.course = c.courseid
											WHERE pc.person = :personid AND pc.course= :courseid LIMIT 1');
		$query->execute(array('personid' => $personid, 'courseid' => $courseid));
		$row = $query->fetch();
		$course = new PersonCourse(array(
			'person' => $row['person'],
			'course' => $row['course'],
			'grade' => $row['grade'],
			'ongoing' => $row['ongoing'],
			'name' => $row['name'],
			'credits' => $row['credits'],
			'ispublic' => $row['ispublic']
		));
		return $course;
	}
	
	public static function user_courses($userid) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc 
											INNER JOIN Course AS c ON pc.course = c.courseid 
											WHERE pc.person = :id');
		$query->execute(array('id' => $userid));
		$rows = $query->fetchAll();
		$courses = array();
		
		foreach ($rows as $row) {
			$courses[] = new PersonCourse(array(
				'person' => $row['person'],
				'course' => $row['course'],
				'grade' => $row['grade'],
				'ongoing' => $row['ongoing'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'ispublic' => $row['ispublic']
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
		$query = DB::connection()->prepare('UPDATE PersonCourse SET ongoing = :bool, grade = :grade WHERE pcid = :id');
		$query->execute(array('bool' => $bool, 'grade' => $this->grade, 'id' => $this->pcid));
	}
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO PersonCourse (person, course, ongoing) 
											VALUES (:person, :course, :ongoing) 
											RETURNING pcid');
		$query->execute(array('person' => $this->person, 'course' => $this->course, 'ongoing' => $this->ongoing));
		$row = $query->fetch();
		$this->pcid = $row['pcid'];
	}
	
	public function destroy() {
		
	}
}
