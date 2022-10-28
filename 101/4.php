<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','OOV');
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
  $sql = "SELECT time,count(*) app FROM `oov` GROUP BY time;";
  $result = mysqli_query($dbc,$sql); 
  //定义变量json存储值
  $data="";
  $array= array();
  class emp{
    public $time;
    public $app;
  }
  while ($row = mysqli_fetch_row($result))
  { 
    list($time,$app) = $row;     
    //数组赋值
    $array[] = [$time,intval($app)];
  }
  $data = json_encode($array);
  echo $data;
?>