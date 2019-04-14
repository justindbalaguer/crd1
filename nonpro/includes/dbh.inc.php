<?php
//declare connection
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "newdb";
//connect to database
$conn = mysqli_connect($servername, $username, $password, $dbName);
//check if connection failed
if(!$conn) {
    die("Connection Failed!: ".mysqli_connect_error());
}
