<?php
class CourseController extends BaseController {
	public static function index() {
		$user = self::check_logged_in();
		$personcourses = PersonCourse::user_courses($user->personid);
		View::make('course/courselist.html', array('courses' => $personcourses));
	}
	
	public static function show($id) {
		$user = self::check_logged_in();
		$course = Course::find($id);
		$tests = Test::course_tests($id);
		$notes = Note::course_notes($id);
		$studysessions = Studysession::course_sessions($id);
		View::make('course/course.html', array('course' => $course, 'tests' => $tests, 'notes' => $notes, 'studysessions' => $studysessions));
	
	}
	
	public static function create() {
		$user = self::check_logged_in();
		$courses = Course::public_courses();
		View::make('course/joincourse.html', array('courses' => $courses));
	
	}

	public static function store() {
		$user = self::check_logged_in();
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
				'person' => self::get_user_logged_in()->personid,
				'course' => $course->courseid,
				'ongoing' => true
			);
			$personcourse = new PersonCourse($attributes);
			$personcourse->save();
			
			Redirect::to('/courses/' . $course->courseid, array('message' => 'Liityit kurssille.'));
		} else {
			View::make('course/joincourse.html', array('errors' => $errors, 'attributes' => $attributes));
		}
		
	}
	
	public static function update($id) {
		$user = self::check_logged_in();
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
		$user = self::check_logged_in();
		$course = new Course(array('courseid' => $id));
		$course->destroy();
		Redirect::to('/courses', array('message' => 'Kurssi on poistettu onnistuneesti.'));
	}
	
	public static function edit($id) {
		$user = self::check_logged_in();
		$personcourse = PersonCourse::find(self::get_user_logged_in()->personid, $id);
		View::make('course/edit.html', array('attributes' => $personcourse));
	}
}
