<?php
require ROOT . 'model/FlightModel.php';
require ROOT . 'model/AirlinerModel.php';
require ROOT . 'model/AirportModel.php';
require ROOT . 'model/UserModel.php';

class FlightController {
	public function index() {
		$htmlentities["title"] = "Crew area";

		$flightModel = new FlightModel();
		$flights = $flightModel->getAllFlights();

		render("viewFlights", array(
			'htmlentities' => $htmlentities,
			'flights' => $flights
		));
	}

	public function add() {
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