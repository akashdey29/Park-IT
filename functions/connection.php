<?php

$hostname = "localhost" ;
$username = "root";
$password = "";
$database = "Parkit";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die('Data base conneected'.mysqli_connect_error());
}