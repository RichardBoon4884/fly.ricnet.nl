<?php

class AirlinerModel {
	public function getAllAirliners() {
		$db = openDb();
		$sth = $db->prepare("SELECT id, icao, name FROM airlines");
		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();
		return $result;
	}
}