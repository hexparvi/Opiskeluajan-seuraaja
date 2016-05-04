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

$routes->get('/register', function() {
    UserController::create();
});

$routes->post('/register', function() {
    UserController::store();
});

// Muistiinpanojen reitit
$routes->get('/courses/:courseid/newnote', function($courseid) {
    NoteController::create();
});

$routes->post('/courses/newnote', function() {
    NoteController::store();
});

$routes->get('/courses/stats', function() {
    StatsController::show();
});

$routes->get('/courses/:courseid/editnote/:noteid', function($courseid, $noteid) {
    NoteController::edit($noteid);
});

$routes->post('/courses/:courseid/editnote/:noteid', function($courseid, $noteid) {
    NoteController::update($noteid, $courseid);
});

$routes->post('/courses/:courseid/destroynote/:noteid', function($courseid, $noteid) {
    NoteController::destroy($noteid, $courseid);
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

$routes->post('/courses/newtest', function() {
    TestController::store();
});

$routes->post('/courses/:courseid/destroytest/:testid', function($courseid, $testid) {
    TestController::destroy($testid, $courseid);
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

$routes->post('/joincourse', function() {
    CourseController::join();
});

$routes->post('/createcourse', function() {
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


