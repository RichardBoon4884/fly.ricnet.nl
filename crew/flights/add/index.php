<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';

sec_session_start();

$sql = "SELECT id, firstname, lastname FROM users";
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
				echo "Test";
				$allUsersActive = "<option selected value=\"" . $row["id"] . " selected\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			} else {
				$allUsersActive = "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
			}
			$allUsers = "<option value=\"" . $row["id"] . "\">" . $row["firstname"] . " " .$row["lastname"] . "</option>";
		}
	}
}
$allUsersEmpty = "<option selected value></option>" . $allUsers;

if (isset($_POST["airliner"], $_POST["flightnumber"], $_POST["from"], $_POST["to"], $_POST["aircraft"], $_POST["pic"], $_POST["firstOfficer"], $_POST["secondOfficer"], $_POST["preparedBy"], $_POST["atcRoute"], $_POST["fuel"])) {
	$airliner = filter_input(INPUT_POST, 'airliner', FILTER_SANITIZE_STRING);
	$flightNumber = filter_input(INPUT_POST, 'flightnumber', FILTER_SANITIZE_NUMBER_INT);
	$fromAirport = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
	$toAirport = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);
	$aircraft = filter_input(INPUT_POST, 'aircraft', FILTER_SANITIZE_STRING);
	$pic = filter_input(INPUT_POST, 'pic', FILTER_SANITIZE_NUMBER_INT);
	$firstOfficer = filter_input(INPUT_POST, 'firstOfficer', FILTER_SANITIZE_NUMBER_INT);
	$secondOfficer = filter_input(INPUT_POST, 'secondOfficer', FILTER_SANITIZE_NUMBER_INT);
	$preparedBy = filter_input(INPUT_POST, 'preparedBy', FILTER_SANITIZE_NUMBER_INT);
	$atcRoute = filter_input(INPUT_POST, 'atcRoute', FILTER_SANITIZE_NUMBER_INT);
	$fuel = filter_input(INPUT_POST, 'fuel', FILTER_SANITIZE_NUMBER_INT);
};
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
			<form >
				Airline: <input type="text" name="airliner"><br>
				Flightnumber: <input type="number" name="flightnumber"><br>
				From airport: <input type="text" name="from"><br>
				To airport: <input type="text" name="to"><br>
				Aircraft: <input type="text" name="aircraft"><br>
				PIC: <select name="pic"><?php echo $allUsers; ?></select><br>
				First officer: <select name="firstOfficer"><?php echo $allUsersEmpty; ?></select><br>
				Second officer: <select name="secondOfficer"><?php echo $$allUsersEmpty; ?></select><br>
				Prepared by: <select name="preparedBy"><?php echo $allUsersActive; ?></select><br>
				ATC route: <textarea name="atcRoute"></textarea><br>
				Release fuel: <input type="number" name="fuel"><br>
				<input type="submit" value="File flight">
			</form>
		</main>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
			</p>
		<?php endif; ?>
	</body>
</html>