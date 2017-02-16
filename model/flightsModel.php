<?php

include ROOT . 'config/database_connection.php';

class FlightModel {
	public function getAllFlights() {
		$db = openDb();
		$sth = $db->prepare("SELECT flights.id, airlines.icao AS airline, flights.flightnumber, flights.fromAirport, airports1.icao AS fromAirportIcao, flights.toAirport, airports2.icao AS toAirportIcao, flights.aircraft, flights.pic, usersPic.username as picUsername, flights.firstofficer, usersFirstofficer.username as firstofficerUsername, flights.secondofficer, usersSecondofficer.username as secondofficerUsername, flights.preparedby, usersPreparedby.username as preparedbyUsername, flights.atcroute, flights.releasefuel FROM flights
			INNER JOIN airlines ON flights.airline = airlines.id
			INNER JOIN airports airports1 ON flights.fromAirport = airports1.id
			INNER JOIN airports airports2 ON flights.toAirport = airports2.id
			INNER JOIN users usersPic ON flights.pic = usersPic.id
			LEFT JOIN users usersFirstofficer ON flights.firstofficer = usersFirstofficer.id
			LEFT JOIN users usersSecondofficer ON flights.secondofficer = usersSecondofficer.id
			LEFT JOIN users usersPreparedby ON flights.preparedby = usersPreparedby.id");
		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();
		return $result;
	}
}