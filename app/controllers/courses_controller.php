<?php
class CourseController extends BaseController {
	public static function index() {
		$user = self::get_user_logged_in();
		if (!$user) {
			View::make('user/login.html');
		} else {
			$personcourses = Personcourse::user_courses($user->personid);
			View::make('course/courselist.html', array('courses' => $personcourses));
		}
	}
	
	public static function show($id) {
		$course = Course::find($id);
		$tests = Test::allInPersoncourse($id);
		$notes = Note::allInPersoncourse($id);
		$studysessions = Studysession::allInPersoncourse($id);
		View::make('course/course.html', array('course' => $course, 'tests' => $tests, 'notes' => $notes, 'studysessions' => $studysessions));
	}
	
	public static function create() {
		$courses = Course::public_courses();
		View::make('course/joincourse.html');
	}

	public static function store() {
		$params = $_POST;
		$attributes = array(
			'name' => $params['name'],
			'credits' => $params['credits'],
			'startdate' => $params['startdate'],
			'enddate' => $params['enddate'],
			'ispublic' => isset($params['ispublic'])
		);
		$course = new Course($attributes);
		$errors = $course->errors();
		if (count($errors) == 0) {
			$course->save();
			Redirect::to('/courses/' . $course->courseid, array('message' => 'Liityit kurssille.'));
		} else {
			View::make('course/joincourse.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}
	
	public static function update($id) {
		$params = $_POST;
		$attributes = array(
			'courseid' => $id,
			'credits' => $params['credits']
		);
		$course = new Course($attributes);
		$errors = $course->errors();
		
		if (count($errors) > 0) {
			View::make('course/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else {
			$course->update();
			Redirect::to('/courses/' . $course->courseid, array('message' => 'Kurssia on muokattu onnistuneesti.'));
		}
	}
	
	public static function destroy($id) {
		$course = new Course(array('courseid' => $id));
		$course->destroy();
		Redirect::to('/courses', array('message' => 'Kurssi on poistettu onnistuneesti.'));
	}
	
	public static function edit($id) {
		$course = Course::find($id);
		View::make('course/edit.html', array('attributes' => $course));
	}
}
