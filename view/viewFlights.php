
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
var marker = L.marker([<?php print $flightInfo["fromAirportLatitude"]; ?>, <?php print $flightInfo["fromAirportLongitude"]; ?>]).addTo(mymap);
L.tileLayer('https://api.mapbox.com/styles/v1/richardboon4884/cj0jbos6a00j42spdfiduad4n/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmljaGFyZGJvb240ODg0IiwiYSI6ImNqMGpiOWpqbTAwMW0zM3BtdWk2Z3ptYTYifQ.LtjlK_yXDQLgtutFAtqt2w', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'cj0jbcqtj00162ppkhiy0tsl4',
    accessToken: 'pk.eyJ1IjoicmljaGFyZGJvb240ODg0IiwiYSI6ImNqMGpiOWpqbTAwMW0zM3BtdWk2Z3ptYTYifQ.LtjlK_yXDQLgtutFAtqt2w'
}).addTo(mymap)

marker.bindPopup("<?php print $flightInfo["fromAirportName"]; ?><br><?php print $flightInfo["fromAirportMunicipality"]; ?>, <?php print $flightInfo["fromAirportCountryCode"]; ?>");

function midPoint(lat1,lon1,lat2,lon2)
{
    lat3 = (lat1 + lat2);
    lat3 = lat3/2;

    lon3 = (lon1 + lon2);
    lon3 = lon3/2;

    return (lat3 + ", " + lon3);
}</script>
			</aside>
<?php endif; ?>