<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = '19php01_ss3';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Change character set to utf8
mysqli_set_charset($conn,"utf8");
// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";
?>
