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
	public function getCharts($par1 = null) {
		$db = openDb();

		if (is_numeric($par1)) {
			$sth = $db->prepare("SELECT charts.icao, airports.icao as icaoName, file_location, charts.name, description FROM charts
            LEFT JOIN airports ON charts.icao = airports.id
            WHERE charts.icao LIKE :icao");
            $sth->bindParam(':icao', $par1);
		} elseif ($par1 != null) {
		    // TODO: Fix this SQL query.
            $sth = $db->prepare("SELECT charts.icao, airports.icao as icaoName, file_location, charts.name, description FROM charts
            LEFT JOIN airports ON charts.icao = airports.id
            WHERE charts.icaoName LIKE :icaoName");
            $sth->bindParam(':icaoName', $par1);
		} else {
			$sth = $db->prepare("SELECT charts.icao, airports.icao as icaoName, file_location, charts.name, description FROM charts
            LEFT JOIN airports ON charts.icao = airports.id");
		}

		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();
		return $result;
	}
	public function aiportWithCharts() {
        $db = openDb();

	    $sth = $db->prepare("SELECT charts.icao, airports1.icao as icaoName, airports2.name as name FROM charts
            LEFT JOIN airports airports1 ON charts.icao = airports1.id
            LEFT JOIN airports airports2 ON charts.icao = airports2.id
            GROUP BY charts.icao");

        $sth->execute();

        $result = $sth->fetchAll();
        $db = closeDb();
        return $result;
    }
}