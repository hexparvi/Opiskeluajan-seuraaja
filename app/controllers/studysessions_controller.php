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
}
