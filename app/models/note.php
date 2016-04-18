<?php
class Note extends BaseModel {
	public $noteid, $personcourse, $content;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function allInPersoncourse($id) {
		$query = DB::connection()->prepare('SELECT * FROM Note WHERE personcourse = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$notes = array();
		
		foreach($rows as $row) {
			$notes[] = new Note(array(
				'noteid' => $row['noteid'],
				'personCourse' => $id,
				'content' => $row['content']
			));
		}
		return $notes;
	}
}
