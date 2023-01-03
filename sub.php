<?php
ini_set("max_execution_time",1000000000);
$set_charset = 'export LANG=ko_KR.UTF-8;';
set_time_limit(1000000000);
$tag=$_GET['tag'];
$rssi=$_GET['rssi'];
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','wifi');
$sqla="insert into wifilist VALUES ('{$tag}',{$rssi})";
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
$res=mysqli_query($dbc,$sqla);
if ($res == 1) {
   echo 'sucess';
}
else {
   echo 'error';
}

?>