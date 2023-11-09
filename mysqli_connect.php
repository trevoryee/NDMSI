<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

DEFINE ('DB_USER', 'infost490f2312_user1');
DEFINE ('DB_PASSWORD', 'CapstoneProject123@');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'infost490f2312_capstone');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

mysqli_set_charset($dbc, 'utf8');
?>