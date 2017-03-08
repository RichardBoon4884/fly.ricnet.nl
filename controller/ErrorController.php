<?php

class ErrorController {
	public function index() 
	{
		http_response_code(500);
		echo "Unkown error";
	}
	public function error404() 
	{
		http_response_code(404);
		echo "404";
	}
}