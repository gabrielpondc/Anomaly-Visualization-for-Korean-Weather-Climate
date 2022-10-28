<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');

$date=$_GET['date'];
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
header("content-type:text/json;charset=utf-8");
$db_selected=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
  if (!$db_selected) 
  { 
    die ("Can\'t use  " ); 
  } 
$sql1 = 'SELECT anomalyscore.score FROM anomalyscore,coordinates where anomalyscore.KID=coordinates.KID  and anomalyscore.date="'.$date.'"';
$result1 = mysqli_query($dbc,$sql1);
$arr1=mysqli_fetch_all($result1);
$data = json_encode($arr1);
echo $data;

?>