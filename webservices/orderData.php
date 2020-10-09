<?php
$value = Array();
session_start();
$value['error']= "asdasd";
include("../mysql.php");
$link = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($database);

$usacc = $_SESSION['login'];

$sql = "select * from eshoporder where usercode = $usacc";
$res = mysql_query($sql);
while($row=mysql_fetch_array($res,MYSQL_ASSOC)){
    $prcode = $row['productcode'];
    $value['quantity'] = $row['quantity'];

    $sqlp = "select * from eshopproduct where code = $prcode";
    $resp = mysql_query($sqlp);
    while($rowp = mysql_fetch_array($resp,MYSQL_ASSOC)) {
        $apot[] = $rowp['name'];
    }

}
$value['result'] = $apot;

$sql = "select * from shippinginfo where usercode = $usacc";
$res = mysql_query($sql);
while ($row = mysql_fetch_array($res,MYSQL_ASSOC)) {
    $value['spinfo'] = $row['name'];
}
mysql_close($link);
json_encode($value);

?>