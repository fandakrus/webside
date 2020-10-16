<?php
$apikeyvalue = "tPmAT5Ab3j7F9";


$servername = "fdb30.awardspace.net";
$dbname = "3540556_stavvody";
$username = "3540556_stavvody";
$password = "Thigelis2";


if($_SERVER["REQUEST_METHOD"]== "GET"){
    if(isset($_GET["status"])){
        $status = $_GET["status"];
        //Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO (hodnota)
        VALUES ('" .$status. "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
}};

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $json = file_get_contents('php://input');
    $lightdata = json_decode($json, TRUE);
    $apikey = $lightdata["apikey"];


    if ($apikeyvalue==$apikey){
        $wanted = $lightdata["wanted"];
        if ($wanted=="lights"){ 
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sqlreturn = "SELECT ID, Hodnota FROM light ORDER BY id DESC";
            if ($result = $conn->query($sql)) {
                echo $sqlreturn
            
                echo "Pawel pawel";
            }
            
        }
        else{
            echo "Wrong value sended";
        }
    }
    else {
      echo "Wrong apikey" ; 
    }


}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


