<?php
class Course extends BaseModel {
	public $id, $name, $credits, $startdate, $enddate, $ispublic;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function current() {
		$query = DB::connection()->prepare('SELECT * FROM Course WHERE enddate > now()');
		$query->execute();
		$rows = $query->fetchAll();
		$currentcourses = array();
		
		foreach($rows as $row) {
			$currentcourses[] = new Course(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'startdate' => $row['startdate'],
				'enddate' => $row['enddate'],
				'ispublic' => $row['ispublic']
			));
		}
		return $currentcourses;
	}
	
	public static function old() {
		$query = DB::connection()->prepare('SELECT * FROM Course WHERE enddate < now()');
		$query->execute();
		$rows = $query->fetchAll();
		$oldcourses = array();
		
		foreach($rows as $row) {
			$oldcourses[] = new Course(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'startdate' => $row['startdate'],
				'enddate' => $row['enddate'],
				'ispublic' => $row['ispublic']
			));
		}
		return $oldcourses;
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Course WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$course = new Course(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'credits' => $row['credits'],
				'startdate' => $row['startdate'],
				'enddate' => $row['enddate'],
				'ispublic' => $row['ispublic']
			));
			return $course;
		}
		return null;
	}
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Course (name, credits, startdate, enddate, ispublic) VALUES (:name, :credits, :startdate, :enddate, :ispublic) RETURNING id');
		$query->execute(array('name' => $this->name, 'credits' => $this->credits, 'startdate' => $this->startdate, 
		'enddate' => $this->enddate, 'ispublic' => $this->ispublic));
		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);
		$this->id = $row['id'];
	}
}
