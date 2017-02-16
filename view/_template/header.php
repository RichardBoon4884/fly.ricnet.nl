<?php 
include_once ROOT . 'includes/db_connect.php';
include_once ROOT . 'includes/functions.php';
sec_session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ricnet Fly - <?php print $htmlentities["title"] ?></title>
		<link rel="stylesheet" href="/styles/main_crew.css" />
	</head>
	<body>
		<header>
			<h1>Ricnet Fly</h1>
			<nav>
				<ul>
					<?php if ($_SESSION['type'] == 'administrator') {echo '<li><a id="admin" href="/crew/admin">Admin area</a></li>';} ?>
					<li><a id="logout" href="/logout.php">log out</a></li>
					<li><span><?php echo htmlentities($_SESSION['firstname']); ?> (<?php echo htmlentities($_SESSION['type']); ?>)</span></li>
				</ul>
			</nav>
		</header>
			<nav id="sideMenu">
				<ul>
					<li><a href="/crew-mvc">Overview</a></li>
					<li><a href="/crew/flights/add">Add a flight</a></li>
					<li><a href="/crew/charts">Charts</a></li>
				</ul>
			</nav>
		<main>