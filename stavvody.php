<!DOCTYPE html>
<html lang="en">
<head>
	<title>Voda</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
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
                <div class="secondcolumn selectedcolumn"><a href="./stavvody.php" class="hrefoffer"><p class="textoffer">VODA</p></a></div>
                <div class="thirdcolumn"><a href="./dht.php" class="hrefoffer"><p class="textoffer">TEPLOTA</p></a></div>
                <div class="fourthcolumn"><a href="./lights.php" class="hrefoffer"><p class="textoffer">SVETLA</p></a></div>
            </div>
         </nav>

<?php
$servername = "localhost";

// REPLACE with your Database name
$dbname = "domaci_udaje";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "thigelis2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData ORDER BY id DESC";
echo	'<div class="limiter">
            
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">ID</th>
									<th class="cell100 column2">Sensor</th>
									<th class="cell100 column3">Location</th>
									<th class="cell100 column4">Value 1</th>
									<th class="cell100 column5">Value 2</th>
                                                                        <th class="cell100 column6">Value 3</th>
                                                                        <th class="cell100 column7">Time</th>
								</tr>
							</thead>
						</table>
					</div>
                                        <div class="table100-body js-pscroll">
						<table>
							<tbody>
'
;
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 2 hours"));

        echo '                          
								<tr class="row100 body">
									<td class="cell100 column1">' . $row_id . '</td>
									<td class="cell100 column2">' . $row_sensor . '</td>
									<td class="cell100 column3">' . $row_location . '</td>
									<td class="cell100 column4">' . $row_value1 . '</td>
									<td class="cell100 column5">' . $row_value2 . '</td>
                                                                        <td class="cell100 column6">' . $row_value3 . '</td>
                                                                        <td class="cell100 column7">' . $row_reading_time . '</td>
								</tr>';
    }
    $result->free();
}
$conn->close();
echo '							</tbody>
						</table>
					</div>
				
				</div>
			</div>
		</div>
	</div>';

    
?>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->

</body>
</html>