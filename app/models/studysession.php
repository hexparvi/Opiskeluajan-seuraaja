<?php
class Studysession extends BaseModel {
	public $sessionid, $completiondate, $time, $technique;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function course_sessions($personid, $courseid) {
		$query = DB::connection()->prepare('SELECT * FROM Studysession WHERE person = :personid AND course = :courseid');
		$query->execute(array('personid' => $personid, 'courseid' => $courseid));
		$rows = $query->fetchAll();
		$studysessions = array();
		
		foreach($rows as $row) {
			$studysessions[] = new Studysession(array(
				'sessionid' => $row['sessionid'],
				'person' => $row['person'],
				'course' => $row['course'],
				'completiondate' => $row['time'],
				'technique' => $row['technique']
			));
		}
		return $studysessions;
	}
}
