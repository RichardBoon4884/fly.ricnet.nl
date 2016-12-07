<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';

sec_session_start();

$sql = "SELECT id, firstname, lastname FROM users WHERE `active_pilot` = 1";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if (isset($allUsers)) {
			if ($row["id"] == $_SESSION['user_id']) {
				$allUsersActive .= "<option selected value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			} else {
				$allUsersActive .= "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			}
			$allUsers .= "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
		} else {
			if ($row["id"] == $_SESSION['user_id']) {
				$allUsersActive = "<option selected value=\"" . $row["id"] . " selected\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			} else {
				$allUsersActive = "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			}
			$allUsers = "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
		}
	}
}
$allUsersEmpty = "<option selected value></option>" . $allUsers;

$sql = "SELECT id, firstname, lastname FROM users WHERE `active_dispatcher` = 1";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if (isset($allUsersActivePrepare)) {
			if ($row["id"] == $_SESSION['user_id']) {
				$allUsersActivePrepare .= "<option selected value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			} else {
				$allUsersActivePrepare .= "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			}
		} else {
			if ($row["id"] == $_SESSION['user_id']) {
				$allUsersActivePrepare = "<option selected value=\"" . $row["id"] . " selected\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			} else {
				$allUsersActivePrepare = "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			}
		}
	}
}

$sql = "SELECT id, icao, name FROM airlines";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if (isset($allAirlines)) {
			$allAirlines .= "<option value=\"" . $row["id"] . "\">" . $row["icao"] . " - " . $row["name"] . "</option>";
		} else {
			$allAirlines = "<option value=\"" . $row["id"] . "\">" . $row["icao"] . " - " . $row["name"] . "</option>";
		}
	}
}

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

if (isset($_POST["airliner"], $_POST["flightnumber"], $_POST["from"], $_POST["to"], $_POST["aircraft"], $_POST["pic"], $_POST["preparedBy"], $_POST["atcRoute"], $_POST["fuel"])) {
	$airlinerId = filter_input(INPUT_POST, 'airliner', FILTER_SANITIZE_STRING);
	$flightNumber = filter_input(INPUT_POST, 'flightnumber', FILTER_SANITIZE_NUMBER_INT);
	$fromAirportId = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
	$toAirportId = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);
	$aircraft = filter_input(INPUT_POST, 'aircraft', FILTER_SANITIZE_STRING);
	$picId = filter_input(INPUT_POST, 'pic', FILTER_SANITIZE_NUMBER_INT);
	$firstOfficerId = filter_input(INPUT_POST, 'firstOfficer', FILTER_SANITIZE_NUMBER_INT);
	$secondOfficerId = filter_input(INPUT_POST, 'secondOfficer', FILTER_SANITIZE_NUMBER_INT);
	$preparedById = filter_input(INPUT_POST, 'preparedBy', FILTER_SANITIZE_NUMBER_INT);
	$atcRoute = filter_input(INPUT_POST, 'atcRoute', FILTER_SANITIZE_NUMBER_INT);
	$fuel = filter_input(INPUT_POST, 'fuel', FILTER_SANITIZE_NUMBER_INT);
};
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ricnet Fly - Crew area</title>
		<link rel="stylesheet" href="/crew/styles/main.css">
		<?php include '../../../chosen/chosen.php'; ?>
		<style type="text/css">
			form>div {
				display: inline-block;
			}
		</style>
	</head>
	<body>
		<?php if (login_check($mysqli) == true) : ?>
		<?php include '../../includes_pages/header.php'; ?>
		<?php include '../../includes_pages/sideMenu.php'; ?>
		<main>
			<h2>Add flight</h2>
			<form method="post">
				<div>Airline:<br><select class="chosen-select" name="airliner"><?php echo $allAirlines; ?></select></div><div>Flight number:<br><input type="number" name="flightnumber"></div><br>
				<div>From airport:<br><select class="chosen-select" name="from"><?php echo $allAirports; ?></select></div><div>To airport:<br><select class="chosen-select" name="to"><?php echo $allAirports; ?></select></div><br>
				Aircraft: <input type="text" name="aircraft"><br>
				<div>PIC:<br><select class="chosen-select" name="pic"><?php echo $allUsers; ?></select></div><div>First officer:<br><select class="chosen-select" name="firstOfficer"><?php echo $allUsersEmpty; ?></select></div><div>Second officer:<br><select class="chosen-select" name="secondOfficer"><?php echo $allUsersEmpty; ?></select></div><br>
				Prepared by: <select class="chosen-select" name="preparedBy"><?php echo $allUsersActivePrepare; ?></select><br>
				ATC route: <textarea name="atcRoute"></textarea><br>
				Release fuel: <input type="number" name="fuel"><br>
				<input type="submit" value="File flight">
			</form>
		</main>
		<script type="text/javascript">$(".chosen-select").chosen()</script>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
			</p>
		<?php endif; ?>
	</body>
</html>