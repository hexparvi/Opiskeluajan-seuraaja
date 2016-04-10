<?php
class Studysession extends BaseModel {
	public $id, $personcourse, $completiondate, $time, $technique;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function allInPersoncourse($id) {
		$query = DB::connection()->prepare('SELECT * FROM Studysession WHERE personcourse = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$studysessions = array();
		
		foreach($rows as $row) {
			$studysessions[] = new Studysession(array(
				'id' => $row['id'],
				'personcourse' => $row['personcourse'],
				'completiondate' => $row['time'],
				'technique' => $row['technique']
			));
		}
		return $studysessions;
	}
}
