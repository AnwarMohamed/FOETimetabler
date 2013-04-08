<?php

function SafeText($str)
{
	$str = mysql_real_escape_string($str);
	return $str;
}

function CheckSession()
{
	if (isset($_SESSION['user_id']))
	{
			echo json_encode(array(	"check_session" => "logged_in",
									"id" => SafeText($_SESSION['user_id']),
									"auth_token" => SafeText($_SESSION['user_token'])));
			exit();
	}
	else
	{
			echo json_encode(array("check_session" => "not_logged_in"));
			exit();	
	}
}
?>