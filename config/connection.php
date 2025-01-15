<?php

session_start();
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'bookshop';//name of database, select database
$conn = mysqli_connect($hostname, $username , $password ) or die($mysqli->connect_error);//www.php.net/manual/en/mysqli.construct.php//https://www.php.net/manual/en/mysqli.connect-error.php
$db_select = mysqli_select_db($conn, $database) or die($mysqli->connect_error);//name of database, select database
?>