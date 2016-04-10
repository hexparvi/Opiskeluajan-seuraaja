<?php
class Personcourse extends BaseModel {
	public $id, $person, $course, $grade;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
	}
	
}
