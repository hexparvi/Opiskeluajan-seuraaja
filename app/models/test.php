<?php
class Test extends BaseModel {
	public $id, $personcourse, $takendate, $points;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function allInPersoncourse($id) {
		$query = DB::connection()->prepare('SELECT * FROM Test WHERE personcourse = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$tests = array();
		
		foreach($rows as $row) {
			$tests[] = new Test(array(
				'id' => $row['id'],
				'personcourse' => $row['personcourse'],
				'takendate' => $row['takendate'],
				'points' => $row['points']
			));
		}
		return $tests;
	}
}
