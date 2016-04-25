<?php
class User extends BaseModel {
	public $personid, $username, $pw;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array();
	}
	
	public static function authenticate($username, $pw) {
		$query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username AND pw = :pw LIMIT 1');
		$query->execute(array('username' => $username, 'pw' => $pw));
		$row = $query->fetch();
		
		if ($row) {
			$user = new User(array(
				'personid' => $row['personid'],
				'username' => $row['username'],
				'pw' => $row['pw']
			));
			return $user;
		}
		return null;
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Person WHERE personid = :id');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$user = new User(array(
				'personid' => $row['personid'],
				'username' => $row['username'],
				'pw' => $row['pw']
			));
			return $user;
		}
		return null;
	}
}
