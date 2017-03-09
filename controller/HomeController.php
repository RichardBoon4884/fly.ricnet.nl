<?php
class HomeController {
	public function index() {
		if (checkIfLoggedIn()) {
			header("Location: /flight");
		}
		if (isset($_POST['email'], $_POST['p'])) {
			if (login($_POST['email'], $_POST['p'])) {
				header("Location: /flight");
			}
		}
		include ROOT . 'view/login/index.php';
	}
	public function logout() {
		loginRequired();
		session_unset();
		session_destroy();
		header("Location: /");
	}
}