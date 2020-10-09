<?php
$value=Array();
$value['tprice'] = "0";
session_start();
require_once('CartDet.php');
include("../mysql.php");
$link=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($database);

$usacc = $_SESSION['login'];

$sql = "select productid,quantity from cart where useracc = $usacc";
$res = mysql_query($sql);
while ($row = mysql_fetch_array($res, MYSQL_BOTH)) {
    $cartSet = new CartDet();

    $productid = $row['productid'];
    $cartSet->setQuantity($row['quantity']);

    $sql = "select code,price,name from eshopproduct where code = $productid";
    $res2 = mysql_query($sql);
    $rowp = mysql_fetch_array($res2);
    $cartSet->setCode($rowp['code']);
    $cartSet->setName($rowp['name']);
    $cartSet->setPrice($rowp['price']);
    $sqlimg = "select img_path from productimages where product_code =" . $cartSet->getCode();
    $resimg = mysql_query($sqlimg);
    $rowimg = mysql_fetch_array($resimg);
    $cartSet->setImg($rowimg['img_path']);
    $totalip = $cartSet->getQuantity() * $cartSet->getPrice();
    $value['tprice'] = $value['tprice'] + $totalip;

    $value[] = $cartSet;
}
mysql_close($link);
echo json_encode($value);
?>