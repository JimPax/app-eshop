<?php
$value=Array();
if(empty($_POST["json"]))
{
    $value["error"]="Empty fields.";
}
else {
    $json = $_POST["json"];
    $jsonArray = json_decode($json, true);
    include("../mysql.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($database);
    session_start();

    $usacc = $_SESSION['login'];
    $prid = $jsonArray['code'];

    $sql = "delete from cart where useracc=$usacc AND productid=$prid";
    mysql_query($sql);
    mysql_close($link);
}
echo json_encode($value);