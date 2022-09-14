<?php 
ini_set("max_execution_time",10000);
$set_charset = 'export LANG=ko_KR.UTF-8;';
set_time_limit(10000);
$name=$_GET['name'];
$start_time=$_GET['begin'];
$end_time=$_GET['end'];
$cmd=$set_charset.'/usr/bin/python3 /media/ubuntu/Newdisk/xyo/admin/aacc_80/wwwroot/dimianwendu.py '.$name.' '.$start_time.' '.$end_time.' 2> error.txt';
$l = exec($cmd,$res,$ret);

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
  //执行MySQL查询-设置UTF8格式
  // mysqli_query("SET NAMES utf8");  
  // mysqli_query()
  $sql = "SELECT DATE_FORMAT(weather.date,'%Y-%m-%d') time FROM test,weather where test.KID=weather.KID and weather.date >='$start_time' AND weather.date < '$end_time' group by time";
  $result = mysqli_query($dbc,$sql); 
  //定义变量json存储值
  $data="";
  $array= array();
  $array=$res;
  $time=array();
  class emp{
    public $time;
    public $value;
  }
  $array1= array();
  while ($row = mysqli_fetch_row($result))
  { 
    array_push($time,$row);  
    
    //数组赋值
   
  }
  for ($i=0;$i<count($time);$i++){
    $array1[] = [$time[$i][0],floatval($array[$i])];
  }
 
$data = json_encode($array1);
echo $data;

?>