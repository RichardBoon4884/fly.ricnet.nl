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
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start();

$sql = "SELECT id, icao, name FROM airports WHERE scheduled_service LIKE '%yes%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if (isset($allAirports)) {
			$allAirports .= "<option value=\"" . $row["id"] . "\">" . $row["icao"] . " - " . $row["name"] . "</option>";
		} else {
			$allAirports = "<option value=\"" . $row["id"] . "\">" . $row["icao"] . " - " . $row["name"] . "</option>";
		}
	}
}

if (isset($_POST["airport"])) {
	$sql = "SELECT name, icao, file_location FROM charts WHERE icao LIKE '".$_POST["airport"]."'";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if (isset($airportsList) and $row["icao"] == $_POST["airport"]) {
				$airportsList .= "<a href=\"" . $row["file_location"] . "\" target=\"chartScreen\"><li>Chart: " . $row["name"] . "</li></a>";
			} else {
				$airportsList = "<a href=\"" . $row["file_location"] . "\" target=\"chartScreen\"><li>Chart: " . $row["name"] . "</li></a>";
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
		<?php include '../../chosen/chosen.php'; ?>
		<style>
			main>form {

			}
			main>iframe {
				position: absolute;
				right:0;
				top:35px;
				height: calc(100% - 35px);
				width: calc(100% - 575px);
				border: 0;
			}
		</style>
	</head>
	<body>
		<?php if (login_check($mysqli) == true) : ?>
		<?php include '../includes_pages/header.php'; ?>
		<?php include '../includes_pages/sideMenu.php'; ?>
		<main>
			<form method="post"><select class="chosen-select" name="airport"><?php echo $allAirports; ?></select><input type="submit" value="Search"></form>
			<?php 
				if (isset($airportsList)) {
					echo "<ul>" . $airportsList . "</ul>";
				}
			?>
			<iframe src="" name="chartScreen"></iframe>
		</main>
		<script type="text/javascript">$(".chosen-select").chosen()</script>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
			</p>
		<?php endif; ?>
	</body>
</html>