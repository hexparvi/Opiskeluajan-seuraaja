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
    HelloWorldController::courselist();
  });
  
  $routes->get('/courses/1', function() {
    HelloWorldController::course();
  });
  
  $routes->get('/courses/1/edittest', function() {
    HelloWorldController::edittest();
  });
  
  $routes->get('/joincourse', function() {
    HelloWorldController::joincourse();
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
