
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
                <div id="mapid" style="height: 500px;"></div>
				<h2><?php echo $flightInfo['airline'] . " " . $flightInfo['flightnumber']; ?></h2>
				<div><?php echo $flightInfo['fromAirportIcao'] . " > " . $flightInfo['toAirportIcao']; ?></div>
                <script>var mymap = L.map('mapid').setView([51.505, -0.09], 13);</script>
			</aside>
<?php endif; ?>