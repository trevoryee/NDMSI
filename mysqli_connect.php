<?php # Script 9.2 - mysqli_connect.php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.

// Set the database access information as constants:
DEFINE ('DB_USER', 'infost490f2312_user1');
DEFINE ('DB_PASSWORD', 'CapstoneProject123@');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'infost490f2312_capstone');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
?>