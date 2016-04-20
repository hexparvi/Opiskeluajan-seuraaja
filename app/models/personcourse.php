<?php
class PersonCourse extends BaseModel {
	public $pcid, $person, $course, $grade, $ongoing, $courseid, $name, $credits, $ispublic;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($userid, $courseid) {
		
	}
	
	public static function user_courses($id) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc 
											INNER JOIN Course AS c ON pc.course = c.courseid 
											WHERE pc.person = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$courses = array();
		
		foreach ($rows as $row) {
			$courses[] = new Personcourse(array(
				'pcid' => $row['pcid'],
				'person' => $row['person'],
				'course' => $row['course'],
				'grade' => $row['grade'],
				'ongoing' => $row['ongoing'],
				'courseid' => $row['courseid'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'ispublic' => $row['ispublic']
			));
		}
		return $courses;
	}
	
	public static function ongoing($id) {
		$query = DB::connection()->prepare('SELECT * FROM PersonCourse AS pc 
											INNER JOIN Course AS c ON pc.course = c.courseid 
											WHERE pc.person = :id AND pc.ongoing = true');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$currentcourses = array();
		
		foreach($rows as $row) {
			$currentcourses[] = new Course(array(
				'pcid' => $row['pcid'],
				'person' => $row['person'],
				'course' => $row['course'],
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
		
	}
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO PersonCourse (person, course, ongoing) 
											VALUES (:person, :course, :ongoing) 
											RETURNING pcid');
		$query->execute(array('person' => $this->person, 'course' => $this->course, 'ongoing' => $this->ongoing));
		$row = $query->fetch();
		$this->pcid = $row['pcid'];
	}
}
