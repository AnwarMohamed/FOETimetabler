<?php
include $_SERVER['DOCUMENT_ROOT']."api_engine/mysql_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."api_engine/misc_functions.php";

function CheckToken()
{
	if (isset($_POST["id"]) && isset($_POST["token"]) &&
		SafeText($_POST["id"]) == SafeText($_SESSION["user_id"]) &&
		SafeText($_POST["token"]) == SafeText($_SESSION["auth_token"]))
	{ echo json_encode(array("check_token" => true));	exit();	}
	else { echo json_encode(array("check_token" => false));	exit(); }
}

function Logout() {	session_destroy(); echo json_encode(array("logout" => true)); exit(); }

function isLoggedin()
{
	if (isset($_POST["id"]) && isset($_POST["token"]) &&
		SafeText($_POST["id"]) == SafeText($_SESSION["user_id"]) &&
		SafeText($_POST["token"]) == SafeText($_SESSION["auth_token"]))
		return true;		
	else return false;	
}

function Login()
{
	if (isset($_POST["id"]) && isset($_POST["password"]))
	{
		$userid = SafeText($_POST["id"]);
		$userpassword = sha1(SafeText($_POST["password"]));
		
		$login_query = mysql_query("SELECT role from users WHERE id='$userid' AND password='$userpassword'");
		$login_query_data = mysql_fetch_assoc($login_query);
		
		if (mysql_num_rows($login_query) == 1)
		{
			$_SESSION['user_id'] = $userid;
			$_SESSION['auth_token'] = RandomString();
			$_SESSION['role'] = $login_query_data['role'];
			
			$ip_address = $_SERVER['SERVER_ADDR'];
			mysql_query("INSERT INTO login_log (id, datetime, ip_address)
						VALUES ('$userid', NOW(), '$ip_address')");
			
			echo json_encode(array(	"login" => true, "token" => $_SESSION['auth_token'])); 
			exit();
		}
		else { echo json_encode(array("login" => false)); exit(); }	
	}
	else { echo json_encode(array("login" => false)); exit(); }
}
?>