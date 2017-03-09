
		<form method="post"><select class="chosen-select" name="airport"><?php echo $allAirports; ?></select><input type="submit" value="Search"></form>
			<?php 
				if (isset($airportsList)) {
					echo "<nav class=\"list charts\"><ul>" . $airportsList . "</ul></nav>";
					echo "<iframe src=\"\" name=\"chartScreen\"></iframe>";
				}
			?>
		</main>