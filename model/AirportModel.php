<?php

class AirportModel {
	public function getAllAirports($par1 = null)
	{
		$db = openDb();

		if ($par1 == "scheduledService") {
			$sth = $db->prepare("SELECT id, icao, name FROM airports WHERE scheduled_service LIKE '%yes%'");
		} else {
			$sth = $db->prepare("SELECT id, firstname, lastname FROM users");
		}

		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();
		return $result;
	}
}