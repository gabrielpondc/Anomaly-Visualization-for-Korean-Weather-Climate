<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','gjk19961226');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');
$sqlb="select id,dia-(de+cur) nowdia,dia,sus,cur,de,FORMAT(cur/(dia-(de+cur)),5) swl from  kr";
$resb=mysqli_query($dbc,$sqlb);
$resultb=mysqli_fetch_array($resb);
$sqld="SELECT city,dia-(de+cu) nowdia,cu,de,dia FROM krcity";
$resd=mysqli_query($dbc,$sqld);
$resultd=mysqli_fetch_array($resd);
$sqla="select a.*,b.de,b.cu FROM (SELECT * FROM krcity) a LEFT OUTER JOIN (SELECT * FROM krc ) b ON a.city=b.city order by a.dia desc";
$resa=mysqli_query($dbc,$sqla);
$resulta=mysqli_fetch_array($resa);
$sqlh="select id,time,dia,sus,cur,de from  krhistory";
$resh=mysqli_query($dbc,$sqlh);
$resulth=mysqli_fetch_array($resh);
$sqle="select updatetime,catchtime  from  time";
$rese=mysqli_query($dbc,$sqle);
$resulte=mysqli_fetch_array($rese);
$sqlc="select dia,sus,de,res  from  dom";
$resc=mysqli_query($dbc,$sqlc);
$resultc=mysqli_fetch_array($resc);
$sqlf="select location,dia,res,de,dia-(res+de) nowdia from  global order by nowdia desc";
$resf=mysqli_query($dbc,$sqlf);
$resultf=mysqli_fetch_array($resf);
$sqlg="select * from  krc where id=18";
$resg=mysqli_query($dbc,$sqlg);
$resultg=mysqli_fetch_array($resg);
$sqli="select * from  krnews ";
$resi=mysqli_query($dbc,$sqli);
$resulti=mysqli_fetch_array($resi);
$sqlj="SELECT city,dia-(de+cu) dia,cu,de FROM krcity order by dia asc";
$resj=mysqli_query($dbc,$sqlj);
$resultj=mysqli_fetch_array($resj);
$sqlk="select kr.dia-(b.dia+b.cur+b.de) ondia,kr.cur-b.cur oncur,kr.de-b.de onde,kr.dia-(kr.cur+kr.de+b.dia) onnow from (SELECT * FROM krhistory WHERE DATEDIFF(time,NOW())=-1) b,kr";
$resk=mysqli_query($dbc,$sqlk);
$resultk=mysqli_fetch_array($resk);

?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>韩国疫情状况</title>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?c2be75c7b1373fe7c0712b4ee41fc07e";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

    <script type="text/javascript" src="js/world.js"></script>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script type="text/javascript" src="js/echarts.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="component.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-gl/dist/echarts-gl.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-stat/dist/ecStat.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/extension/dataTool.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/map/js/china.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/map/js/world.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/extension/bmap.min.js"></script>
    <style>
        @-webkit-keyframes rotate-animation {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes rotate-animation {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-webkit-keyframes move-animation {
            0% {
                -webkit-transform: translate(0, 0);
                transform: translate(0, 0);
            }
            25% {
                -webkit-transform: translate(-64px, 0);
                transform: translate(-64px, 0);
            }
            75% {
                -webkit-transform: translate(32px, 0);
                transform: translate(32px, 0);
            }
            100% {
                -webkit-transform: translate(0, 0);
                transform: translate(0, 0);
            }
        }
        @-webkit-keyframes move-animation {
            0%{
                -webkit-transform: translate(0,0);
                transform: translate(0,0);
            }
        }
        @keyframes move-animation {
            0% {
                -webkit-transform: translate(0, 0);
                transform: translate(0, 0);
            }
            25% {
                -webkit-transform: translate(-64px, 0);
                transform: translate(-64px, 0);
            }
            75% {
                -webkit-transform: translate(32px, 0);
                transform: translate(32px, 0);
            }
            100% {
                -webkit-transform: translate(0, 0);
                transform: translate(0, 0);
            }
        }
        body {
            background-color: #F5F5F5;
        }

        .circle-loader {
            display: block;
            width: 64px;
            height: 64px;
            margin-left: -32px;
            margin-top: -32px;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform-origin: 16px 16px;
            transform-origin: 16px 16px;
            -webkit-animation: rotate-animation 5s infinite;
            animation: rotate-animation 5s infinite;
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
        }
        .circle-loader .circle {
            -webkit-animation: move-animation 2.5s infinite;
            animation: move-animation 2.5s infinite;
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
            position: absolute;
            left: 50%;
            top: 50%;
        }
        .circle-loader .circle-line {
            width: 64px;
            height: 24px;
            position: absolute;
            top: 4px;
            left: 0;
            -webkit-transform-origin: 4px 4px;
            transform-origin: 4px 4px;
        }
        .circle-loader .circle-line:nth-child(0) {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        .circle-loader .circle-line:nth-child(1) {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }
        .circle-loader .circle-line:nth-child(2) {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        .circle-loader .circle-line:nth-child(3) {
            -webkit-transform: rotate(270deg);
            transform: rotate(270deg);
        }
        .circle-loader .circle-line .circle:nth-child(1) {
            width: 8px;
            height: 8px;
            top: 50%;
            left: 50%;
            margin-top: -4px;
            margin-left: -4px;
            border-radius: 4px;
            -webkit-animation-delay: -0.3s;
            animation-delay: -0.3s;
        }
        .circle-loader .circle-line .circle:nth-child(2) {
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-top: -8px;
            margin-left: -8px;
            border-radius: 8px;
            -webkit-animation-delay: -0.6s;
            animation-delay: -0.6s;
        }
        .circle-loader .circle-line .circle:nth-child(3) {
            width: 24px;
            height: 24px;
            top: 50%;
            left: 50%;
            margin-top: -12px;
            margin-left: -12px;
            border-radius: 12px;
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }
        .circle-loader .circle-blue {
            background-color: #1f4e5a;
        }
        .circle-loader .circle-red {
            background-color: #ff5955;
        }
        .circle-loader .circle-yellow {
            background-color: #ffb265;
        }
        .circle-loader .circle-green {
            background-color: #00a691;
        }
    </style>
</head>
<div class="page" id="none">
    <div class="circle-loader">
        <div class="circle-line">
            <div class="circle circle-blue"></div>
            <div class="circle circle-blue"></div>
            <div class="circle circle-blue"></div>
        </div>
        <div class="circle-line">
            <div class="circle circle-yellow"></div>
            <div class="circle circle-yellow"></div>
            <div class="circle circle-yellow"></div>
        </div>
        <div class="circle-line">
            <div class="circle circle-red"></div>
            <div class="circle circle-red"></div>
            <div class="circle circle-red"></div>
        </div>
        <div class="circle-line">
            <div class="circle circle-green"></div>
            <div class="circle circle-green"></div>
            <div class="circle circle-green"></div>
        </div>
    </div>
</div>

<script>
    document.onreadystatechange = function(){
        if(document.readyState=="complete")
        {
            document.getElementById('none').style.display="none"
        }
    }
</script>
<div id="container" style="height: 600px"></div>
<body style="height: 100%; margin: 0">

    <script type="text/javascript">
        var dom = document.getElementById("c");
        var m = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            tooltip: {},
            visualMap: {
                min: 0,
                max: 1000,
                type: 'piecewise',
                orient: 'horizontal',
                left: 'center',
                top: 65,
                pieces: [
                    {max:0,label:"0增长",color:'#ffffff'},
                    {min: 1, max: 50, label: '1-50例', color: '#ffa26b'},
                    {min: 51, max: 100, label: '50-100例', color: '#ff8604'},
                    {min: 101, max: 200, label: '100-200例', color: '#bb2d00'},
                    {min: 201, max: 800, label: '200-800例', color: '#811100'},
                    {min: 801, label: '800例以上', color: '#3b0c00'}
                ],
                textStyle: {
                    color: '#000'
                }
            },
            calendar: {
                top: 120,
                left: 30,
                right: 30,
                cellSize: ['auto', 13],
                range: '2020',
                itemStyle: {
                    borderWidth: 0.5
                },
                monthLabel:{
                    nameMap: 'cn'
                },
                dayLabel:{
                    nameMap: ['7', '1', '2', '3', '4', '5', '6'],
                    firstDay: 1
                },
                yearLabel: {show: false}
            },
            series: {
                type: 'heatmap',
                coordinateSystem: 'calendar',
                data: [<?php
                    foreach ($resh as $row){
                        echo "[\"{$row['time']}\",{$row['sus']}],";
                    };
                    ?>]
            }
        };
        ;
        if (option && typeof option === "object") {
            m.setOption(option, true);
        };
        window.addEventListener("resize",function (){
            m.resize()
        });
    </script>

</body>
</html>
