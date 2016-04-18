<?php
class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $doom = new Course(array(
			'name' => 'd'
        ));
        $errors = $doom->errors();
        Kint::dump($errors);
    }
    
    public static function home() {
        View::make('suunnitelmat/home.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function stats() {
        View::make('suunnitelmat/stats.html');
    }

    public static function courselist() {
        View::make('suunnitelmat/courselist.html');
    }

    public static function course() {
        View::make('suunnitelmat/course.html');
    }

    public static function joincourse() {
        View::make('suunnitelmat/joincourse.html');
    }

    public static function newstudy() {
        View::make('suunnitelmat/newstudy.html');
    }

    public static function newtest() {
        View::make('suunnitelmat/newtest.html');
    }

    public static function edittest() {
        View::make('suunnitelmat/edittest.html');
    }

}
