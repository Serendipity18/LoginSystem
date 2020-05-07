<?php

$servername = "localhost";
$dBUsername = "username";
$dBPassword = "password";
$dBName = "dbname";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//if connection to database fails, print out an error message
if (!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
}

