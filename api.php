<?php 
ini_set("max_execution_time",10000);
$set_charset = 'export LANG=ko_KR.UTF-8;';
set_time_limit(10000);
$path=$_GET['path'];
$key=$_GET['key'];
$cmd=$set_charset.'/usr/bin/python3 /media/ubuntu/Newdisk/xyo/admin/localhost_80/wwwroot/graphemedding.py '.$path.' '.$key.'  2> error.txt';
$l = exec($cmd,$res,$ret);
class result{
    public $anomalytimeinterval;
}
$result=new result();
$result->anomalytimeinterval=$l;
$data = json_encode($result,JSON_UNESCAPED_SLASHES);
echo $data;
?>