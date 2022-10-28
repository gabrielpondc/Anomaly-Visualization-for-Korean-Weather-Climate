<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$name=$_GET['name'];
$date=$_GET['date'];
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
header("content-type:text/json;charset=utf-8");
$db_selected=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
  if (!$db_selected) 
  { 
    die ("Can\'t use  " ); 
  } 
  //执行MySQL查询-设置UTF8格式
  // mysqli_query("SET NAMES utf8");  
  // mysqli_query()

$sql1 = 'SELECT weather.qiwen FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$result1 = mysqli_query($dbc,$sql1);
$arr1=mysqli_fetch_all($result1);
$sum1=0;
for ($i=0;$i<count($arr1);$i++){
    $sum1+=$arr1[$i][0];
   
  }; 
$today1=$sum1/24;
$data = json_encode($today1);
echo $data;




?>