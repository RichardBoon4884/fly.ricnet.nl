<?php 

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ricnet Fly - <?php print $htmlentities["title"] ?></title>
		<link rel="stylesheet" href="/styles/main_crew.css" />
		<link rel="stylesheet" href="/chosen/chosen.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js" type="text/javascript"></script>
		<script src="/chosen/chosen.jquery.js" type="text/javascript"></script>
	</head>
	<body>
		<header>
			<h1>Ricnet Fly</h1>
			<nav>
				<ul>
					<?php if ($_SESSION['type'] == 'administrator') {echo '<li><a id="admin" href="#">Admin area</a></li>';} ?>
					<li><a id="logout" href="/home/logout">log out</a></li>
					<li><span><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> (<?php echo $_SESSION['type']; ?>)</span></li>
				</ul>
			</nav>
		</header>
			<nav id="sideMenu">
				<ul>
					<li><a href="/flight">Overview</a></li>
					<li><a href="/flight/add">Add a flight</a></li>
					<li><a href="/airport/chart">Charts</a></li>
				</ul>
			</nav>
		<main>