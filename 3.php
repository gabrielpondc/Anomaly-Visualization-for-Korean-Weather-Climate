<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$location=$_GET['name'];
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
  $sql = "SELECT KID,city,dia FROM test";
  $result = mysqli_query($dbc,$sql); 
  //定义变量json存储值
  $data="";
  $array= array();
  class emp{
    public $city;
    public $KID;
    public $dia;
  }
while ($row = mysqli_fetch_row($result))
  { 
    list($KID,$city,$dia) = $row;   
    $a='{"c":[{"v":"KR-'.$KID.'","f":"'.$city.'"},{"v":'.$dia.'},{"v":"날씨 점수:'.$dia.'"}]}';
     //数组赋值
    $array[] = $a;
  }
  $str='';
  $str=join(',',$array);
  $data = json_encode('{"cols":[{"id":"","label":"Country","pattern":"","type":"string"},{"id":"","label":"Value","pattern":"","type":"number"},{"type":"string","role":"tooltip","p":{"role":"tooltip"}}],"rows":['.$str.']}');
  
  echo $data;
?>