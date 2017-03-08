<?php
require ROOT . 'model/FlightModel.php';

class FlightController {
	public function index() {
		$flights = call_user_func("FlightModel::getAllFlights");
		$htmlentities["title"] = "Crew area";
		include ROOT . 'view/_template/header.php';
		include ROOT . 'view/viewFlights.php';
		include ROOT . 'view/_template/footer.php';
	}

	public function listFlights() {
		
	}
}