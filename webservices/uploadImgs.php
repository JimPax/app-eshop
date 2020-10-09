<?php
$value=Array();

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

include("../mysql.php");
$link=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($database);

$img_path = "";
$sql = "SELECT code from eshopproduct ORDER BY code DESC LIMIT 1";

$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$code=$row["code"];
file_put_contents('php://stderr', print_r("TO Res EINAI: " .$res, TRUE));
file_put_contents('php://stderr', print_r("TO CODE EINAI: " .$code, TRUE));

if ($_FILES['files']) {
    $file_ary = reArrayFiles($_FILES['files']);

    foreach ($file_ary as $file) {
        file_put_contents('php://stderr', print_r("h timi einai pou erxete fotos:" .$file['name'], TRUE));

        $file_tmp = $file['tmp_name'];
        move_uploaded_file($file_tmp,"D:\\XAMPP\\htdocs\\app\\img\\".$file['name']);

        $img_path = "img/".$file['name'];

        $sql = "insert into productimages(product_code,img_path) values ('$code','$img_path')";
        mysql_query($sql);
        $value["success"] = "Pictures successfully added";
    }
}

echo json_encode($value);
?>