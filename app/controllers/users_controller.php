<?php
class UserController extends BaseController {
	public static function login() {
		View::make('user/login.html');
	}
	
	public static function handle_login() {
		$params = $_POST;
		$user = User::authenticate($params['username'], $params['password']);
		if (!$user) {
			View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['username']));
		} else {
			$_SESSION['user'] = $user->personid;
			Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
		}
	}
	
	public static function logout() {
		$_SESSION['user'] = null;
		Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
	}
	
	public static function create() {
		View::make('user/register.html');
	}
	
	public static function store() {
		$params = $_POST;
		$attributes = array(
			'username' => $params['username'],
			'pw' => $params['password'],
			'pwconfirm' => $params['confirmPassword']
		);
		$user = new User($attributes);
		
		$errors = $user->errors();
		if (count($errors) == 0) {
			$user->save();
			Redirect::to('/', array('message' => 'Olet rekisteröitynyt onnistuneesti.'));
		} else {
			View::make('user/register.html', array('errors' => $errors, 'username' => $params['username']));
		}
	}
}
