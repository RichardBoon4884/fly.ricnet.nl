<?php

function openDb() {
	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);

	return $db;
}

function closeDb() {
	return null;
}

function render($filename, $data = null) 
{
	if ($data) {
		foreach ($data as $key => $value) {
			$$key = $value;
		}
	}
	require(ROOT . 'view/_template/header.php');
	require(ROOT . 'view/' . $filename . '.php');
	require(ROOT . 'view/_template/footer.php');
	http_response_code(200);
}

require ROOT . 'core/auth.php';