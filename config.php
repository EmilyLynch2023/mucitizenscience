<?php

/* Database credentials. Assuming you are running MySQL

server with default setting (user 'root' with no password) */

//define('DB_SERVER', 'mucs.bhweb.ws');
define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'mucsbhwe_admin');

define('DB_PASSWORD', 'ManchesterAdmin800');

define('DB_NAME', 'mucsbhwe_main');

 

/* Attempt to connect to MySQL database */

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}else{

	echo "Connection was successful";

}

?>