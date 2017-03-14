
			<nav class="list charts">
				<ul>
<?php foreach ($flights as $flight): ?>
					<a href="/flight/view/<?php print $flight["id"]; ?>"><li class="box" id="<?php print $flight["id"]; ?>">
						<div class="chartName"><?php print $flight["airline"] . " " . $flight["flightnumber"]; ?></div><div  class="chartDescription"><?php print $flight["fromAirportIcao"]; ?> > <?php print $flight["toAirportIcao"]; ?></div><div>Prepared by <?php print $flight["preparedbyUsername"]; ?>.</div>
					</li></a>
<?php endforeach; ?>
				</ul>
			</nav>
			<aside>
<?php if (isset($id)) : ?>
				<h2><?php echo $flightInfo['airline'] . " " . $flightInfo['flightnumber']; ?></h2>
				<div><?php echo $flightInfo['fromAirportIcao'] . " > " . $flightInfo['toAirportIcao']; ?></div>
			</aside>
<?php endif; ?>