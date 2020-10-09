<?php

require_once('Product.php');
include("../mysql.php");
$link=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($database);


$all_imgs = Array();
$sql="select * from eshopproduct";
$res=mysql_query($sql);
while($row=mysql_fetch_array($res,MYSQL_ASSOC))
{
    $imgs = new Product();

    $apot2=Array();
    $imgs->setCode($row["code"]);
    $imgs->setName($row["name"]);
    $imgs->setDescription($row["description"]);
    $imgs->setPrice($row["price"]);
    $imgs->setItems($row["items"]);

    $sql="select img_path from productimages where product_code=".$imgs->getCode();
    $res2=mysql_query($sql);
    while($row2=mysql_fetch_array($res2,MYSQL_ASSOC))
    {
        $imgs->addImageInPathList($row2);
    }
    $all_imgs[]= $imgs;
}


mysql_close($link);
echo json_encode($all_imgs,JSON_PRETTY_PRINT);
?>