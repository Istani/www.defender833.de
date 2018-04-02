<?php
ini_set('display_errors', 1);
set_time_limit(0);
@session_start();
//header("content-type: text/html; charset=ISO-8859-5");

$site['base_dir']=$_SERVER["CONTEXT_PREFIX"]."/";
$site['simple_yth_account']="Admin";
require_once "../SimpleYTH/private_settings.php";
require_once "class/db/db.php";

$database = new db("mysql", $mysql['host'], $mysql['user'], $mysql['pass']);
$database->connect_db($mysql['base']);

$SYTH['user']=$database->sql_select("user","*","email='".$site['simple_yth_account']."'",false)[0];
$SYTH['youtube_channel']=$database->sql_select("youtube_channels","*","youtube_id='".$SYTH['user']['youtube_user']."'",false)[0];


$price_collums="steam_price,humble_price";
?>
