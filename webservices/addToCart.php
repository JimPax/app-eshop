<?php
$value=Array();
if(empty($_POST["json"]))
{
    $value["error"]="Empty fields.";
}
else {
    $json=$_POST["json"];
    $jsonArray=json_decode($json,true);
    include("../mysql.php");
    $link=mysql_connect($dbhost,$dbuser,$dbpass);
    mysql_select_db($database);
    session_start();

    $usacc = $_SESSION['login'];
    $prid = $jsonArray['code'];
    $quant = $jsonArray['quant'];


    $sql = "select productid,quantity from cart where productid = $prid and useracc=$usacc" ;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $pridc = $row['productid'];
    $prquant = $row['quantity'];
    $prquant = $prquant + $quant;

    $sql = "select items from eshopproduct where code = $prid";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $plft = $row['items'];
    if ($quant > $plft or $prquant > $plft) {
        $value["plft"] = "There are no other products";
    } else {
        if (isset($pridc)) {
            $sql = "update cart set quantity=$prquant where productid=$prid and useracc=$usacc";
            mysql_query($sql);
        } elseif (isset($prid)) {
            $sql = "insert into cart(useracc,productid,quantity) values($usacc,$prid,$quant)";
            mysql_query($sql);
        }
    }
    mysql_close($link);
}
echo json_encode($value);
?>