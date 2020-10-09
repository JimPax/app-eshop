<?php
$value=Array();
if(empty($_POST["json"]) || $_POST["json"] == "{}" )
{
    $value["error"]="Empty fields.";
}

else
{
    $json=$_POST["json"];
    $jsonArray=json_decode($json,true);
    if(empty($jsonArray["username"]) || empty($jsonArray["password"])) {
        $value["error"] = "Empty fields.";
    }
    else
    {
        $username = "";
        $password = "";
        $username = $jsonArray["username"];
        $password = $jsonArray["password"];
        if ($username == "admin" && $password == "1234"){
            session_start();
            $_SESSION['login'] = "admin";
            $value["session"] = $_SESSION['login'];
        }
        else {
            include("../mysql.php");
            $link = mysql_connect($dbhost, $dbuser, $dbpass);
            mysql_select_db($database);
            $sql = "select * from eshopusers where username='$username' and password='$password'";
            $res = mysql_query($sql);
            $n = mysql_num_rows($res);
            while($row=mysql_fetch_array($res,MYSQL_ASSOC))
            {
                $uid = $row["code"];
            }
            if ($n == 0) {
                $value["error"] = "User $username not found";
            }
            else {
                session_start();
                $_SESSION['login'] = $uid;
                $value["session"] = $_SESSION['login'];
            }
            mysql_close($link);
        }
    }
}


echo json_encode($value);


?>
