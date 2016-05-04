<?php
class User extends BaseModel {
	public $personid, $username, $pw, $pwconfirm;
	
	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array('validate_username', 'validate_password');
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
	
	public function username_exists() {
		$query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username LIMIT 1');
		$query->execute(array('username' => $this->username));
		$row = $query->fetch();
		
		if ($row) {
			return true;
		}
		return false;
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
	
	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Person (username, pw) 
											VALUES (:username, :pw) 
											RETURNING personid');
		$query->execute(array('username' => $this->username, 'pw' => $this->pw));
		$row = $query->fetch();
		$this->personid = $row['personid'];
	}
	
	public function validate_username() {
		$errors = array();
		$errors = $this->validate_string_length($this->username, 1, 15);
		if ($this->username_exists()) {
			$errors[] = 'Käyttäjänimi on varattu!';
		}
		return $errors;
	}
	
	public function validate_password() {
		$errors = array();
		$errors = $this->validate_string_length($this->pw, 6, 16);
		if ($this->pw != $this->pwconfirm) {
			$errors[] = 'Salasanat eivät täsmää!';
		}
		return $errors;
	}
}
