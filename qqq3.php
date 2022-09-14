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
$sql2 = 'SELECT weather.shidu FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$sql3 = 'SELECT weather.zhengqiya FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$sql4 = 'SELECT weather.ludianwendu FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$sql5 = 'SELECT weather.dangdiqiya FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$sql6 = 'SELECT weather.haimianqiya FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';
$sql7 = 'SELECT weather.dimianqiya FROM weather,test where weather.KID=test.KID and test.city= "'.$name.'" and weather.date>="'.$date.'" and weather.date<adddate("'.$date.'",1)';

$result1 = mysqli_query($dbc,$sql1);
$result2 = mysqli_query($dbc,$sql2);
$result3 = mysqli_query($dbc,$sql3);
$result4 = mysqli_query($dbc,$sql4);
$result5 = mysqli_query($dbc,$sql5);
$result6 = mysqli_query($dbc,$sql6);
$result7 = mysqli_query($dbc,$sql7);
$arr1=mysqli_fetch_all($result1);
$arr2=mysqli_fetch_all($result2);
$arr3=mysqli_fetch_all($result3);
$arr4=mysqli_fetch_all($result4);
$arr5=mysqli_fetch_all($result5);
$arr6=mysqli_fetch_all($result6);
$arr7=mysqli_fetch_all($result7);
$sum1=0;
for ($i=0;$i<count($arr1);$i++){
    $sum1+=$arr1[$i][0];
   
  }; 
$today1=$sum1/24;
$sum2=0;
for ($i=0;$i<count($arr2);$i++){
    $sum2+=$arr2[$i][0];
   
  }; 
$today2=$sum2/24;
$sum3=0;
for ($i=0;$i<count($arr3);$i++){
    $sum3+=$arr3[$i][0];
   
  }; 
$today3=$sum3/24;
$sum4=0;
for ($i=0;$i<count($arr4);$i++){
    $sum4+=$arr4[$i][0];
   
  }; 
$today4=$sum4/24;
$sum5=0;
for ($i=0;$i<count($arr5);$i++){
    $sum5+=$arr5[$i][0];
   
  }; 
$today5=$sum5/24;
$sum6=0;
for ($i=0;$i<count($arr6);$i++){
    $sum6+=$arr6[$i][0];
   
  }; 
$today6=$sum6/24;
$sum7=0;
for ($i=0;$i<count($arr7);$i++){
    $sum7+=$arr7[$i][0];
   
  }; 
$today7=$sum7/24;
$today1=round($today1,2);
$today2=round($today2,2);
$today3=round($today3,2);
$today4=round($today4,2);
$today5=round($today5,2);
$today6=round($today6,2);
$today7=round($today7,2);
$result=array();
array_push($result,$today1,$today2,$today3,$today4,$today5,$today6,$today7);

$data = json_encode($result);
echo $data;
  ?>