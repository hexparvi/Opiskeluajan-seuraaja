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
    HelloWorldController::login();
  });
  
  $routes->get('/courses', function() {
    CourseController::index();
  });
  
  $routes->get('/courses/:id', function($id) {
    CourseController::show($id);
  });
  
  $routes->post('/course', function() {
    CourseController::store();
  });
  
  $routes->get('/courses/1/edittest', function() {
    HelloWorldController::edittest();
  });
  
  $routes->get('/joincourse', function() {
   CourseController::create();
  });
  
  $routes->get('/stats', function() {
    HelloWorldController::stats();
  });
  
  $routes->get('/edittest', function() {
    HelloWorldController::edittest();
  });
  
  $routes->get('/newtest', function() {
    HelloWorldController::newtest();
  });
  
  $routes->get('/newstudy', function() {
    HelloWorldController::newstudy();
  });
