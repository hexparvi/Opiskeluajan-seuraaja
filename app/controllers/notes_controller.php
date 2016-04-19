<?php
class NoteController extends BaseController {
	public static function create() {
		$user = self::get_user_logged_in(); //copypaste
		if (!$user) {
			View::make('user/login.html');
		} else {
			$courses = PersonCourse::user_courses($user->personid);
			View::make('note/newnote.html', array('courses' => $courses));
		}
	}
}
