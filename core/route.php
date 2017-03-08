<?php
function route()
{
	$url = splitUrl();
	if (!$url['controller']) {
		require(ROOT . 'controller/HomeController.php');
		$controller = new FlightController();
		call_user_func(array($controller, "index"));
	} elseif (file_exists(ROOT . 'controller/' . $url['controller'] . '.php')) {
		require(ROOT . 'controller/' . $url['controller'] . '.php');
		$controller = new $url['controller']();
		if (method_exists($controller, $url['action'])) {
			if (!empty($url['params'])) {
				call_user_func_array(array($controller, $url['action']), $url['params']);
			} else {
				call_user_func(array($controller, $url['action']));
			}
		} else {
			require(ROOT . 'controller/ErrorController.php');
			$controller = new ErrorController();
			call_user_func(array($controller, "error404"));
		}
	} else {
		require(ROOT . 'controller/ErrorController.php');
		$controller = new ErrorController();
		call_user_func(array($controller, "error404"));
	}
}
function splitUrl()
{
	if (isset($_GET['url'])) {
		$tmp_url = trim($_GET['url'], '/');
		$tmp_url = filter_var($tmp_url, FILTER_SANITIZE_URL);
		$tmp_url = explode('/', $tmp_url);
		$url['controller'] = isset($tmp_url[0]) ? ucwords($tmp_url[0] . 'Controller') : null;
		$url['action'] = isset($tmp_url[1]) ? $tmp_url[1] : 'index';
		unset($tmp_url[0], $tmp_url[1]);
		$url['params'] = array_values($tmp_url);
		return $url;
	}	
}