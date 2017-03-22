
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
                <script>

var mymap = L.map('mapid').setView([<?php print $flightInfo["fromAirportLatitude"]; ?>, <?php print $flightInfo["fromAirportLongitude"]; ?>], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/richardboon4884/cj0jbos6a00j42spdfiduad4n/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmljaGFyZGJvb240ODg0IiwiYSI6ImNqMGpiOWpqbTAwMW0zM3BtdWk2Z3ptYTYifQ.LtjlK_yXDQLgtutFAtqt2w', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'cj0jbcqtj00162ppkhiy0tsl4',
    accessToken: 'pk.eyJ1IjoicmljaGFyZGJvb240ODg0IiwiYSI6ImNqMGpiOWpqbTAwMW0zM3BtdWk2Z3ptYTYifQ.LtjlK_yXDQLgtutFAtqt2w'
}).addTo(mymap)

var fromAirport = L.marker([<?php print $flightInfo["fromAirportLatitude"]; ?>, <?php print $flightInfo["fromAirportLongitude"]; ?>]).addTo(mymap);
fromAirport.bindPopup("<?php print $flightInfo["fromAirportName"]; ?><br><?php print $flightInfo["fromAirportMunicipality"]; ?>, <?php print $flightInfo["fromAirportCountryCode"]; ?>");

var toAirport = L.marker([<?php print $flightInfo["toAirportLatitude"]; ?>, <?php print $flightInfo["toAirportLongitude"]; ?>]).addTo(mymap);
toAirport.bindPopup("<?php print $flightInfo["toAirportName"]; ?><br><?php print $flightInfo["toAirportMunicipality"]; ?>, <?php print $flightInfo["toAirportCountryCode"]; ?>");

var line = L.polygon([
    [<?php print $flightInfo["fromAirportLatitude"]; ?>, <?php print $flightInfo["fromAirportLongitude"]; ?>],
    [<?php print $flightInfo["toAirportLatitude"]; ?>, <?php print $flightInfo["toAirportLongitude"]; ?>]
]).addTo(mymap);
line.setStyle({
    weight: 3.5,
    color: '#000'
});

var route = new L.featureGroup([fromAirport, toAirport, line]);

mymap.fitBounds(route.getBounds());</script>
			</aside>
<?php endif; ?>