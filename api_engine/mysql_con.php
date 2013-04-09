<?php
include $_SERVER['DOCUMENT_ROOT']."api_engine/config.php";

$dbc = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die (json_encode(array("ERROR" => mysql_error())));
@mysql_select_db(DB_NAME) OR die (json_encode(array("ERROR" => mysql_error())));

?>
