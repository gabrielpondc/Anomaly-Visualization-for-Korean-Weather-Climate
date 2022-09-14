<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','caucse.club');
DEFINE ('DB_NAME','oov');
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
  $sql = "select word from oov";
  $result = mysqli_query($dbc,$sql); 
  $sqla = "select emp.word,oov.id categoty,emp.id position from (select word,id,link from oov union select mean.meaning,mean.position,mean.id from mean) emp,oov  where emp.link=oov.link order by position";
  $resulta = mysqli_query($dbc,$sqla); 
  $sqlc = "select oov.id source,position.target target from position,oov WHERE  position.id=oov.link";
  $resultc = mysqli_query($dbc,$sqlc); 
  //定义变量json存储值
  $data="";
  $array= array();
  $datab="";
  $arrayb= array();
  $datac="";
  $arrayc= array();
  class emp{

    public $categories;
    public $nodes;
    public $links;
  }
  $gz = new emp();
  $type="force";

  class ces{
    public $name;
    public $keyword;
  }
class kw{
  public $bbb;
};

class nd{
    public $name;
    public $value;
    public $category;

  }
  class st{
    public $source;
    public $target;

  }

while ($row = mysqli_fetch_row($result))
  { 
    list($word) = $row; 
    $cg=new ces();
    $cg->name= $word;
    $pp=new kw();
    $cg->keyword= $pp;
     //数组赋值
    $array[] = $cg;
  }
 $gz->categories=$array;
  while ($rowa = mysqli_fetch_row($resulta))
  { 
    list($oov,$categoty) = $rowa;  
    $n=new nd();
    $n->name= $oov;
    $n->value=0;
    $n->category=(int)$categoty;
     //数组赋值
    $arrayb[] = $n;
  }
  $gz->nodes=$arrayb;
  while ($rowc = mysqli_fetch_row($resultc))
  { 
    list($source,$target) = $rowc;   
    $yy= new st();
    $yy->source=(int)$source;
    $yy->target=(int)$target;
    $arrayc[] = $yy;
  }
  $gz->links=$arrayc;
  $data = json_encode($gz);
  echo $data;
  
?>