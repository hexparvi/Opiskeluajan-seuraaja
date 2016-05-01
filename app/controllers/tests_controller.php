<?php
class TestController extends BaseController {
	
	public static function create() {
		self::check_logged_in();
		$personcourses = PersonCourse::user_courses(self::get_user_logged_in()->personid);
		View::make('test/newtest.html', array('courses' => $personcourses));
	}
	
	public static function store() {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$attributes = array(
			'person' => $userid,
			'course' => $params['course'],
			'takendate' => $params['takendate'],
			'points' => $params['points']
		);
		$test = new Test($attributes);
		
		$errors = $test->errors();
		if (count($errors) == 0) {
			$test->save();
			Redirect::to('/courses', array('message' => 'Koe lisätty.'));
		} else {
			View::make('test/newtest.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}
}
