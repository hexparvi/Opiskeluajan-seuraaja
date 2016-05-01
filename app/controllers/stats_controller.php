<?php
class StatsController extends BaseController {
		public static function show() {
			self::check_logged_in();
			View::make('stats.html');
		}
}
