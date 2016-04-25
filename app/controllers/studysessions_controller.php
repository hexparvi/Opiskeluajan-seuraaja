<?php
class StudyController extends BaseController {
	public static function index($id) {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$sessions = StudySession::course_sessions($userid, $id);
		View::make('studysession/sessionlist.html', array('sessions' => $sessions));
	}
	
	public static function create() {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$courses = PersonCourse::user_courses($userid);
		View::make('studysession/newsession.html', array('courses' => $courses));
	}
	
	public static function store() {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$attributes = array(
			'person' => $userid,
			'course' => $params['course'],
			'completiondate' => $params['completiondate'],
			'time' => $params['time'],
			'technique' => $params['technique']
		);
		$session = new StudySession($attributes);
		
		$errors = $session->errors();
		if (count($errors) == 0) {
			$session->save();
			Redirect::to('/courses', array('message' => 'Opiskelusessio lisätty.'));
		} else {
			View::make('studysession/newsession.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}
}
