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
  
  $routes->get('/stats', function() {
    HelloWorldController::stats();
  });
  
  // Kokeiden reitit
  $routes->get('/edittest', function() {
    HelloWorldController::edittest();
  });
  
  $routes->get('/newtest', function() {
    HelloWorldController::newtest();
  });
  
  $routes->get('/newstudy', function() {
    HelloWorldController::newstudy();
  });
