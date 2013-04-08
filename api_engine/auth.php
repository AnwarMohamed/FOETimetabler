<?php
include_once $_SERVER['DOCUMENT_ROOT']."api_engine/misc_functions.php";

function CheckToken()
{
	if (isset($_POST["id"]) && isset($_POST["token"]) &&
		SafeText($_POST["id"]) == SafeText($_SESSION["user_id"]) &&
		SafeText($_POST["token"]) == SafeText($_SESSION["auth_token"]))
	{
		echo json_encode(array("check_token" => 1));
		exit();		
	}
	else
	{
		echo json_encode(array("check_token" => 0));
		exit();	
	}
}

function Logout()
{
	session_destroy();
	echo json_encode(array("logout" => 1));
	exit();
}

?>