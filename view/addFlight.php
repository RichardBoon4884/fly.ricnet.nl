<?php
	
?>
			<h2>Add flight</h2>
			<form method="post">
				<div>Airline:<br><select class="chosen-select" name="airliner">
					<option selected value></option>
<?php foreach ($airliners as $airliner): ?>
					<option value="<?php print $airliner["id"]?>"><?php print $airliner["icao"] . " - " . $airliner["name"]?></option>
<?php endforeach; ?>
				</select></div>
				<div>Flight number:<br><input type="number" name="flightnumber"></div><br>
				<div>From airport:<br><select class="chosen-select" name="from">
					<option selected value></option>
<?php foreach ($scheduledServicesAirports as $airports): ?>
					<option value="<?php print $airports["id"]?>"><?php print $airports["icao"] . " - " . $airports["name"]?></option>
<?php endforeach; ?>
				</select></div>
				<div>To airport:<br><select class="chosen-select" name="to">
					<option selected value></option>
<?php foreach ($scheduledServicesAirports as $airports): ?>
					<option value="<?php print $airports["id"]?>"><?php print $airports["icao"] . " - " . $airports["name"]?></option>
<?php endforeach; ?>
				</select></div><br>
				Aircraft: <input type="text" name="aircraft"><br>
				<div>PIC:<br><select class="chosen-select" name="pic">
					<option selected value></option>
<?php foreach ($activePilots as $pilots): ?>
					<option value="<?php print $pilots["id"]?>"><?php print $pilots["firstname"] . " " . $pilots["lastname"]?></option>
<?php endforeach; ?>
				</select></div>
				<div>First officer:<br><select class="chosen-select" name="firstOfficer">
					<option selected value></option>
<?php foreach ($activePilots as $pilots): ?>
					<option value="<?php print $pilots["id"]?>"><?php print $pilots["firstname"] . " " . $pilots["lastname"]?></option>
<?php endforeach; ?>
				</select></div>
				<div>Second officer:<br><select class="chosen-select" name="secondOfficer">
					<option selected value></option>
<?php foreach ($activePilots as $pilots): ?>
					<option value="<?php print $pilots["id"]?>"><?php print $pilots["firstname"] . " " . $pilots["lastname"]?></option>
<?php endforeach; ?>
				</select></div><br>
				Prepared by: <select class="chosen-select" name="preparedBy">
					<option selected value></option>
<?php foreach ($activeDispatchers as $pilots): ?>
					<option value="<?php print $pilots["id"]?>"><?php print $pilots["firstname"] . " " . $pilots["lastname"]?></option>
<?php endforeach; ?>
				</select><br>
				ATC route: <textarea name="atcRoute"></textarea><br>
				Release fuel: <input type="number" name="fuel"><br>
				<input type="submit" value="File flight">
			</form>
			<style type="text/css">
			form>div {
				display: inline-block;
			}
		</style>
		<script type="text/javascript">$(".chosen-select").chosen()</script>