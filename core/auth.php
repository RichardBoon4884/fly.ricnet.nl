<?php

function checkIfLoggedIn()
{
	if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['loginString'], $_SESSION['type'])) {

		$db = openDb();
		$sth = $db->prepare("SELECT password FROM users WHERE id = :userId LIMIT 1");
		$sth->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT, 999);
		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();

		$check = hash('sha512', $result['password'] . $_SERVER['HTTP_USER_AGENT']);

		if ($check == $_SESSION['loginstring']) {
			return true;
		} else {
			return false;
		}
	}
}

function loginRequired()
{
	return checkIfLoggedIn();
}

function login($email, $password)
{
	$db = openDb();
	$sth = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
	$sth->bindParam(':email', $email, PDO::PARAM_STR, 50);
	$sth->execute();

	$result = $sth->fetchAll();
	$db = closeDb();

	if ($stmt->num_rows == 1) {
		$db_password = $result['password'];
		$password = hash('sha512', $result['password'] . $result['salt']);
		if ($db_password == $password) {
			foreach ($result as $key => $value) {
				if ($key != array('password', 'salt')) {
					$_SESSION[$key] = $value;
				}
			}
		} elseif ($db_password != $password) {
			// Wrong password
		} else {
			// Error
		}
	} else {
		// User not existing!
	}


}