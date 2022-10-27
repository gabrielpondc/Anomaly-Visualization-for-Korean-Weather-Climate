<?php 
ini_set("max_execution_time",1000000000);
$set_charset = 'export LANG=ko_KR.UTF-8;';
set_time_limit(1000000000);
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
$sql1 = "SELECT DATE_FORMAT(weather.date,'%Y-%m-%d') time FROM coordinates,weather where coordinates.KID=weather.KID and weather.date >='$begin' AND weather.date < '$end' group by time";
$result1 = mysqli_query($dbc,$sql1); 
$sql = 'SELECT weather.temperature FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$result = mysqli_query($dbc,$sql); 
$sqlshidu = 'SELECT weather.humidity FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$resultshidu = mysqli_query($dbc,$sqlshidu); 
$sqlzhengqiya = 'SELECT weather.vaporpressure FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$resultzhengqiya = mysqli_query($dbc,$sqlzhengqiya);
$sqlludianwendu = 'SELECT weather.dewpointtemperature FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$resultludianwendu = mysqli_query($dbc,$sqlludianwendu);
$sqldangdiqiya = 'SELECT weather.localairpressure FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$resultdangdiqiya = mysqli_query($dbc,$sqldangdiqiya);
$sqlhaimianqiya = 'SELECT weather.seasurfacepressure FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$resulthaimianqiya = mysqli_query($dbc,$sqlhaimianqiya);
$sqldimianqiya = 'SELECT weather.groundtemperature FROM weather,coordinates where weather.KID=coordinates.KID and coordinates.city= "'.$name.'" and weather.date>="'.$begin.'" AND weather.date < "'.$end.'"';
$resultdimianqiya = mysqli_query($dbc,$sqldimianqiya);
$arr=mysqli_fetch_all($result);
$arrzhengqiya=mysqli_fetch_all($resultzhengqiya);
$arrshidu=mysqli_fetch_all($resultshidu);
$arrludianwendu=mysqli_fetch_all($resultludianwendu);
$arrdangdiqiya=mysqli_fetch_all($resultdangdiqiya);
$arrhaimianqiya=mysqli_fetch_all($resulthaimianqiya);
$arrdimianqiya=mysqli_fetch_all($resultdimianqiya);
$array1= array();
$time=array();
while ($row = mysqli_fetch_row($result1))
{ 
  array_push($time,$row);  
  
  //数组赋值
 
}
$arrayavg= array();
for ($i=0;$i<count($arr)/24;$i++){
    $sum=0;
    for ($j=0;$j<24;$j++){
        $sum=$sum+$arr[$j+($i*24)][0];
    }
    $arrayavg[]= $sum/24;
  }
$arrayavgshidu= array();
for ($i=0;$i<count($arrshidu)/24;$i++){
      $sumshidu=0;
      for ($j=0;$j<24;$j++){
          $sumshidu=$sumshidu+$arrshidu[$j+($i*24)][0];
      }
      $arrayavgshidu[]= $sumshidu/24;
    }
$arrayavgzhengqiya= array();
for ($i=0;$i<count($arrzhengqiya)/24;$i++){
      $sumzhengqiya=0;
      for ($j=0;$j<24;$j++){
          $sumzhengqiya=$sumzhengqiya+$arrzhengqiya[$j+($i*24)][0];
          }
          $arrayavgzhengqiya[]= $sumzhengqiya/24;
        }
$arrayavgludianwendu= array();
for ($i=0;$i<count($arrludianwendu)/24;$i++){
        $sumludianwendu=0;
       for ($j=0;$j<24;$j++){
          $sumludianwendu=$sumludianwendu+$arrludianwendu[$j+($i*24)][0];
          }
          $arrayavgludianwendu[]= $sumludianwendu/24;
         }
$arrayavgdangdiqiya= array();
for ($i=0;$i<count($arrdangdiqiya)/24;$i++){
        $sumdangdiqiya=0;
        for ($j=0;$j<24;$j++){
          $sumdangdiqiya=$sumdangdiqiya+$arrdangdiqiya[$j+($i*24)][0];
          }
          $arrayavgdangdiqiya[]= $sumdangdiqiya/24;
        }
$arrayavghaimianqiya= array();
for ($i=0;$i<count($arrhaimianqiya)/24;$i++){
        $sumhaimianqiya=0;
        for ($j=0;$j<24;$j++){
          $sumhaimianqiya=$sumhaimianqiya+$arrhaimianqiya[$j+($i*24)][0];
          }
          $arrayavghaimianqiya[]= $sumhaimianqiya/24;
        }
$arrayavgdimianqiya= array();
for ($i=0;$i<count($arrdimianqiya)/24;$i++){
          $sumdimianqiya=0;
          for ($j=0;$j<24;$j++){
            $sumdimianqiya=$sumdimianqiya+$arrdimianqiya[$j+($i*24)][0];
          }
            $arrayavgdimianqiya[]= $sumdimianqiya/24;
        }
for ($i=0;$i<count($time);$i++){
    $array1[] = [$time[$i][0],$arrayavg[$i],$arrayavgshidu[$i],$arrayavgzhengqiya[$i],$arrayavgludianwendu[$i],$arrayavgdangdiqiya[$i],$arrayavghaimianqiya[$i],$arrayavgdimianqiya[$i]];
  }

$data = json_encode($array1);
echo $data;

?>