<?php
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');
$sqld="SELECT city,KID,cu,de,dia,newdia FROM test order by dia desc";
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
    <link rel="stylesheet" href="bootstrap.min.css">
    <script type="text/javascript" src="http://cdn.bootcdn.net/ajax/libs/echarts/5.3.2/echarts.common.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
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

    <script type="text/javascript">
    var city='Loading'
    var data = [];
    var getting={
                type: "get",
                async: false,
                url: "./2.php?name=<?php echo $location ?>",
                data: {},
                dataType: "json",
                success: function(result){
                    
                    if(result){
                        data=result;
                        dateList = data.map(function (item) { return item[0];});
                        valueList = data.map(function (item) {return item[1];});
                    }

                },
                error: function(errmsg) {
                    
                }
                
            };
    function draw(dateList,valueList,city){
    var dom = document.getElementById('container');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    var option;
    // prettier-ignore
    option = {

      title: [
      {
        left: 'center',
        text: city+' 날씨 정보'
      },
      {
        top: '45%',
        left: 'center',
        text: city+' 날씨 정보'
      }
    ],
        tooltip: {
          trigger: 'axis'
        },
        xAxis: [
        {
        type: "category",
          gridIndex: 0,
          data: dateList
        },
        {
        type: "category",
          data: dateList,
          gridIndex: 1
        }
      ],
        yAxis:[{
            type: 'value',
          gridIndex: 0,
          axisLabel: {
            formatter: '{value} °C'
          }
            },
         {
          type: 'value',
          gridIndex: 1,
          axisLabel: {
            formatter: '{value} °C'
          }
        }],
        grid: [
          {
            bottom: '60%'
          },
          {
            top: '60%'
          }
        ],
        dataZoom: [{
                  textStyle: {
                      color: '#8392A5'
                  },
                  start:0,
                  xAxisIndex: [0, 1], // 对应网格的索引
                  handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                  handleSize: '50%',
                  left:"center",                           //组件离容器左侧的距离,'left', 'center', 'right','20%'
                  top:"90%",                                //组件离容器上侧的距离,'top', 'middle', 'bottom','20%'
                  right:"auto",                             //组件离容器右侧的距离,'20%'
                  bottom:"auto",
                  orient:"horizontal",
                  dataBackground: {
                      areaStyle: {
                          color: '#8392A5'
                      },
                      lineStyle: {
                          opacity: 0.8,
                          color: '#8392A5'
                      }
                  }
              }, {
                  zoomOnMouseWheel:true,                   //如何触发缩放。可选值为：true：表示不按任何功能键，鼠标滚轮能触发缩放。false：表示鼠标滚轮不能触发缩放。'shift'：表示按住 shift 和鼠标滚轮能触发缩放。'ctrl'：表示按住 ctrl 和鼠标滚轮能触发缩放。'alt'：表示按住 alt 和鼠标滚轮能触发缩放。
                  moveOnMouseMove:true,
                  type: 'inside'
              }],
        series: [
          {
            name: 'Temperature',
            type: 'line',
            data: valueList,
            markPoint: {
              data: [
                { type: 'max', name: 'Max' },
                { type: 'min', name: 'Min' }
              ]
            }
          },
          {
            name: 'Temperature',
            type: 'line',
            xAxisIndex: 1,
            yAxisIndex: 1,
            data: valueList,
            markPoint: {
              data: [
                { type: 'max', name: 'Max' },
                { type: 'min', name: 'Min' }
              ]
            }
          }
        ]
      };
if (option && typeof option === 'object') {
      myChart.setOption(option);
    };
    window.addEventListener('resize', myChart.resize);
    };
draw(['0000-00-00'],[0],city); 
setInterval(function setusers() {
            $.ajax(getting);
            draw(dateList,valueList,"<?php echo $location ?>");},5000);


    
  </script>
</div>
</body>
</html>
