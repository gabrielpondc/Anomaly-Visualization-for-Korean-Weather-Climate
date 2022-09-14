<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');
$sqld="SELECT city,KID,cu,de,dia,newdia FROM test";
$resd=mysqli_query($dbc,$sqld);
$resultd=mysqli_fetch_array($resd);

$location=$_GET['name'];
if ($location) {
    $sqla="SELECT test.city,chart.KID,time,value FROM chart,test where chart.KID=test.KID and city='$location'";
    $resa=mysqli_query($dbc,$sqla);
    $resulta=mysqli_fetch_array($resa);
}else{
 $location='Anomaly Visualization for Weather and Climate';
}
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Korea weather-<?php echo $location ?></title>
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
    <style>
        * {
            margin: 0px;
            padding: 0px;            /*  去掉所有标签的marign和padding的值  */
        }
        ul {
            list-style: none;           /*  去掉ul标签默认的点样式  */
        }
        #mar {
            width: auto;
            -moz-border-radius: 1px;      /* Gecko browsers */
            -webkit-border-radius: 1px;   /* Webkit browsers */

            text-align: center;               /* 让新闻内容靠左 */
        }
        #marBox {
            height: 24px;//可改为24，则只显示一条;
            width: auto;
            overflow: hidden;    /*  这个一定要加，超出的内容部分要隐藏，免得撑高中间部分 */
        }
        #mar ul li {
            height: 24px;
        }
        #mar ul li a {
            width: 180px;
            float: left;
            display: block;
            overflow: hidden;
            text-indent: 15px;
            height: 24px;
        }
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
        .page{
            background-color: white;
        }
        .left {
        float: left;
        width: 50%;
        height: 400px;
    
      }
      .right {
        float: left;
        width: 50%;
        height: 400px;
      }
    </style>
</head>

<body>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.counter-value').each(function(){
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            },{
                duration: 3500,
                easing: 'swing',
                step: function (now){
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });
</script>
<div style="width: 100%;height:100%;text-align: center; ">
   
    <h1 style="font-size: 35pt;"><?php echo $location ?></h1>
    </table>

    <script type="text/javascript">
        var aera=document.getElementById("marBox");
        aera.innerHTML+=aera.innerHTML;//实现无缝滚动，克隆自身
        aera.scrollTop=0;//初始值
        var iLiHeight=24;//行间距，可改为48，则两行显示
        var timer;//定时器
        var speed=50;
        var delay=3000;
        function startMove(){
            aera.scrollTop++;
            timer=setInterval('scrollUp()',speed)
        }
        function scrollUp(){
            //aera.scrollTop++;
            if (aera.scrollTop%iLiHeight==0) {
                clearInterval(timer);
                setTimeout('startMove()',delay);
            } else{
                aera.scrollTop++;
                if (aera.scrollTop>=aera.scrollHeight/2) {
                    aera.scrollTop=0;
                }
            }
        }
        setTimeout("startMove()",delay);

    </script>

<div class="left"><div id="main" style="width: 100%;height: 400px;width: auto"></div></div>
<div class="right"><div id="container" style="width: 100%;height: 400px;width: auto"></div></div>

<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type='text/javascript'>google.load('visualization', '1', {'packages': ['geochart']});
var KID=[];
var getting={
  type: "get",
  async: false,
  url: "./3.php",
  data: {},
  dataType: "json",
  success: function(result){
      
      if(result){
        KID = result;
        
      }

  },
  error: function(errmsg) {
      
  }
  
};
function ppd(){
    $.ajax(getting);
    google.setOnLoadCallback(drawVisualization);
};
ppd();
function drawVisualization() 
{
	var shuju = new google.visualization.DataTable(KID);
    var ivalue = new Array();
    ivalue['KR-41'] = '경기도';
    ivalue['KR-11'] = '서울특별시';
    ivalue['KR-26'] = '부산광역시';
    ivalue['KR-48'] = '경상남도';
    ivalue['KR-28'] = '인천광역시';
    ivalue['KR-47'] = '경상북도';
    ivalue['KR-27'] = '대구광역시';
    ivalue['KR-44'] = '충청남도';
    ivalue['KR-45'] = '전라북도';
    ivalue['KR-46'] = '전라남도';
    ivalue['KR-43'] = '충청북도';
    ivalue['KR-29'] = '광주광역시';
    ivalue['KR-42'] = '강원도';
    ivalue['KR-30'] = '대전광역시';
    ivalue['KR-31'] = '울산광역시';
    ivalue['KR-49'] = '제주특별자치도';
    ivalue['KR-50'] = '세종특별자치시';
    ivalue['KR-0'] = '평균';
	var options = {
		backgroundColor: {fill:'#FFFFFF',stroke:'#FFFFFF' ,strokeWidth:0 },
		colorAxis:  {minValue: 0, maxValue: 1000000,  colors: ['#b5b5b5','#b5b5b5','#f6b791','#f6b791','#f6b791','#f6b791','#e86832','#e86832','#e86832','#e86832','#be3128','#be3128','#be3128','#be3128','#a21508','#a21508','#a21508','#a21508','#4b0906','#4b0906','#380909','#380909',]},
		legend: 'none',	
		backgroundColor: {fill:'#FFFFFF',stroke:'#FFFFFF' ,strokeWidth:0 },	
		datalessRegionColor: '#f5f5f5',
		displayMode: 'regions', 
		enableRegionInteractivity: 'true', 
		resolution: 'provinces',
		sizeAxis: {minValue: 1, maxValue:1,minSize:10,  maxSize: 10},
		region:'KR', //country code
		keepAspectRatio: true,
		tooltip: {textStyle: {color: '#444444'}, trigger:'focus'}	
	};

	var chart = new google.visualization.GeoChart(document.getElementById('main')); 
	google.visualization.events.addListener(chart, 'select', function() {
	 	var selection = chart.getSelection();
	 	if (selection.length == 1) {
	 		var selectedRow = selection[0].row;
	 		var selectedRegion = shuju.getValue(selectedRow, 0);
	 		if(ivalue[selectedRegion] != '') {
                window.location.href="?name="+ivalue[selectedRegion]; 
	 		}
	 	}
	});
    window.addEventListener('resize',function () {
        chart.draw(shuju, options);
  });
  chart.draw(shuju, options);
};
setInterval(function setusers() {
            ppd();
            },3600000);
 </script>
</div>
</body>
</html>
