<?php
  
  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/home', function() {
    HelloWorldController::home();
  });
  
  $routes->get('/login', function() {
    UserController::login();
  });
  
  $routes->post('/login', function() {
    UserController::handle_login();
  });
  
  $routes->post('/logout', function() {
    UserController::logout(); 
  });
  
    // Muistiinpanojen reitit
  $routes->get('/courses/:id/newnote', function($id) {
    NoteController::create();
  });
  
  $routes->get('/courses/stats', function() {
    StatsController::show();
  });
  
  $routes->get('courses/:id/editnote', function() {
    
  });
	 
  $routes->post('/courses/:id/editnote', function() {
	
  });
  
  // Kokeiden reitit
  $routes->get('/courses/:courseid/edittest/:testid', function($courseid, $testid) {
    TestController::edit($testid);
  });
  
  $routes->post('/courses/:courseid/edittest/:testid', function($courseid, $testid) {
	TestController::update($testid, $courseid);
  });
  
  $routes->get('/courses/newtest', function() {
	TestController::create();
  });
  
  $routes->get('/courses/:id/newtest', function($id) {
    TestController::create();
  });
  
  $routes->post('/courses/:id/newtest', function() {
	 TestController::update();
  });
  
  // Opiskelusessioiden reitit
  $routes->get('/courses/:id/sessions', function($id) {
    StudyController::index($id);
  });
  
  $routes->get('/courses/newsession', function() {
	  StudyController::create();
  });
  
  $routes->post('/courses/newsession', function() {
    StudyController::store();
  });
  
  $routes->get('/courses/:id/newsession', function($id) {
    StudyController::create();
  });
  
  //Kurssien reitit
  $routes->get('/courses', function() {
    CourseController::index();
  });
  
  $routes->get('/courses/:id', function($id) {
    CourseController::show($id);
  });
  
  $routes->get('/joincourse', function() {
   CourseController::create();
  });
  
  $routes->post('/course', function() {
    CourseController::store();
  });
  
  $routes->get('/courses/:id/edit', function($id) {
    CourseController::edit($id);
  });
  
  $routes->post('/courses/:id/edit', function($id) {
    CourseController::update($id);
  });
  
  $routes->post('/courses/:id/destroy', function($id) {
    CourseController::destroy($id);
  });
  
  $routes->get('/courses/1/edittest', function() {
    HelloWorldController::edittest();
  });
  

