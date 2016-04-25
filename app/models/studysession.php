<?php
class StudySession extends BaseModel {
	public $sessionid, $person, $course, $completiondate, $time, $technique;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array();
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
				'completiondate' => $row['completiondate'],
				'time' => $row['time'],
				'technique' => $row['technique']
			));
		}
		return $studysessions;
	}
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO StudySession (person, course, completiondate, time, technique) 
											VALUES (:person, :course, :completiondate, :time, :technique)
											RETURNING sessionid');
		$query->execute(array('person' => $this->person, 'course' => $this->course, 'completiondate' => $this->completiondate, 
								'time' => $this->time, 'technique' => $this->technique));
		$row = $query->fetch();
		$this->sessionid = $row['sessionid'];
	}
}
