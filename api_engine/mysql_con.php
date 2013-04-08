<?php
include_once $_SERVER['DOCUMENT_ROOT']."api_engine/config.php";

$database = mysqli_connect(	$api_config_mysql_host,$api_config_mysql_username,
						$api_config_mysql_password, $api_config_mysql_database);

// Check connection
if (mysqli_connect_errno($database))
{
	echo json_encode(array("ERROR" => "Database error"));
	exit();
}

?>
