<?php
    include_once('dht-database.php');
    if ($_GET["readingsCount"]){
      $data = $_GET["readingsCount"];
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $readings_count = $_GET["readingsCount"];
    }
    // default readings count set to 20
    else {
      $readings_count = 20;
    }

    $last_reading = getLastReadings();
    $last_reading_temp = $last_reading["temperature"];
    $last_reading_humi = $last_reading["humidity"];
    $last_reading_time = $last_reading["reading_time"];

    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    //$last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time - 1 hours"));
    // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
    //$last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time + 7 hours"));

    $min_temp = minReading($readings_count, 'temperature');
    $max_temp = maxReading($readings_count, 'temperature');
    $avg_temp = avgReading($readings_count, 'temperature');

    $min_humi = minReading($readings_count, 'humidity');
    $max_humi = maxReading($readings_count, 'humidity');
    $avg_humi = avgReading($readings_count, 'humidity');
?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="stylesheet" type="text/css" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
        <title>Teplota</title>
    </head>
    <body>
    <header class="header">
            <div class="beginner">
                <h1 class="home">Domov</h1>
            </div>
    </header>
         <nav class="nav">
            <div class="offer">
                <div class="firstcolumn"><a href="./index.html" class="hrefoffer"><img src="images/icons/house-xxl.png" class="domecek" alt="Domecek"></a></div>
                <div class="secondcolumn"><a href="./stavvody.php" class="hrefoffer"><p class="textoffer">VODA</p></a></div>
                <div class="thirdcolumn selectedcolumn"><a href="./dht.php" class="hrefoffer"><p class="textoffer">TEPLOTA</p></a></div>
                <div class="fourthcolumn"><a href="./lights.php" class="hrefoffer"><p class="textoffer">SVETLA</p></a></div>
            </div>
         </nav>

    <form method="get">
            <input type="number" size="100" name="readingsCount" min="1" placeholder="Number of readings (<?php echo $readings_count; ?>)">
            <input type="submit" value="UPDATE">
    </form>
    <p>Last reading: <?php echo $last_reading_time; ?></p>
    <section class="content">
        <div class="boxtemp">   
        <div class="box gauge--1" class="temp">
	    <h3>TEMPERATURE</h3>
              <div class="mask" class="temp">
			  <div class="semi-circle" class="temp"></div>
			  <div class="semi-circle--mask" class="temp"></div>
			</div>
		    <p style="font-size: 30px;" id="temp">--</p>
		    <table cellspacing="5" cellpadding="5">
		        <tr>
		            <th colspan="3" class="undervalue">Temperature <?php echo $readings_count; ?> readings</th>
	            </tr>
		    <tr>
		        <td>Min</td>
                        <td>Max</td>
                        <td>Average</td>
                    </tr>
                <tr>
                    <td><?php echo $min_temp['min_amount']; ?> &deg;C</td>
                    <td><?php echo $max_temp['max_amount']; ?> &deg;C</td>
                    <td><?php echo round($avg_temp['avg_amount'], 2); ?> &deg;C</td>
                </tr>
            </table>
        </div>
        <div class="box gauge--2" class="temp">
            <h3>HUMIDITY</h3>
            <div class="mask" class="temp">
                <div class="semi-circle" class="temp"></div>
                <div class="semi-circle--mask" class="temp"></div>
            </div>
            <p style="font-size: 30px;" id="humi">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3" class="undervalue">Humidity <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_humi['min_amount']; ?> %</td>
                    <td><?php echo $max_humi['max_amount']; ?> %</td>
                    <td><?php echo round($avg_humi['avg_amount'], 2); ?> %</td>
                </tr>
            </table>
        </div>
        </div>
    </section>
<?php
    echo   '<h2> View Latest ' . $readings_count . ' Readings</h2>
        <div class="limiter">
        <div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
            <table>
            <thead>
                <tr class="row100 head">
                    <th class="cell100 dht1">ID</th>
                    <th class="cell100 dht2">Sensor</th>
                    <th class="cell100 dht3">Location</th>
                    <th class="cell100 dht4">Temperature</th>
                    <th class="cell100 dht5">Humidity</th>
                    <th class="cell100 dht6">Timestamp</th>
                </tr>
                </thead>
                </table>
			</div>
                        <div class="table100-body js-pscroll">
		<table>
                        ';

    $result = getAllReadings($readings_count);
        if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];
            $row_sensor = $row["sensor"];
            $row_location = $row["location"];
            $row_value1 = $row["temperature"];
            $row_value2 = $row["humidity"];
            $row_reading_time = $row["reading_time"];
            // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
            // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 7 hours"));

            echo '
                
                <tr class="row100 body">
                    <td class="cell100 dht1">' . $row_id . '</td>
                    <td class="cell100 dht2">' . $row_sensor . '</td>
                    <td class="cell100 dht3">' . $row_location . '</td>
                    <td class="cell100 dht4">' . $row_value1 . '</td>
                    <td class="cell100 dht5">' . $row_value2 . '</td>
                    <td class="cell100 dht6">' . $row_reading_time . '</td>
                  </tr>';
        }
        echo '</table>';
        $result->free();
    }
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script>
    var value1 = <?php echo $last_reading_temp; ?>;
    var value2 = <?php echo $last_reading_humi; ?>;
    setTemperature(value1);
    setHumidity(value2);

    function setTemperature(curVal){
    	//set range for Temperature in Celsius -5 Celsius to 38 Celsius
    	var minTemp = 15.0;
    	var maxTemp = 35.0;
        //set range for Temperature in Fahrenheit 23 Fahrenheit to 100 Fahrenheit
    	//var minTemp = 23;
    	//var maxTemp = 100;

    	var newVal = scaleValue(curVal, [minTemp, maxTemp], [0, 180]);
    	$('.gauge--1 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#temp").text(curVal + ' ºC');
    }

    function setHumidity(curVal){
    	//set range for Humidity percentage 0 % to 100 %
    	var minHumi = 0;
    	var maxHumi = 100;

    	var newVal = scaleValue(curVal, [minHumi, maxHumi], [0, 180]);
    	$('.gauge--2 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#humi").text(curVal + ' %');
    }

    function scaleValue(value, from, to) {
        var scale = (to[1] - to[0]) / (from[1] - from[0]);
        var capped = Math.min(from[1], Math.max(from[0], value)) - from[0];
        return ~~(capped * scale + to[0]);
    }
</script>
</body>
</html>
