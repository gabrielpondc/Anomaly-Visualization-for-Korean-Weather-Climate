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
$sql1 = 'SELECT test.longitude,test.latitude,dataset.score,test.city FROM dataset,test where dataset.KID=test.KID  and dataset.date="'.$date.'"';
$result1 = mysqli_query($dbc,$sql1);
class cat{
    public $data;
  }


$ca=new emp();
$score=array();
class emp{
    public $lng;
    public $lat;
    public $score;
    public $title;
}
while ($row = mysqli_fetch_row($result1))
  { 
    list($ln,$la,$sco,$name) = $row;
    
    $cg=new emp();
    $cg->score= $sco;
    $cg->lng= $ln;
    $cg->lat= $la;
    $cg->title=$name;
     //数组赋值
    $array[] = $cg;
  }
$ca->data=$array;

$data = json_encode($ca);
echo $data;

?>