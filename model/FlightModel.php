<?php

ini_set('xdebug.var_display_max_depth', 50000);
ini_set('xdebug.var_display_max_children', 256000);
ini_set('xdebug.var_display_max_data', 1024000);

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

    public function getFlight($id) {
        $db = openDb();

        $sth = $db->prepare("SELECT flights.id, airlines.icao AS airline, flights.flightnumber, flights.fromAirport, airports1.icao AS fromAirportIcao, airports1Name.name as fromAirportName ,airports1Municipality.municipality as fromAirportMunicipality, airports1CountryCode.iso_country as fromAirportCountryCode, airports1Latitude.latitude AS fromAirportLatitude, airports1Longitude.longitude AS fromAirportLongitude, flights.toAirport, airports2.icao AS toAirportIcao, airports2Name.name as toAirportName, airports2Municipality.municipality as toAirportMunicipality, airports2CountryCode.iso_country as toAirportCountryCode, airports2Latitude.latitude as toAirportLatitude, airports2Longitude.longitude as toAirportLongitude, flights.aircraft, flights.pic, usersPic.username as picUsername, flights.firstofficer, usersFirstofficer.username as firstofficerUsername, flights.secondofficer, usersSecondofficer.username as secondofficerUsername, flights.preparedby, usersPreparedby.username as preparedbyUsername, flights.atcroute, flights.releasefuel FROM flights
            INNER JOIN airlines ON flights.airline = airlines.id
            INNER JOIN airports airports1 ON flights.fromAirport = airports1.id
            INNER JOIN airports airports1Name ON flights.fromAirport = airports1Name.id
            INNER JOIN airports airports1Municipality ON flights.fromAirport = airports1Municipality.id
            INNER JOIN airports airports1CountryCode ON flights.fromAirport = airports1CountryCode.id
            INNER JOIN airports airports1Latitude ON flights.fromAirport = airports1Latitude.id
            INNER JOIN airports airports1Longitude ON flights.fromAirport = airports1Longitude.id
            INNER JOIN airports airports2 ON flights.toAirport = airports2.id
            INNER JOIN airports airports2Name ON flights.toAirport = airports2Name.id
            INNER JOIN airports airports2Municipality ON flights.toAirport = airports2Municipality.id
            INNER JOIN airports airports2CountryCode ON flights.toAirport = airports2CountryCode.id
            INNER JOIN airports airports2Latitude ON flights.toAirport = airports2Latitude.id
            INNER JOIN airports airports2Longitude ON flights.toAirport = airports2Longitude.id
            INNER JOIN users usersPic ON flights.pic = usersPic.id
            LEFT JOIN users usersFirstofficer ON flights.firstofficer = usersFirstofficer.id
            LEFT JOIN users usersSecondofficer ON flights.secondofficer = usersSecondofficer.id
            LEFT JOIN users usersPreparedby ON flights.preparedby = usersPreparedby.id
            WHERE flights.id = :requestedFlight
            LIMIT 1");
        $sth->bindParam(':requestedFlight', $id, PDO::PARAM_STR);

        $sth->execute();

        $result = $sth->fetch();
        $db = closeDb();
        return $result;
    }

    public function addFlight($airlinerId, $flightNumber, $fromAirportId, $toAirportId, $aircraft, $picId, $firstOfficerId = null, $secondOfficerId = null, $preparedById, $atcRoute, $fuel) {
        try {
            $db = openDb();
            $sth = $db->prepare("INSERT INTO flights (
				`airline`,
				`flightnumber`,
				`fromAirport`,
				`toAirport`,
				`aircraft`,
				`pic`,
				`firstofficer`,
				`secondofficer`,
				`preparedby`,
				`preparedat`,
				`atcroute`,
				`releasefuel`)
				VALUES (
				:airlinerId,
				:flightNumber,
				:fromAirportId,
				:toAirportId,
				:aircraft,
				:picId,
				:firstOfficerId,
				:secondOfficerId,
				:preparedById,
				NOW(),
				:atcRoute,
				:fuel)");
            $sth->bindParam(':airlinerId', $airlinerId);
            $sth->bindParam(':flightNumber', $flightNumber);
            $sth->bindParam(':fromAirportId', $fromAirportId);
            $sth->bindParam(':toAirportId', $toAirportId);
            $sth->bindParam(':aircraft', $aircraft);
            $sth->bindParam(':picId', $picId);
            $sth->bindParam(':firstOfficerId', $firstOfficerId);
            $sth->bindParam(':secondOfficerId', $secondOfficerId);
            $sth->bindParam(':preparedById', $preparedById);
            $sth->bindParam(':atcRoute', $atcRoute);
            $sth->bindParam(':fuel', $fuel);

            $succes = $sth->execute();

            $lastId = $db->lastInsertId();

            $result = $sth->fetchAll();

            $db = closeDb();

            if ($succes == true) {
                return $lastId;
            } else {
                return false;
            }
        }
        catch(PDOException $e)
        {
            exit($e->getMessage());
            return 0;

        }
    }
}