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
if($_POST['prc']){
    $json=$_POST["prc"];
    $jsonArray=json_decode($json,true);
    $pcode = $jsonArray["code"];
    echo("<script>console.log('PHP2: ".$json."');</script>");
    echo("<script>console.log('PHP3: ".$jsonArray."');</script>");

}

$img_path = "";
if ($_FILES['files']) {
    $file_ary = reArrayFiles($_FILES['files']);

    foreach ($file_ary as $file) {

        $file_tmp = $file['tmp_name'];
        move_uploaded_file($file_tmp,"D:\\XAMPP\\htdocs\\app\\img\\".$file['name']);

        $img_path = "img/".$file['name'];

        $sql = "update productimages set img_path = $img_path where code = $pcode";
        mysql_query($sql);
        $value["success"] = "Pictures successfully added";
    }
}

echo json_encode($value);
?>