<style>
    main>form {

    }
    main>iframe {
        position: absolute;
        right:0;
        top:35px;
        height: calc(100% - 35px);
        width: calc(100% - 575px);
        border: 0;
    }
    .chartDescription {
        font-style: italic;
    }
</style>
<!--		<form method="post"><select class="chosen-select" name="airport">-->
        <form><select class="chosen-select" name="airport" id="airport">
<?php foreach ($aiportWithCharts as $aiportWithChart): ?>
                <option value="<?php print $aiportWithChart["icao"]?>"><?php print $aiportWithChart["icaoName"] . " - " . $aiportWithChart["name"]?></option>
<?php endforeach; ?>
            </select><input type="button" value="Search" onclick="window.location.replace('/airport/chart/' + document.getElementById('airport').value)"></form>
<?php if (isset($charts)) : ?>
					<nav class="list charts">
                        <ul>
<?php foreach ($charts as $chart): ?>
    <a href="<?php echo $chart["file_location"] ?>" target="chartScreen"><li class="box" id="<?php echo $chart["icao"] ?>"><div class="chartName"><?php echo $chart["name"] ?></div><div  class="chartDescription"><?php echo $chart["description"] ?></div></li></a>
<?php endforeach; ?>
                        </ul>
                    </nav>
					<iframe src="" name="chartScreen"></iframe>
<?php endif; ?>
        <script type="text/javascript">$(".chosen-select").chosen()</script>
