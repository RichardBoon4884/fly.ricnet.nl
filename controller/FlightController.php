<?php
require ROOT . 'model/FlightModel.php';
require ROOT . 'model/AirlinerModel.php';
require ROOT . 'model/AirportModel.php';
require ROOT . 'model/UserModel.php';

class FlightController {
	public function index() {
		$this->view();
	}

	public function view($id = null) {
		loginRequired();

		$htmlentities["title"] = "Crew area";

		$flightModel = new FlightModel();
		$flights = $flightModel->getAllFlights();
        $flightInfo = isset($id) ? $flightModel->getFlight($id) : null;

		render("viewFlights", array(
			'htmlentities' => $htmlentities,
			'flights' => $flights,
			'flightInfo' => $flightInfo,
			'id' => $id
		));
	}

	public function add() {
		loginRequired();

		if (isset($_POST["airliner"], $_POST["flightnumber"], $_POST["from"], $_POST["to"], $_POST["aircraft"], $_POST["pic"], $_POST["preparedBy"], $_POST["atcRoute"], $_POST["fuel"])) {
			$flightModel = new FlightModel();

			$airlinerId = filter_input(INPUT_POST, 'airliner', FILTER_SANITIZE_STRING);
			$flightNumber = filter_input(INPUT_POST, 'flightnumber', FILTER_SANITIZE_NUMBER_INT);
			$fromAirportId = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
			$toAirportId = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);
			$aircraft = filter_input(INPUT_POST, 'aircraft', FILTER_SANITIZE_STRING);
			$picId = filter_input(INPUT_POST, 'pic', FILTER_SANITIZE_NUMBER_INT);
			$firstOfficerId = filter_input(INPUT_POST, 'firstOfficer', FILTER_SANITIZE_NUMBER_INT);
			$secondOfficerId = filter_input(INPUT_POST, 'secondOfficer', FILTER_SANITIZE_NUMBER_INT);
			$preparedById = filter_input(INPUT_POST, 'preparedBy', FILTER_SANITIZE_NUMBER_INT);
			$atcRoute = htmlspecialchars($_POST["atcRoute"]);
			// $atcRoute = filter_input(INPUT_POST, 'atcRoute', FILTER_SANITIZE_STRING);
			$fuel = filter_input(INPUT_POST, 'fuel', FILTER_SANITIZE_NUMBER_INT);

			$id = $flightModel->addFlight($airlinerId, $flightNumber, $fromAirportId, $toAirportId, $aircraft, $picId, $firstOfficerId, $secondOfficerId, $preparedById, $atcRoute, $fuel);

			if (is_numeric($id)) {
				header("Location: /flight/view/" . $id);
			} else {
				echo "Error";
			}
		}

		$htmlentities["title"] = "Crew area";

		$airlinerModel = new AirlinerModel();
		$airliners = $airlinerModel->getAllAirliners();

		$airportModel = new AirportModel();
		$scheduledServicesAirports = $airportModel->getAllAirports("scheduledService");

		$userModel = new UserModel();
		$activePilots = $userModel->getAllUsers("activePilots");
		$activeDispatchers = $userModel->getAllUsers("activeDispatchers");

		render("addFlight", array(
			'htmlentities' => $htmlentities,
			'activePilots' => $activePilots,
			'activeDispatchers' => $activeDispatchers,
			'scheduledServicesAirports' => $scheduledServicesAirports,
			'airliners' => $airliners
		));
	}
}