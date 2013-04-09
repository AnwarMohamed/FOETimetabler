<?php

function SafeText($str) { $str = mysql_real_escape_string($str); return $str; }

function CheckSession()
{
	if (isset($_SESSION['user_id']))
	{
		echo json_encode(array(	"check_session" => true,
								"id" => SafeText($_SESSION['user_id']),
								"auth_token" => SafeText($_SESSION['auth_token'])));
		exit();
	}
	else
	{ echo json_encode(array("check_session" => false)); exit(); }
}

function RandomString($length = 30)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>