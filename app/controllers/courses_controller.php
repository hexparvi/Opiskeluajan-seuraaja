<?php
class CourseController extends BaseController {
	public static function index() {
		self::check_logged_in();
		$personcourses = PersonCourse::user_courses(self::get_user_logged_in()->personid);
		View::make('course/courselist.html', array('courses' => $personcourses));
	}
	
	public static function show($id) {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$course = PersonCourse::find($userid, $id);
		$tests = Test::course_tests($userid, $id);
		$notes = Note::course_notes($userid, $id);
		$studysessions = StudySession::course_sessions($userid, $id);
		View::make('course/course.html', array('course' => $course, 'tests' => $tests, 'notes' => $notes, 'studysessions' => $studysessions));
	
	}
	
	public static function create() {
		self::check_logged_in();
		$courses = Course::public_courses();
		View::make('course/joincourse.html', array('courses' => $courses));
	}

	public static function join() {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		
		$attributes = array(
				'person' => $userid,
				'course' => $params['course'],
				'ongoing' => true
		);
		
		if (PersonCourse::is_on_course($userid, $params['course'])) {
			$courses = Course::public_courses();
			View::make('course/joincourse.html', array('errors' => array('Olet jo kurssilla!'), 'attributes' => $attributes, 'courses' => $courses));
		} else {
			$personcourse = new PersonCourse($attributes);
			$personcourse->save();
			Redirect::to('/courses/' . $personcourse->course, array('message' => 'Liityit kurssille.'));
		}
	}

	public static function store() {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$attributes = array(
			'name' => $params['name'],
			'credits' => $params['credits'],
			'ispublic' => isset($params['ispublic'])
		);
		$course = new Course($attributes);
		
		$errors = $course->errors();
		if (count($errors) == 0) {
			$course->save();
		
			$attributes = array(
				'person' => $userid,
				'course' => $course->courseid,
				'ongoing' => true
			);
			$personcourse = new PersonCourse($attributes);
			$personcourse->save();
			
			Redirect::to('/courses/' . $course->courseid, array('message' => 'Liityit kurssille.'));
		} else {
			$courses = Course::public_courses();
			View::make('course/joincourse.html', array('errors' => $errors, 'attributes' => $attributes, 'courses' => $courses));
		}
	}
	
	public static function update($id) {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$params = $_POST;
		$bool = false;
		if (isset($params['ongoing'])) {
			$bool = true;
		}
		$attributes = array(
			'person' => $userid,
			'course' => $id,
			'grade' => $params['grade'],
			'ongoing' => $bool
		);
		$course = new PersonCourse($attributes);
		$errors = $course->errors();
		if (count($errors) > 0) {
			View::make('course/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else {
			$course->update();
			Redirect::to('/courses/' . $course->course, array('message' => 'Kurssia on muokattu onnistuneesti.'));
		}
	}
	
	public static function destroy($id) {
		self::check_logged_in();
		$userid = self::get_user_logged_in()->personid;
		$personcourse = new PersonCourse(array('person' => $userid, 'course' => $id));
		$personcourse->destroy();
		$course = Course::find($id);
		if (!$course->ispublic) {
			$course->destroy();
		}
		Redirect::to('/courses', array('message' => 'Kurssi on poistettu onnistuneesti.'));
	}
	
	public static function edit($id) {
		self::check_logged_in();
		$personcourse = PersonCourse::find(self::get_user_logged_in()->personid, $id);
		View::make('course/edit.html', array('attributes' => $personcourse));
	}
}
