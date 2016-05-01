<?php
class Note extends BaseModel {
	public $noteid, $person, $course, $content;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array();
	}
	
	public static function find($noteid) {
		$query = DB::connection()->prepare('SELECT * FROM Note WHERE noteid = :noteid');
		$query->execute(array('noteid' => $noteid));
		$row = $query->fetch();
		
		if ($row) {
			$note = new Note(array(
				'noteid' => $row['noteid'],
				'person' => $row['person'],
				'course' => $row['course'],
				'content' => $row['content']
			));
			return $note;
		}
		return null;
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
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Note (person, course, content) 
											VALUES (:person, :course, :content) 
											RETURNING noteid');
		$query->execute(array('person' => $this->person, 'course' => $this->course, 'content' => $this->content));
		$row = $query->fetch();
		$this->noteid = $row['noteid'];
	}
	
	public function update() {
		$query = DB::connection()->prepare('UPDATE Note SET content = :content WHERE noteid = :noteid');
		$query->execute(array('content' => $this->content, 'noteid' => $this->noteid));
	}
	
	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Note WHERE noteid = :noteid');
		$query->execute(array('noteid' => $this->noteid));
	}
}
