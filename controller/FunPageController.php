<?php
class FunPageController {
	public function index() {
		echo "Try some HTTP status codes!";
	}
	public function code($code = null, $animal = "cat", $respond = "no") {
		if (file_exists(ROOT  . "public/img/funpages/code_" . $animal . "_" . $code . "-0.jpg")) {
			echo "<center><img src=\"/img/funpages/code_" . $animal . "_" . $code . "-0.jpg\"></center>";
			if ($animal == "cat") {
				echo "<center>Image by <a target=\"_BLANK\" href=\"https://www.flickr.com/photos/girliemac/albums/72157628409467125\">Tomomi</a></center>";
			} elseif ($animal == "dog") {
				echo "<center>Image by <a target=\"_BLANK\" href=\"https://httpstatusdogs.com/\">mikeleeorg</a></center>";
			}
			if ($respond == "yes") {
				http_response_code($code);
			}
			
		} else {
			echo "Nothing found, try something else!";
			http_response_code(404);
		}
	}
}