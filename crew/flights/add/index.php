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
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';

sec_session_start();

$sql = "SELECT id, firstname, lastname FROM users";
$result = $mysqli->query($sql);

$result = $mysqli->query($sql);

$allUsers;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if (isset($allUsers)) {
			$allUsers += '<option value="'.$row["id"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
		} else {
			$allUsers = '<option value="'.$row["id"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
		}
		echo 'id: ' . $row["id"]. ', Name: ' . $row["firstname"]. ' ' . $row["lastname"]. '<br>';
	}
}
echo $allUsers;
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
		<?php include '../../includes_pages/header.php'; ?>
		<?php include '../../includes_pages/sideMenu.php'; ?>
		<main>
			<h2>Add flight</h2>
			<form>
				Airline: <input type="text" name="airliner"><br>
				Flightnumber: <input type="number" name="flightnumber"><br>
				From airport: <input type="text" name="from"><br>
				To airport: <input type="text" name="to"><br>
				Aircraft: <input type="text" name="aircraft"><br>
				PIC: <select type="text" name="pic"><?php echo $allUsers; ?></select><br>
				First officer: <select type="text" name="firstOfficer"><?php echo $allUsers; ?></select><br>
				Second officer: <select type="text" name="secondOfficer"><?php echo $allUsers; ?></select><br>
				Prepared by: <select type="text" name="preparedBy"><?php echo $allUsers; ?></select><br>
				ATC route: <textarea name="atcRoute"></textarea><br>
				Release fuel: <input type="number" name="fuel">
			</form>
		</main>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
			</p>
		<?php endif; ?>
	</body>
</html>