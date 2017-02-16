<?php
require ROOT . 'model/flightsModel.php';

class FlightsController {
	public function redirect($location) {
		header('Location: '.$location);
	}

	public function __construct() {
		$this->flightModel = new FlightModel();
	}
	
	public function handleRequest() {
		$url = isset($_GET['url'])?$_GET['url']:NULL;
		$page = explode("/", $url);
		try {
			if ( !$url || $page[0] == 'index' ) {
				$this->index();
			} elseif ( $page[0] == 'crew' || $page[0] == 'crew-mvc' ) {
				$this->listFlights();
			} elseif ( $url == 'delete' ) {
				$this->deleteContact();
			} elseif ( $url == 'show' ) {
				$this->showContact();
			} else {
				// $this->showError("Page not found", "Page for pageeration ".$url." was not found!");
			}
		} catch ( Exception $e ) {
			// some unknown Exception got through here, use application error url to display it
			// $this->showError("Application error", $e->getMessage());
		}
	}

	public function index() {
		include ROOT . 'view/login/index.php';
	}

	public function listFlights() {
		$flights = $this->flightModel->getAllFlights();
		$htmlentities["title"] = "Crew area";
		include ROOT . 'view/_template/header.php';
		include ROOT . 'view/viewFlights.php';
		include ROOT . 'view/_template/footer.php';
	}
}