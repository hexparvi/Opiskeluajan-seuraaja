<?php
class CourseController extends BaseController {
	public static function index() {
		$currentcourses = Course::current();
		$oldcourses = Course::old();
		View::make('course/courselist.html', array('currentcourses' => $currentcourses, 'oldcourses' => $oldcourses));
	}
	
	public static function show($id) {
		$course = Course::find($id);
		$tests = Test::allInPersoncourse($id);
		$notes = Note::allInPersoncourse($id);
		$studysessions = Studysession::allInPersoncourse($id);
		View::make('course/course.html', array('course' => $course, 'tests' => $tests, 'notes' => $notes, 'studysessions' => $studysessions));
	}
	
	public static function create() {
		View::make('course/joincourse.html');
	}

	public static function store() {
		$params = $_POST;
		$course = new Course(array(
			'name' => $params['name'],
			'credits' => $params['credits'],
			'startdate' => $params['startdate'],
			'enddate' => $params['enddate'],
			'ispublic' => $params['ispublic']
		));
		$course->save();
		
		//Redirect::to('/courses/' . $course->id, array('message' => 'Liityit kurssille.'));
	}
}
