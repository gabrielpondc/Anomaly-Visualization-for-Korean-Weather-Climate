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
$sql1 = 'SELECT coordinates.latitude,coordinates.longitude,anomalyscore.score,coordinates.city,anomalyscore.date FROM anomalyscore,coordinates where anomalyscore.KID=coordinates.KID  and anomalyscore.date="'.$date.'"';
$result1 = mysqli_query($dbc,$sql1);

class zong{
    public $type;
    public $features;
  }
class emp{
    public $type1;
    public $type2;
}
$linshi=new emp();
$type10="Feature";
$type12="Point";
$linshi->type1=$type10;
$linshi->type2=$type12;
$all=new zong();
$type11="FeatureCollection";
$all->type=$type11;
class neibu{
  public $type;
  public function __construct()
  {
      $this->geometry = new neibu1();
      $this->properties = new neineibu();
  }

  
}
class neibu1{
  public $type;
  public $coordinates;
}
class neineibu{
  public $capacity;
  public $city;
  public $date;
}
$arr=array();
while ($row = mysqli_fetch_row($result1))
  { 
    list($la,$ln,$sc,$ci,$da) = $row;
    $arr=[floatval($ln),floatval($la)];
    $ne=new neibu();
    $ne->type= $type10;
    $ne->geometry->type=$type12;
    $ne->geometry->coordinates=$arr;
    $ne->properties->capacity=floatval($sc);
    $ne->properties->city=$ci;
    $ne->properties->date=$da;
     //数组赋值
    $array[] = $ne;
  }
$all->features=$array;

$data = json_encode($all);
echo $data;

?>