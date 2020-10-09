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
    $flag = $jsonArray['flag'];

    $sql = "select quantity from cart where productid = $prid and useracc=$usacc" ;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $curquant = $row['quantity'];

    if($flag == "rmv" && $curquant > 1){
        $newquant = $curquant - 1;
        $sql = "update cart set quantity=$newquant where productid=$prid and useracc=$usacc";
        mysql_query($sql);
    }elseif ($flag == "add"){
        $sql = "select items from eshopproduct where code = $prid";
        $res = mysql_query($sql);
        $row = mysql_fetch_array($res);
        $plft = $row['items'];
        if($curquant >= $plft){
            $value['msg'] = "There are no other products";
        }else {
            $newquant = $curquant + 1;
            $sql = "update cart set quantity=$newquant where productid=$prid and useracc=$usacc";
            mysql_query($sql);
        }
    }
    mysql_close($link);
}

echo json_encode($value);
?>