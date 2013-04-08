<?php
include_once $_SERVER['DOCUMENT_ROOT']."api_engine/mysql_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."api_engine/auth.php";

session_start();

#check if module argument in post is set or not
if (!isset($_POST["module"]) || strlen($_POST["module"]) == 0)
{
	echo json_encode(array("ERROR" => "No modules selected"));
	exit();
}

if (SafeText($_POST["module"]) == "check_session")
	CheckSession();
else if (SafeText($_POST["module"]) == "check_token")
	CheckToken();
else if (SafeText($_POST["module"]) == "logout")
	Logout();
else
{
	echo json_encode(array("ERROR" => "No such module"));
	exit();	
}
?>