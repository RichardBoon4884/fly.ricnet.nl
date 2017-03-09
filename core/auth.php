<?php
function checkIfLoggedIn()
{
	session_start();

	if (isset($_SESSION['id'], $_SESSION['username'], $_SESSION['loginString'], $_SESSION['type'])) {

		$db = openDb();
		$sth = $db->prepare("SELECT password FROM users WHERE id = :userId LIMIT 1");
		$sth->bindParam(':userId', $_SESSION['id'], PDO::PARAM_INT, 999);
		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();

		$result = $result[0];

		$check = hash('sha512', $result['password'] . $_SERVER['HTTP_USER_AGENT']);

		if ($check == $_SESSION['loginString']) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function loginRequired()
{
	if (checkIfLoggedIn()) {
		return true;
	} else {
		// require(ROOT . 'controller/HomeController.php');
		// $controller = new HomeController();
		// call_user_func(array($controller, "index"));

		header("Location: /");

		die();
	}
}

function login($email, $password)
{
	if (checkIfLoggedIn()) {
		return true;
	}

	$db = openDb();
	$sth = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
	$sth->bindParam(':email', $email, PDO::PARAM_STR, 50);
	$sth->execute();

	$result = $sth->fetchAll();
	$db = closeDb();

	if (count($result) == 1) {
		$result = $result[0];

		$db_password = $result['password'];
		$password = hash('sha512', $password . $result['salt']);
		$loginString = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);

		if ($db_password == $password) {
			foreach ($result as $key => $value) {
				if (is_numeric($key)) {
					
				} elseif (in_array($key, array("password", "salt"))) {

				} else {
					$_SESSION[$key] = $value;
				}
			}

			$_SESSION['loginString'] = $loginString;
			return true;
		} elseif ($db_password != $password) {
			// Wrong password
			return array(false, "wrongPassword");
		} else {
			// Error
			return array(false, "error");
		}
	} else {
		// User not existing!
		return array(false, "noUser");
	}


}