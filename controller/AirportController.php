<?php
require ROOT . 'model/AirportModel.php';

class AirportController {
	public function index()
	{
		
	}
	public function chart()
	{
		$htmlentities["title"] = "Crew area";

		$airportModel = new AirportModel();
		$charts = $airportModel->getCharts();

		render("chartPage", array(
			'htmlentities' => $htmlentities
		));
	}
}
