<?php
	$value=Array();
	$value["code"]=0;
	if(empty($_POST["json"]))
	{
		$value["error"]="Empty fields.";
	}

	else
	{
		$json=$_POST["json"];
		$jsonArray=json_decode($json,true);
		include("../mysql.php");
		$link=mysql_connect($dbhost,$dbuser,$dbpass);
		mysql_select_db($database);
		$code=$jsonArray["code"];
		$sql="select * from eshopproduct where code=$code";
		$res=mysql_query($sql);
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
?>
