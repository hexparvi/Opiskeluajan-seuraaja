<?php
class Test extends BaseModel {
	public $testid, $person, $course, $takendate, $points;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
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
}
