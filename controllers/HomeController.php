<?php
class HomeController {
	public function before() {
		
	}
	
	public function index() {
		$user = UserModel::get(2);
		$view = new View('home');
		$view->assign('user', $user);
		$view->show();
	}
}