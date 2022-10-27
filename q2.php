<?php 
$set_charset = 'export LANG=ko_KR.UTF-8; ';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nnam = $_POST["nname"];
    echo "	<script type='text/javascript'>document.title='查询'+$nnam+'中'</script>";
    $cmd=$set_charset.'/usr/bin/python3 /media/ubuntu/Newdisk/xyo/admin/localhost_80/wwwroot/cha.py '.$nnam.' 2>error2.txt';
    $l = shell_exec($cmd);
    $array=$l;
    header("refresh:2;url=cha.php");

}
?>
<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta charset="utf-8"/>
<title>请输入货物管理番号信息</title>
<form  action="q2.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
                    <div id="login">
                        <div><span >货物管理番号</span><input name="nname" type="text" class="form-control"></div><br/>
                    
                        <label><input type="submit" value="确认"></label>
                    </div>
                </form>