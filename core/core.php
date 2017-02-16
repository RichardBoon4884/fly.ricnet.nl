<?php

function openDb() {
	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);

	return $db;
}

function closeDb() {
	return null;
}