<?php
class Test extends BaseModel {
	public $testid, $person, $course, $takendate, $points;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array();
	}
	
	public static function course_tests($personid, $courseid) {
		$query = DB::connection()->prepare('SELECT * FROM Test WHERE person = :personid AND course = :courseid');
		$query->execute(array('personid' => $personid, 'courseid' => $courseid));
		$rows = $query->fetchAll();
		$tests = array();
		
		foreach($rows as $row) {
			$tests[] = new Test(array(
				'testid' => $row['testid'],
				'person' => $row['person'],
				'course' => $row['course'],
				'takendate' => $row['takendate'],
				'points' => $row['points']
			));
		}
		return $tests;
	}
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Test (person, course, takendate, points) 
											VALUES (:person, :course, :takendate, :points) 
											RETURNING testid');
		$query->execute(array('person' => $this->person, 'course' => $this->course, 'takendate' => $this->takendate, 'points' => $this->points));
		$row = $query->fetch();
		$this->testid = $row['testid'];
	}
}
