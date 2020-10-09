<?php
$value=Array();
if(empty($_POST["json"]))
{
    $value["error"]="Empty fields.";
}
else
{
    session_start();
    $usacc = $_SESSION['login'];
    $jsAr = json_decode($_POST["json"],true);
    $name = $jsAr["name"];
    $lastname = $jsAr["lastname"];
    $email = $jsAr["email"];
    $address = $jsAr["address"];
    $city = $jsAr["city"];
    $zipcode = $jsAr["zipcode"];
    $phone = $jsAr["phone"];

    include("../mysql.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($database);

    $sql = "insert into shippinginfo (usercode,name,lastname,email,address,city,zipcode,phone) values($usacc, '$name', '$lastname', '$email', '$address', '$city', $zipcode, $phone)";
    mysql_query($sql);

    $sql = "select * from cart where useracc = $usacc";
    $res = mysql_query($sql);
    while($row=mysql_fetch_array($res,MYSQL_ASSOC)){
        $pcode = $row['productid'];
        $items = $row['quantity'];
        $timestamp=time();
        $sqlo = "insert into eshoporder (usercode,productcode,quantity,timestamp) values ($usacc,$pcode,$items,$timestamp)";
        mysql_query($sqlo);

        $sql="update eshopproduct set items=items-$items where code=$pcode";
        mysql_query($sql);
    }

    $sql = "DELETE FROM `cart` WHERE useracc = $usacc";
    mysql_query($sql);

    mysql_close($link);
}

json_encode($value);

?>