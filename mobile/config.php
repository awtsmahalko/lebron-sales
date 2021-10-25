<?php
include '../core/variables.php';
//$con = mysqli_connect("localhost","root","","sales_db") or die('Unable to Connect');
$host 	  = host;
$username = username;
$password = password;
$database = database;

@mysql_connect($host, $username, $password) or die("Cannot connect to MySQL Server");
@mysql_select_db($database) or die ("Cannot connect to Database");
?>