<?php
class TestController extends BaseController {
	public static function create() {
		View::make('test/newtest.html');
	}
}
