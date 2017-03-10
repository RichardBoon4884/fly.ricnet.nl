
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
			<?php var_dump($flight); ?>
<?php if (isset($id)) : ?>
				<h2><?php echo $flight['airline'] . " " . $flight['flightnumber']; ?></h2>
				<div><?php echo $flight['fromAirportIcao'] . " > " . $flight['toAirportIcao']; ?></div>
			</aside>
<?php endif; ?>