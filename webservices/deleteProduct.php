<?php
if(empty($_POST["json"]))
{
    $value["error"]="Empty fields.";
}
else
{
    $json = $_POST["json"];
    $jsonArray = json_decode($json, true);
    $code = $jsonArray["code"];

    include("../mysql.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($database);
    $sql="delete from eshopproduct where code=$code";
    mysql_query($sql);
    $sql="delete from productimages where product_code=$code";
    mysql_query($sql);
    $value["error"]="Product deleted";
}
echo json_encode($value["error"]);

?>