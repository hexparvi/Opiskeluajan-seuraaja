<?php
class Note extends BaseModel {
	public $noteid, $person, $course, $content;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function course_notes($personid, $courseid) {
		$query = DB::connection()->prepare('SELECT * FROM Note WHERE person = :personid AND course = :courseid');
		$query->execute(array('personid' => $personid, 'courseid' => $courseid));
		$rows = $query->fetchAll();
		$notes = array();
		
		foreach($rows as $row) {
			$notes[] = new Note(array(
				'noteid' => $row['noteid'],
				'person' => $personid,
				'course' => $courseid,
				'content' => $row['content']
			));
		}
		return $notes;
	}
}
