<?php 
function error($type, $errorMsg) {
	if ($type == 'critical') {
		echo "Critical Error: " . $errorMsg;
		echo "<script>console.log(\"%cCritical Error: " . $errorMsg . "\", \"color: red\");</script>";
		exit();
	} elseif ($type == 'warning') {
		echo "<script>console.log(\"%c" . $errorMsg . "\", \"color: orange\");</script>";
	};

};