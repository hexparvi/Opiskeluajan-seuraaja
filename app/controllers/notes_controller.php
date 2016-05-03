<?php
class NoteController extends BaseController {
	
	public static function create() {
		self::get_user_logged_in();
		$courses = PersonCourse::user_courses(self::get_user_logged_in()->personid);
		View::make('note/newnote.html', array('courses' => $courses));
	}
	
	public static function store() {
		self::get_user_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$attributes = array(
			'person' => $userid,
			'course' => $params['course'],
			'content' => $params['content']
		);
		$note = new Note($attributes);
		
		$errors = $note->errors();
		if (count($errors) == 0) {
			$note->save();
			Redirect::to('/courses/' . $note->course, array('message' => 'Muistiinpano lisätty.'));
		} else {
			$courses = PersonCourse::user_courses(self::get_user_logged_in()->personid);
			View::make('note/newnote.html', array('courses' => $courses, 'errors' => $errors, 'attributes' => $attributes));
		}
	}
	
	public static function edit($noteid) {
		self::get_user_logged_in();
		$note = Note::find($noteid);
		View::make('note/edit.html', array('attributes' => $note));
	}
	
	public static function update($noteid, $courseid) {
		self::get_user_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$attributes = array(
			'noteid' => $noteid,
			'content' => $params['content']
		);
		$note = new Note($attributes);
		$errors = $note->errors();
		if (count($errors) > 0) {
			View::make('note/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else {
			$note->update();
			Redirect::to('/courses/' . $courseid, array('message' => 'Muistiinpanoa on muokattu onnistuneesti.'));
		}
	}
	
	public static function destroy($noteid, $courseid) {
		self::get_user_logged_in();
		$note = new Note(array('noteid' => $noteid));
		$note->destroy();
		Redirect::to('/courses/' . $courseid, array('message' => 'Muistiinpano on poistettu onnistuneesti.'));
	}
}
