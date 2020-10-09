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
    if(empty($jsonArray["name"]) || empty($jsonArray["description"]) || empty($jsonArray["price"]) || empty($jsonArray["items"])) {
        $value["error"] = "Empty fields.";
    }
    else {
        $name = $jsonArray["name"];
        $description = $jsonArray["description"];
        $price = $jsonArray["price"];
        $items = $jsonArray["items"];

        if ($price < 0 || $items < 0) {
            $value["error"] = "Negative fields not allowed";
        }else if(!is_numeric($price) || !is_numeric($items)){
            $value["error"] = "Price and quantity fields need numbers";
        } else {
            include("../mysql.php");
            $link = mysql_connect($dbhost, $dbuser, $dbpass);
            mysql_select_db($database);
            $sql = "insert into eshopproduct(name,description,price,items) values('$name','$description',$price,$items)";
            mysql_query($sql);

            $sql = "select code from eshopproduct where name='$name'";
            $res = mysql_query($sql);
            $row = mysql_fetch_array($res);
            $value["code"] = $row["code"];
            $value["status"] = 200;


            mysql_close($link);
        }
    }
}
echo json_encode($value);
?>