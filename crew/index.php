<?php
/**
 * Copyright (C) 2013 peredur.net
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

$sql = "SELECT flights.id, airlines.icao AS airline, flights.flightnumber, flights.fromAirport, airports1.icao AS fromAirportIcao, flights.toAirport, airports2.icao AS toAirportIcao, flights.aircraft, flights.pic, usersPic.username as picUsername, flights.firstofficer, usersFirstofficer.username as firstofficerUsername, flights.secondofficer, usersSecondofficer.username as secondofficerUsername, flights.preparedby, usersPreparedby.username as preparedbyUsername, flights.atcroute, flights.releasefuel FROM flights
INNER JOIN airlines ON flights.airline = airlines.id
INNER JOIN airports airports1 ON flights.fromAirport = airports1.id
INNER JOIN airports airports2 ON flights.toAirport = airports2.id
INNER JOIN users usersPic ON flights.pic = usersPic.id
LEFT JOIN users usersFirstofficer ON flights.firstofficer = usersFirstofficer.id
LEFT JOIN users usersSecondofficer ON flights.secondofficer = usersSecondofficer.id
LEFT JOIN users usersPreparedby ON flights.preparedby = usersPreparedby.id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["preparedbyUsername"] != "") {
			$preparedby = "<div>Prepared by " . $row["preparedbyUsername"] . ".</div>";
		} else {
			$preparedby = "";
		}
		if (isset($flights)) {
			$flights .= "<a href=\"?flight=" . $row["id"] . "\"><li class=\"box\" id=\"" . $row["id"] . "\"><div class=\"chartName\">" . $row["airline"] . " " . $row["flightnumber"] . "</div><div  class=\"chartDescription\">" . $row["fromAirportIcao"] . " > " . $row["toAirportIcao"] . "</div>" . $preparedby . "</li></a>";
		} else {
			$flights = "<a href=\"?flight=" . $row["id"] . "\"><li class=\"box\" id=\"" . $row["id"] . "\"><div class=\"chartName\">" . $row["airline"] . " " . $row["flightnumber"] . "</div><div  class=\"chartDescription\">" . $row["fromAirportIcao"] . " > " . $row["toAirportIcao"] . "</div>" . $preparedby . "</li></a>";
		}
	}
}

$requestedFlight = filter_input(INPUT_GET, 'flight', $filter = FILTER_SANITIZE_STRING);

if (is_numeric($requestedFlight)) {
	$sql = "SELECT flights.id, airlines.icao AS airline, flights.flightnumber, flights.fromAirport, airports1.icao AS fromAirportIcao, flights.toAirport, airports2.icao AS toAirportIcao, flights.aircraft, flights.pic, usersPic.username as picUsername, flights.firstofficer, usersFirstofficer.username as firstofficerUsername, flights.secondofficer, usersSecondofficer.username as secondofficerUsername, flights.preparedby, usersPreparedby.username as preparedbyUsername, flights.atcroute, flights.releasefuel FROM flights
	INNER JOIN airlines ON flights.airline = airlines.id
	INNER JOIN airports airports1 ON flights.fromAirport = airports1.id
	INNER JOIN airports airports2 ON flights.toAirport = airports2.id
	INNER JOIN users usersPic ON flights.pic = usersPic.id
	LEFT JOIN users usersFirstofficer ON flights.firstofficer = usersFirstofficer.id
	LEFT JOIN users usersSecondofficer ON flights.secondofficer = usersSecondofficer.id
	LEFT JOIN users usersPreparedby ON flights.preparedby = usersPreparedby.id
	WHERE flights.id = '".$requestedFlight."'";

	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["id"] == $requestedFlight) {
				$flightId = $row["id"];
				$flightAirline = $row["airline"];
				$flightNumber = $row["flightnumber"];
				$flightFromAirport = $row["fromAirport"];
				$flightFromAirportIcao = $row["fromAirportIcao"];
				$flightToAirport = $row["toAirport"];
				$flightToAirportIcao = $row["toAirportIcao"];
				$flightAircraft = $row["aircraft"];
				$flightPic = $row["pic"];
				$flightPicUsername = $row["picUsername"];
				$flightFirstOfficer = $row["firstofficer"];
				$flightFirstOfficerUsername = $row["firstofficerUsername"];
				$flightSecondOfficer = $row["secondofficer"];
				$flightSecondOfficerUsername = $row["secondofficerUsername"];
				$flightPreparedby = $row["preparedby"];
				$flightPreparedbyUsername = $row["preparedbyUsername"];
				$flightAtcRoute = $row["atcroute"];
				$flightReleaseFuel = $row["releasefuel"];
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ricnet Fly - Crew area</title>
		<link rel="stylesheet" href="/crew/styles/main.css" />
	</head>
	<body>
		<?php if (login_check($mysqli) == true) : ?>
        <?php include '/includes_pages/header.php'; ?>
        <?php include '/includes_pages/sideMenu.php'; ?>
        <main>
			<?php 
				if (isset($flights)) {
					echo "<nav class=\"list charts\"><ul>" . $flights . "</ul></nav>";
				}
			?>
			<?php if (is_numeric($requestedFlight)) :?>
			<aside>
				<h2><?php echo $flightAirline . " " . $flightNumber; ?></h2>
				<div><?php echo $flightFromAirportIcao . " > " . $flightToAirportIcao; ?></div>
			</aside>
			<?php endif; ?>
        </main>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
			</p>
		<?php endif; ?>
	</body>
</html>