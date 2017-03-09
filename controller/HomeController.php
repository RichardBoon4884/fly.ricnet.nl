<?php
class HomeController {
	public function index() {
		if (isset($_POST['email'], $_POST['p'])) {
			login($_POST['email'], $_POST['p']);
		}
		include ROOT . 'view/login/index.php';
	}
}