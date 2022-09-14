<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$name=$_GET['name'];
$begin=$_GET['begin'];
$end=$_GET['end'];
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
header("content-type:text/json;charset=utf-8");
$db_selected=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
  if (!$db_selected) 
  { 
    die ("Can\'t use  " ); 
  } 
$sql = "SELECT DATE_FORMAT(dataset.date,'%Y-%m-%d') time FROM test,dataset where test.KID=dataset.KID and dataset.date >='$begin' AND dataset.date < '$end' group by time";
$sql1 = 'SELECT dataset.score FROM dataset,test where dataset.KID=test.KID and test.city= "'.$name.'" and dataset.date>="'.$begin.'" AND dataset.date < "'.$end.'"';
$result = mysqli_query($dbc,$sql); 
$result1 = mysqli_query($dbc,$sql1);
$arr1=mysqli_fetch_all($result1);
$time=array();
$array1= array();
while ($row = mysqli_fetch_row($result))
{ 
    array_push($time,$row);  
    
    //数组赋值
   
}
for ($i=0;$i<count($time);$i++){
    $array1[] = [$time[$i][0],floatval($arr1[$i][0])];
}
$data = json_encode($array1);
echo $data;

?>