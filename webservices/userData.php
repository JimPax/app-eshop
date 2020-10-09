<?php

include("../mysql.php");
$link=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($database);
session_start();

$usacc = $_SESSION['login'];

$sql = "select * from eshopusers where code = $usacc";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$value['name'] = $row['name'];
$value['lastname'] = $row['lastname'];
$value['email'] = $row['email'];
$value['address'] = $row['address'];
$value['city'] = $row['city'];
$value['zipcode'] = $row['zipcode'];
$value['phone'] = $row['phone'];


mysql_close($link);
echo json_encode($value);
?>