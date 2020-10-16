<?php
include_once('dht-database.php');

$servername = "localhost";

// REPLACE with your Database name
$dbname = "domaci_udaje";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "thigelis2";
$api_key_value = "tPmAT5Ab3j7F9";


$json = file_get_contents('php://input');
$temperturedata = json_decode($json, TRUE);
$api_key = $temperturedata['api_key'];
if ($api_key == $api_key_value) {
    $sensor = $temperturedata['sensor'];
    $location = $temperturedata['location'];
    $temperature = $temperturedata['temperature'];
    $humidity = $temperturedata['humidity'];
        
    $result = insertReading($sensor, $location, $temperature, $humidity);
      echo $result;

    }
else {
    echo "Wrong API Key provided.";
}
