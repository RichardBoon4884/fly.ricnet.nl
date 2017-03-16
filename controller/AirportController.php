<?php
require ROOT . 'model/AirportModel.php';

class AirportController {
	public function index()
	{
		
	}
	public function chart($par1 = null)
	{
		loginRequired();
		
		$htmlentities["title"] = "Crew area";
        $htmlentities["headAtr"] = "<link rel=\"stylesheet\" href=\"/chosen/chosen.css\">\n		<script src=\"/chosen/chosen.jquery.js\" type=\"text/javascript\"></script>";

		$airportModel = new AirportModel();
        $aiportWithCharts = $airportModel->aiportWithCharts();
        $charts =  isset($par1) ? $airportModel->getCharts($par1) : null;

		render("chartPage", array(
			'htmlentities' => $htmlentities,
            'aiportWithCharts' => $aiportWithCharts,
            'charts' => $charts,
            'airportId' => $par1
		));
	}
}
