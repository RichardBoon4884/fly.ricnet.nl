
			<nav class="list charts">
				<ul>
<?php foreach ($flights as $flight): ?>
					<a href="#"><li class="box" id="<?php print $flight["id"]; ?>">
						<div class="chartName"><?php print $flight["airline"] . " " . $flight["flightnumber"]; ?></div><div  class="chartDescription"><?php print $flight["fromAirportIcao"]; ?> > <?php print $flight["toAirportIcao"]; ?></div><div>Prepared by <?php print $flight["preparedbyUsername"]; ?>.</div>
					</li></a>
<?php endforeach; ?>
				</ul>
			</nav>