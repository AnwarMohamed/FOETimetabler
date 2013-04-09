<?php
//include $_SERVER['DOCUMENT_ROOT']."api_engine/mysql_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."api_engine/auth.php";
//include_once $_SERVER['DOCUMENT_ROOT']."api_engine/config.php";

session_start();

#check if module argument in post is set or not
if (!isset($_POST["module"]) || strlen($_POST["module"]) == 0)
{
	echo json_encode(array("ERROR" => "no_module"));
	exit();
}

#everytime use isLoggedin() to check if the user if logged in
if (SafeText($_POST["module"]) == "check_session")
{
	CheckSession();
}	
else if (SafeText($_POST["module"]) == "check_token")
{
	if (isLoggedin()) CheckToken();
	else 
	{ echo json_encode(array("ERROR" => "not_logged_in")); exit();}
}
else if (SafeText($_POST["module"]) == "logout")
{
	Logout();
}	
else if (SafeText($_POST["module"]) == "login")
{
	if (isLoggedin()) { session_destroy(); session_start(); }
	Login();
}
else
{
	echo json_encode(array("ERROR" => "not_module"));
	exit();	
}
?>