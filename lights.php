<!DOCTYPE html>
<html>
    <head>
    <title>Svetla</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
                <div class="secondcolumn"><a href="./stavvody.php" class="hrefoffer"><p class="textoffer">VODA</p></a></div>
                <div class="thirdcolumn"><a href="./dht.php" class="hrefoffer"><p class="textoffer">TEPLOTA</p></a></div>
                <div class="fourthcolumn selectedcolumn"><a href="./lights.php" class="hrefoffer"><p class="textoffer">SVETLA</p></a></div>
            </div>
         </nav>
        <form method="get" action="./lights-post.php">
            <input type="radio" id="on" name="status" value="on" <?php if(isset($status) && $status == "on") echo "checked";?>>ON<br>
            <input type="radio" id="off" name="status" value="off"<?php if(isset($status) && $status == "off") echo "checked";?>>OFF
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
