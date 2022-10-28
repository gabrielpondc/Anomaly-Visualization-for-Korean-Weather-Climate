<?php 
ini_set("max_execution_time",10000);

set_time_limit(10000);
$path=$_GET['path'];
$key=$_GET['key'];
$cmd='F:\Users\caucse\AppData\Local\Programs\Python\Python38\python.exe F:\avwc\graphemedding.py '.$path.' '.$key.'  2> error.txt';
$l = exec($cmd,$res,$ret);
class result{
    public $abnormaltimeinterval;
}
$result=new result();
$result->abnormaltimeinterval=$l;
$data = json_encode($result,JSON_UNESCAPED_SLASHES);
echo $data;
?>