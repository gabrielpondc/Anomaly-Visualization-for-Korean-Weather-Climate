<?php 
ini_set("max_execution_time",10000);
$set_charset = 'export LANG=ko_KR.UTF-8;';
set_time_limit(10000);
$name=$_GET['name'];
$begin=$_GET['begin'];
$end=$_GET['end'];
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
header("content-type:text/json;charset=utf-8");
$db_selected=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
  if (!$db_selected) 
  { 
    die ("Can\'t use  " ); 
  } 
$sql = 'SELECT weather.qiwen FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$result = mysqli_query($dbc,$sql); 
$arr=mysqli_fetch_all($result);

$arrayavg= array();
$dayavg=array();
for ($i=0;$i<count($arr)/24;$i++){
    $sum=0;
    for ($j=0;$j<24;$j++){
      $sum+=$arr[$j+($i*24)][0];
      $dayavg[]=$arr[$j+($i*24)][0];
    }
    $arrayavg[]= $sum/24;
  }
  print_r($dayavg)
?>