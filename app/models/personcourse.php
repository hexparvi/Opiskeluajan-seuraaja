<?php
class Personcourse extends BaseModel {
	public $pcid, $person, $course, $grade, $courseid, $name, $credits, $startdate, $enddate, $ispublic;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function user_courses($id) {
		$query = DB::connection()->prepare('SELECT * FROM Personcourse AS pc INNER JOIN Course AS c ON pc.course = c.courseid WHERE pc.person = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$courses = array();
		
		foreach ($rows as $row) {
			$courses[] = new Personcourse(array(
				'pcid' => $row['pcid'],
				'person' => $row['person'],
				'course' => $row['course'],
				'grade' => $row['grade'],
				'courseid' => $row['courseid'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'startdate' => $row['startdate'],
				'enddate' => $row['enddate'],
				'ispublic' => $row['ispublic']
			));
		}
		return $courses;
	} 
}
