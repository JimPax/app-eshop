<?php
$value=Array();
$code = "";
if(empty($_POST["json"]))
{
    $value["error"]="Empty fields.";
}
else
{
    $json=$_POST["json"];
    $jsonArray=json_decode($json,true);
    if(empty($jsonArray["name"]) || empty($jsonArray["description"]) || empty($jsonArray["price"]) || empty($jsonArray["items"]) || empty($jsonArray["code"])) {
        $value["error"] = "Empty fields.";
    }
    else {
        $name = $jsonArray["name"];
        $description = $jsonArray["description"];
        $price = $jsonArray["price"];
        $items = $jsonArray["items"];
        $code = $jsonArray["code"];

        if ($price < 0 || $items < 0) {
            $value["error"] = "Negative fields not allowed";
        }else if(!is_numeric($price) || !is_numeric($items)){
            $value["error"] = "Price and quantity fields need numbers";
        } else {
            include("../mysql.php");
            $link = mysql_connect($dbhost, $dbuser, $dbpass);
            mysql_select_db($database);
            $sql = "UPDATE eshopproduct SET name='$name', description='$description', price='$price', items='$items' WHERE code = $code";
            mysql_query($sql);

            $sql = "select code from eshopproduct where name='$name'";
            $res = mysql_query($sql);
            $row = mysql_fetch_array($res);
            $value["code"] = $row["code"];
            $value["status"] = 200;
            $value["name"] = $name;


            mysql_close($link);
        }
    }
}
echo json_encode($value);
?>