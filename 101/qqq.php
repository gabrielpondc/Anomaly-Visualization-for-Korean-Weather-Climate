<?php 
header("content-type:text/html;charset=utf-8");  
$cmd='F:\Users\caucse\AppData\Local\Programs\Python\Python38\python.exe F:\\avwc\\ppy.py';
$l = shell_exec($cmd);
$array=$l;
$data = json_encode($array);
echo $data;


?>