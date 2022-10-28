<?php 
ini_set("max_execution_time",1000000000);
$set_charset = 'export LANG=ko_KR.UTF-8;';
set_time_limit(1000000000);
$name=$_GET['name'];
$begin=$_GET['begin'];
$end=$_GET['end'];
$date=$_GET['date'];
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
$sql1 = 'SELECT weather.qiwen FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_query($dbc,$sql1);
$arr=mysqli_fetch_all($result);
$arr1=mysqli_fetch_all($result1);
$arrayavg= array();
$arrayavg1= array();
for ($i=0;$i<count($arr)/24;$i++){
    $sum=0;
    for ($j=0;$j<24;$j++){
        $sum=$sum+$arr[$j+($i*24)][0];
    }
    $arrayavg[]= $sum/24;
  };  
$sum1=0;
for ($i=0;$i<count($arr1);$i++){
    $sum1+=$arr1[$i][0];
   
  }; 

$day=count($arr)/24;
$avg=array_sum($arrayavg)/$day;
$max=max($arrayavg);
$min=min($arrayavg);
$today=$sum1/24;
$result= array();
array_push($result,$today,$avg,$max,$min);
$data = json_encode($result);
echo $data;


?>