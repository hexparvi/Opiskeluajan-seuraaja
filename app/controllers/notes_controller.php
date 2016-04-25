<?php
class NoteController extends BaseController {
	public static function create() {
		self::get_user_logged_in();
		$courses = PersonCourse::user_courses(self::get_user_logged_in()->personid);
		View::make('note/newnote.html', array('courses' => $courses));
	}
}
