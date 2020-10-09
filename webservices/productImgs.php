<?php
$value=Array();
$value["code"]=0;
file_put_contents('php://stderr', print_r("h timi einai pou erxete:" . $_POST["json"], TRUE));
if(empty($_POST["json"]))
{
    file_put_contents('php://stderr', print_r("adeio json", TRUE));
    $value["error"]="Empty fields.";
}

else
{
    file_put_contents('php://stderr', print_r("komple json", TRUE));
    $json=$_POST["json"];
    $jsonArray=json_decode($json,true);
    include("../mysql.php");
    $link=mysql_connect($dbhost,$dbuser,$dbpass);
    mysql_select_db($database);
    $code=$jsonArray["code"];
    $sql="select * from productimages where product_code=$code";
    $res=mysql_query($sql);
    if (!$res) { // add this check.
        die('Invalid query: ' . mysql_error());
    }
    file_put_contents('php://stderr', print_r("h timi to res einai:" . $res, TRUE));
    $apot=Array();
    $value["code"]=1;
    $value["error"]="No error.";
    while($row=mysql_fetch_array($res,MYSQL_ASSOC))
    {
        $apot[]=$row;
    }
    $value["result"]=$apot;
    mysql_close($link);
}
echo json_encode($value["result"]);
file_put_contents('php://stderr', print_r("h timi einai:" . json_encode($value), TRUE));
?>