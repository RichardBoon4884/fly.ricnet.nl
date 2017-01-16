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

$sql = "SELECT flights.id, airlines.icao AS airline, flights.flightnumber, airports.icao AS fromAirport, flights.toAirport, flights.aircraft, flights.pic, flights.firstofficer, flights.secondofficer, flights.preparedby, flights.atcroute, flights.releasefuel FROM flights INNER JOIN airlines ON flights.airline = airlines.id INNER JOIN airports ON flights.fromAirport = airports.id ";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {


		if (isset($flights)) {
			$flights .= "<a href=\"?flight=" . $row["id"] . "\"><li class=\"box\" id=\"" . $row["id"] . "\"><div class=\"chartName\">" . $row["airline"] . " " . $row["flightnumber"] . "</div><div  class=\"chartDescription\">" . $row["fromAirport"] . " > ??</div></li></a>";
		} else {
			$flights = "<a href=\"?flight=" . $row["id"] . "\"><li class=\"box\" id=\"" . $row["id"] . "\"><div class=\"chartName\">" . $row["airline"] . " " . $row["flightnumber"] . "</div><div  class=\"chartDescription\">" . $row["fromAirport"] . " > ??</div></li></a>";
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
        </main>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
			</p>
		<?php endif; ?>
	</body>
</html>