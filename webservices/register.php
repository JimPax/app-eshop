<?php
$value=Array();
if(empty($_POST["json"]))
{
    $value["error"]="Empty fields.";
}
else
{

    $jsAr=json_decode($_POST["json"],true);
    if(empty($jsAr["username"]) || empty($jsAr["password"])) {
        $value["error"] = "Empty fields.";
    }
    else {

        $name = $jsAr["name"];
        $lastname = $jsAr["lastname"];
        $username = $jsAr["username"];
        $email = $jsAr["email"];
        $password = $jsAr["password"];
        $address = $jsAr["address"];
        $city = $jsAr["city"];
        $zipcode = $jsAr["zipcode"];
        $phone = $jsAr["phone"];

        include("../mysql.php");
        $link = mysql_connect($dbhost, $dbuser, $dbpass);
        mysql_select_db($database);
        $sql = "select * from eshopusers where username='$username'";
        $res = mysql_query($sql);
        if (mysql_num_rows($res) > 0) {
            $value["error"] = "User $username already exists.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $value["error"] = "Invalid e-mail format";
        } else {
            $sql = "insert into eshopusers(name,lastname,username,email,password,address,city,zipcode,phone) values('$name'," .
                "'$lastname','$username','$email','$password','$address','$city','$zipcode','$phone')";
            mysql_query($sql);
            $sql = "select * from eshopusers where username='$username'";
            $res = mysql_query($sql);
            $row = mysql_fetch_array($res, MYSQL_BOTH);
            $sendun = $row["username"];
            $value["success"] = "You have registered successfully $sendun";
        }
        mysql_close($link);
    }
}
echo json_encode($value);
?>