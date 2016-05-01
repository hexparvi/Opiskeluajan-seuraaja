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
	
	public static function edit($testid) {
		self::check_logged_in();
		$test = Test::find($testid);
		View::make('test/edit.html', array('attributes' => $test));
	}
	
	public static function update($testid, $courseid) {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$attributes = array(
			'testid' => $testid,
			'takendate' => $params['takendate'],
			'points' => $params['points']
		);
		$test = new Test($attributes);
		$errors = $test->errors();
		if (count($errors) > 0) {
			View::make('test/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else {
			$test->update();
			Redirect::to('/courses/' . $courseid, array('message' => 'Koetta on muokattu onnistuneesti.'));
		}
	}
	
	public static function destroy($testid, $courseid) {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$test = new Test(array('testid' => $testid));
		$test->destroy();
		Redirect::to('/courses/' . $courseid, array('message' => 'Koe on poistettu onnistuneesti.'));
	}
}
