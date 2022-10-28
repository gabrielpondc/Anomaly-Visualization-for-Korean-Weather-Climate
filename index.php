<?php
ini_set("max_execution_time",1000000000);
set_time_limit(1000000000);
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','caucse1234');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','virus');
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not to connect to Mysql:'.mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');
$sqld="SELECT city,KID FROM coordinates";
$resd=mysqli_query($dbc,$sqld);
error_reporting(E_ALL ^ E_WARNING); 
$resultd=mysqli_fetch_array($resd);

$location=$_GET['name'];
$begin=$_GET['begin'];
$end=$_GET['end'];
$date=$_GET['date'];
if ($location) {
    $sqla="SELECT coordinates.city,anomalyscore.KID FROM anomalyscore,coordinates where anomalyscore.KID=coordinates.KID and coordinates.city='$location'";
    
    $resa=mysqli_query($dbc,$sqla);
    $resulta=mysqli_fetch_array($resa);
}else{
 $location='Abnormal Weather Monitoring and Curation System';
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta charset="utf-8"/>
  <link rel="shortcut icon" href="we.png" type="image/png" />
	<title>Korea weather-<?php echo $location ?></title>
</head>


    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<style type="text/css">
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
    html, body {
       width: 100%;
       height: 100%; 
       overflow-x: hidden;
       margin:0 auto;padding:0px
    }
    .show {
      display: block;
      animation: bounceInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000);
    }
    .hidden {
      display: none;
      animation: fadenum 1s;
    }
    .footer{ 
      z-index:1;
      overflow:visible;
      text-align: center;
      background-color:rgba(155, 155, 155, 0.4);
      padding:1px 0 1px 0;
      width:100%;
      bottom:0px;
      position:absolute;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      -moz-backdrop-filter: blur(10px);
    } 
    #left {
        float: left;
        width: 415px;
        height: 100%;
        position:absolute;
        text-align: right;
        z-index:20;top:0;left:0;
        background-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 5px 15px rgba(20, 20, 20, 0.8);
        -moz-box-shadow:0 5px 15px rgba(20, 20, 20, 0.8);
        -webkit-box-shadow:0 5px 15px rgba(20, 20, 20, 0.8);
        overflow:scroll; 
        zoom:1; 
        overflow-x: hidden;
       animation: bounceInLeft 1s cubic-bezier(0.215, 0.610, 0.355, 1.000);
       backdrop-filter: blur(50px);
       -webkit-backdrop-filter: blur(50px);
       -moz-backdrop-filter: blur(50px);

      }

      #but {
        float: left;
        width: 35px;
        height: 30px;
        position:absolute;
        z-index:99;top:0;left:0;
      }
      .right {
        float: left;
        width: 70%;
        height: 100%;
        text-align: center;
      }
      .ce{
        text-align: center;
      }
      @keyframes bounceInLeft {
        0% {
          opacity: 0;
          transform: translate3d(-3000px, 0, 0);
        }
        60% {
          opacity: 1;
          transform: translate3d(25px, 0, 0);
        }
        75% {
          transform: translate3d(-10px, 0, 0);
        }
        90% {
          transform: translate3d(5px, 0, 0);
        }
        100% {
          transform: none;
        }
      }
 /*滚动条的宽度*/
::-webkit-scrollbar {
  width: 4px;
}

/*滚动条里面小方块*/
::-webkit-scrollbar-thumb {
  border-radius: 2px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
  background: rgba(0, 0, 0, 0.2);
}

/*滚动条里面轨道*/
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
  border-radius: 0;
  background: rgba(0, 0, 0, 0.1);
}
a:link.important,a:focus.important,a:active.important,a:visited.important{text-decoration: none;color: #004c97;}
a:link,a:focus,a:active,a:visited  {text-decoration: none;color: #004c97;}
a:hover { text-decoration: none;color: #004c97;}
a:hover.important{text-decoration: none;color: #004c97;}


.container {
  width: 100vw;
  overflow-x: hidden;
}

.hp{
  
  width:150px;
  text-align:center;
  padding:6px 0;
  backdrop-filter: blur(50px);
  -webkit-backdrop-filter: blur(50px);
  -moz-backdrop-filter: blur(50px);
  border-radius:6px;
  background-color:rgb(255, 255, 255);
}
.btb {
  float: right;
background: rgba(244, 246, 251,0.5);
 box-shadow: 15px 15px 30px #bebebe,-15px -15px 30px #ffffff;
 -webkit-box-shadow: 15px 15px 30px #bebebe,-15px -15px 30px #ffffff;
 -moz-box-shadow: 15px 15px 30px #bebebe,-15px -15px 30px #ffffff;
 backdrop-filter: blur(50px);
  -webkit-backdrop-filter: blur(50px);
  -moz-backdrop-filter: blur(50px);
  border-radius: 10px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;

}
.bt {
  height: 20px;
 width: 40x;
float: right;

}


.red {
  color: black;
 cursor: pointer;
 font-size: 13px;
 background-image: url(" data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 531.28 200'%3E%3Cdefs%3E%3Cstyle%3E .shape %7B fill: %2347ff8e /* fill: %230E1822; */ %7D %3C/style%3E%3C/defs%3E%3Cg id='Layer_2' data-name='Layer 2'%3E%3Cg id='Layer_1-2' data-name='Layer 1'%3E%3Cpolygon class='shape' points='415.81 200 0 200 115.47 0 531.28 0 415.81 200' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E%0A");
 background-color: rgba(163, 185, 207, 0.2);
 background-size: 200%;
 background-position: 200%;
 background-repeat: no-repeat;
 transition: 0.3s ease-in-out;
 transition-property: background-position, color;
 z-index: 1;


}

.red:hover {
  color: #202640;
 background-position: 40%;
}

.blue {
  color: white;
 cursor: pointer;
 font-size: 13px;
 background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 531.28 200'%3E%3Cdefs%3E%3Cstyle%3E .shape %7B fill: %23FF4655 /* fill: %230E1822; */ %7D %3C/style%3E%3C/defs%3E%3Cg id='Layer_2' data-name='Layer 2'%3E%3Cg id='Layer_1-2' data-name='Layer 1'%3E%3Cpolygon class='shape' points='415.81 200 0 200 115.47 0 531.28 0 415.81 200' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E%0A");
 background-color: #2f396a;
 background-size: 200%;
 background-position: 200%;
 background-repeat: no-repeat;
 transition: 0.3s ease-in-out;
 transition-property: background-position, color;
 z-index: 1;

}

.blue:hover {
 color: white;
 background-position: 40%;
}
.copyright{
      width:250px;
      height:250px;
      z-index:1;

      text-align: center;
      padding:1px 0 1px 0;
      bottom:0px;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      -moz-backdrop-filter: blur(10px);
      position:fixed; bottom:15px; right:0;
      background: rgba(255, 255, 255, 0.05);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      -webkit-border-radius: 8px;
      -moz-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      -moz-border-radius: 8px;
      transform: 0.5s;
      display: flex;
      justify-content: center;
      align-items: center;

}
/* From uiverse.io by @alexruix */
.card {
  width:250px;
  height:250px;
  z-index:1;
  text-align: center;
  padding:1px 0 1px 0;
  bottom:0px;
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  -moz-backdrop-filter: blur(10px);
  position:fixed; bottom:15px; right:0;
  background: rgba(255, 255, 255, 0.05);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  -webkit-border-radius: 8px;
  -moz-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  -moz-border-radius: 8px;
  transform: 0.5s;
  display: flex;
  justify-content: center;
  align-items: center;
 }
 
 .card::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 4;
  background-color: rgba(80, 64, 44, 0);
  transition: background-color 1s;
 }
 
 .card-info {
  position: absolute;
  width: 100%;
  padding: 1.5em;
  text-align: center;
  transition: transform 1s cubic-bezier(0.785, 0.135, 0.150, 0.860);
 }
 
 .card-bio {
  padding: 1.8em;
  transform: translate(100%,80%);
  transition: transform 1s cubic-bezier(0.788, 0.135, 0.150, 0.860);
 }
 
 .card-bio p {
  font-size: 16px;
  font-weight: 600;
  line-height: 1.5em;
 }
 
 
 /*Text*/
 .title {
  font-size: 1.3em;
  font-weight: bold;
 }
 
 .title::after {
  content: "";
  display: block;
  width: 50%;
  height: 2px;
  margin: 0 auto 4%;
  background-color: #000;
 }
 
 .subtitle {
  font-weight: 400;
  line-height: 1em;
 }
 
 
 
 /*Hover*/
 .card:hover::before {
  background-color: rgba(155, 155, 155, 0.4);
 }
 
 .card:hover .card-info {
  transform: translateX(-100%);
 }
 
 .card:hover .card-bio {
  transform: translate(0,-5%);
  opacity: 1;
 }
 
 
table,table tr th, table tr td { font-weight: bold;border:0px solid #0094ff; }
        table {
           width: 400px;
          min-height: 25px; 
          line-height: 25px; 
          text-align: center; 
          border-collapse: collapse; 
          padding:2px;
          font-size: 10px;

        }   
        .input {
 border: none;
 border-radius: 15px;
 padding: 5px;
 background-color: #e8e8e8;
 font-weight: bold;
}
.pt{
  float: right;

 background: royalblue;
 color: white;
 display: flex;
 align-items: center;
 border: none;
 border-radius: 4px;
 overflow: hidden;
 transition: all 0.2s;
}
.pt span {
 display: block;
 margin-left: 0.3em;
 transition: all 0.3s ease-in-out;
}
.pt svg {
 display: block;
 transform-origin: center center;
 transition: transform 0.3s ease-in-out;
}
.pt:hover .svg-wrapper {
 animation: fly-1 0.6s ease-in-out infinite alternate;
}

.pt:hover svg {
 transform: translateX(1.2em) rotate(45deg) scale(1.1);
}

.pt:hover span {
 transform: translateX(5em);
}

.pt:active {
 transform: scale(0.95);
}

@keyframes fly-1 {
 from {
  transform: translateY(0.1em);
 }

 to {
  transform: translateY(-0.1em);
 }
}


    </style>

<body>
<script type="text/javascript" src="//fastly.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>
<div style="width:100%;height:100%;position:relative;" >    
<div id='left'>
  
  <input class="bt blue" type="button" value="×" id="btn">
  <h3 style="text-align: center;font-size: 15pt;"><?php echo $location ?></h3>
    From <input class="input" type="date"  value-format="yyyy-MM-dd HH:mm" format="yyyy-MM-dd HH:mm" id="start" placeholder="Select date"> to <input class="input" type="date" value-format="yyyy-MM-dd HH:mm" format="yyyy-MM-dd HH:mm" id="end" placeholder="Select date">
    <button id="btn2" class='pt' onclick="acc()">
  <div class="svg-wrapper-1">
    <div class="svg-wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
        <path fill="none" d="M0 0h24v24H0z"></path>
        <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
      </svg>
    </div>
  </div>
  <span>Check</span>
</button>
<div id="container" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader2" style="float: left;width: 100%;line-height: 45px;text-align: center;">Temperature(°C)</p>
<div id="container3" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader3" style="float: left;width: 100%;line-height: 45px;text-align: center;">Humidity(%)</p>
<div id="container4" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader4" style="float: left;width: 100%;line-height: 45px;text-align: center;">Vapor pressure(hPa)</p>
<div id="container5" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader5" style="float: left;width: 100%;line-height: 45px;text-align: center;">Dew point temperature(°C)</p>
<div id="container6" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader6" style="float: left;width: 100%;line-height: 45px;text-align: center;">Local air pressure(hPa)</p>
<div id="container7" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader7" style="float: left;width: 100%;line-height: 45px;text-align: center;">Sea surface pressure(hPa)</p>
<div id="container8" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader8" style="float: left;width: 100%;line-height: 45px;text-align: center;">Ground temperature(°C)</p>
<div id="container9" style="width: 100%;height: 250px;width: auto"></div>
<p id="myHeader10" style="float: left;width: 100%;line-height: 45px;text-align: center;">Comparison1</p>
<div id="container11" style="width: 100%;height: 500px;width: auto"></div>
<p id="myHeader11" style="float: left;width: 100%;line-height: 45px;text-align: center;">Comparison2</p>
<div id="container12" style="width: 100%;height: 500px;width: auto"></div>
<p id="myHeader12" style="float: left;width: 100%;line-height: 45px;text-align: center;">Comparison3</p>
<div id="container13" style="width: 100%;height: 500px;width: auto"></div>





</div>
	<div id="map" style="width:100%;height:100%;"></div>
  <div id='but' class='hidden'><input class="bt red" type="button" value=">>" id="btn1"></div>
  <div class="card">
    <div class="card-info">
      <p class="title">Abnormal Weather Monitoring and Curation System</p>
      <p class="subtitle"><span>Powered by </span><a href='//www.oracle.com/cloud' target='_blank'><svg style="vertical-align:middle;" t="1659800786077" class="icon" viewBox="0 0 8165 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1761" width="60" height="20"><path d="M3398.499037 666.115306h520.24153l-274.800972-442.904953-504.499351 800.60224-229.885787 0.187407 614.069914-961.397353A143.303803 143.303803 0 0 1 3643.564782 0.008746c48.350978 0 92.703942 22.801172 118.878438 60.907239l616.193859 963.084015-230.073194-0.187407-107.883901-178.973581h-527.175585l-114.942893-178.723706z m2386.751699 178.911113V10.00378h-195.090574v916.669574c0 25.362399 10.307379 49.600357 28.423379 67.716357 19.115503 18.928096 44.352964 29.360413 71.464494 29.360413h888.995824l114.693017-178.661236H5785.250736z m-3225.2726-149.425762a342.829673 342.829673 0 0 0 0-685.596877H1706.777029v1013.808813h194.903167V188.665016h644.867113a163.856092 163.856092 0 0 1 164.043499 164.105968 163.98103 163.98103 0 0 1-164.043499 164.168437l-549.414537-0.187407 581.77346 507.060579h283.234282l-391.430527-328.399343 89.268149 0.187407zM506.935641 1023.812593a506.873172 506.873172 0 1 1 0-1013.808813h589.269735a506.935641 506.935641 0 0 1 506.873173 506.935641 506.935641 506.935641 0 0 1-506.873173 507.060579l-589.269735-0.187407z m576.151253-178.661236a328.086998 328.086998 0 0 0 328.149467-328.211936 328.086998 328.086998 0 0 0-328.149467-328.211936H519.991655a328.274405 328.274405 0 0 0 0 656.423872h563.095239z m3702.285608 178.661236a506.935641 506.935641 0 1 1 0-1013.808813h700.277084l-114.755487 178.723705h-572.340646a328.274405 328.274405 0 1 0 0 656.423872h702.838312l-114.505611 178.661236h-601.576121z m2384.752692-178.661236a328.086998 328.086998 0 0 1-315.593205-238.506504h833.335977l114.755486-178.723705-948.341339-0.062469a328.211936 328.211936 0 0 1 315.843081-239.193663l572.028302 0.062469 114.942893-178.723705h-700.277084a506.935641 506.935641 0 0 0 0 1013.808813h601.576121l114.505611-178.661236h-702.775843zM7961.482027 117.950149a89.455556 89.455556 0 1 1 179.036051 0 89.455556 89.455556 0 1 1-179.036051 0z m89.580494 114.318204l0 0z m-10.744661-181.597278c17.553779 0 24.800179 0.187407 33.420895 3.435793 22.488827 7.558745 24.800179 28.235972 24.800179 35.794717a49.975171 49.975171 0 0 1-1.374317 10.494785 34.795213 34.795213 0 0 1-15.867117 21.926607c-1.311848 0.999503-2.061476 1.624193-5.747145 2.99851l29.672758 53.098619h-28.673254l-25.987089-48.850729h-17.303903v48.78826h-24.987586V50.671075h32.046579z m8.933061 57.721323c7.683683-0.124938 16.241931-0.687159 21.239448-7.996028a18.990565 18.990565 0 0 0 2.873572-10.932068 16.86662 16.86662 0 0 0-9.62022-15.492303c-5.747145-2.248883-11.619227-2.248883-23.425861-2.248883h-7.058993v36.669282h15.992054z" fill="#FF0000" p-id="1762"></path></svg>  <svg style="vertical-align:middle;" id="u30brandtxt" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38.14 18.12" width="20" height="10"><path fill="#ffffff" d="M8.16,18.12a7.76,7.76,0,0,1-6.05-2.35A9.79,9.79,0,0,1,0,9.05,9.58,9.58,0,0,1,2.14,2.38,7.65,7.65,0,0,1,8.16,0a7.65,7.65,0,0,1,6,2.38,9.58,9.58,0,0,1,2.14,6.67,9.79,9.79,0,0,1-2.11,6.72A7.71,7.71,0,0,1,8.16,18.12Zm0-3.19a3.69,3.69,0,0,0,3.24-1.51,7.48,7.48,0,0,0,1.08-4.37A7.37,7.37,0,0,0,11.4,4.7,3.69,3.69,0,0,0,8.16,3.19,3.75,3.75,0,0,0,4.9,4.7,7.45,7.45,0,0,0,3.84,9.05,7.56,7.56,0,0,0,4.9,13.42,3.75,3.75,0,0,0,8.16,14.93ZM32,14v3.12a11.25,11.25,0,0,1-2.19.72,10.85,10.85,0,0,1-2.71.31q-4.2,0-6.36-2.38T18.54,8.86A9.81,9.81,0,0,1,19.6,4.13a7.18,7.18,0,0,1,3-3A9.38,9.38,0,0,1,27.23,0a10.19,10.19,0,0,1,2.35.26,9,9,0,0,1,1.9.68V4.1a15.34,15.34,0,0,0-2.21-.67,8.49,8.49,0,0,0-1.78-.19A4.85,4.85,0,0,0,23.7,4.7a6,6,0,0,0-1.32,4.16,6.85,6.85,0,0,0,1.3,4.48,4.66,4.66,0,0,0,3.81,1.56,10.24,10.24,0,0,0,2-.21A22.73,22.73,0,0,0,32,14Zm2.44,3.81V.34h3.74V17.78Z"></path></svg></a> <br> <span><h6>Get the name of constructor <svg t="1659804711797" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5022" width="20" height="20"><path d="M512 61.44a245.76 245.76 0 0 1 245.76 245.76v409.6a245.76 245.76 0 1 1-491.52 0v-409.6a245.76 245.76 0 0 1 245.76-245.76z m0 40.96a204.8 204.8 0 0 0-204.5952 195.91168L307.2 307.2v409.6a204.8 204.8 0 0 0 409.3952 8.88832L716.8 716.8v-409.6a204.8 204.8 0 0 0-204.8-204.8z" fill="#2c2c2c" p-id="5023"></path><path d="M552.96 634.88v81.92H471.04v-81.92h81.92z m0-163.84v81.92H471.04v-81.92h81.92z m0-163.84v81.92H471.04v-81.92h81.92z" fill="#2c2c2c" p-id="5024"></path></svg></h6></p>
    </div>
    <div class="card-bio">
      <p>Changes by<br><br>Yuxuan,Gu<br><br>Gen,Li<br><br>Jiakai,Gu<br><br>Jason J. Jung</p>
    </div>
  </div>
  <div class='footer'>CopyRight© 2022 Knowledge Engineering Laboratory (<a href='http://ke.cau.ac.kr/'>KEL</a>)
Chung-Ang University, Korea
</div>
</div>
    <script type="text/javascript">
      Date.prototype.format = function(fmt) { 
     var o = { 
        "M+" : this.getMonth()+1,                 //月份 
        "d+" : this.getDate(),                    //日 
        "h+" : this.getHours(),                   //小时 
        "m+" : this.getMinutes(),                 //分 
        "s+" : this.getSeconds(),                 //秒 
        "q+" : Math.floor((this.getMonth()+3)/3), //季度 
        "S"  : this.getMilliseconds()             //毫秒 
    }; 
    if(/(y+)/.test(fmt)) {
            fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length)); 
    }
     for(var k in o) {
        if(new RegExp("("+ k +")").test(fmt)){
             fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
         }
     }
    return fmt; 
};
      var temp;
        var date,date1;

    </script>
    

  <script>
    var weburl; 
    var weburl2;

    function apps(){
      document.getElementById('left').className='hidden'
    }// 给按钮注册事件
  </script>
  <?php
  if ($location=='Abnormal Weather Monitoring and Curation System') {
    echo "<script type=\"text/javascript\"> apps(); weburl='http://0.0.0.0';</script>";
    
  }else{
    echo "<script type=\"text/javascript\"> weburl='./xin.php?name=$location&begin=$begin&end=$end';</script>";
  }
  ?>
 
<link href='//api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
<script src='//api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
 <script src="l7.js"></script>
 <script>
  var ppp;
  var ppp1=[];
  var address='chushizhi.json';
  var scene = new L7.Scene({
    id: 'map',
    logoVisible:false,
    map: new L7.Mapbox({
          center: [127.859935,35.879258],
          zoom: 6.5,
          logo: false,
          style: {
            version: 8,
            sources: {
              'raster-tiles': {
                type: 'raster',
                tiles: [
                  // mt(0—3) Google地图使用了四个服务地址
                  // lyrs=
                  // m：路线图
                  // t：地形图
                  // p：带标签的地形图
                  // s：卫星图
                  // y：带标签的卫星图
                  // h：标签层（路名、地名等）
                  '//mt1.google.com/maps/vt?lyrs=m%40721&hl=ko-KR&gl=KR&x={x}&y={y}&z={z}',
                ],
                tileSize: 256,
              },
            },
            layers: [
              {
                id: 'google',
                type: 'raster',
                source: 'raster-tiles',
                // minZoom: 0,
                // "maxzoom": 18
              },
            ],
          },
        
      }),
  });
  scene.on('loaded', () => {
    fetch(
      address
    )
      .then(res => res.json())
      .then(data => {
        ppp=data
        data.features = data.features.filter(item => {
          return item.properties.capacity;
        });
        const pointLayer = new L7.PointLayer({})
          .source(data)
          .shape('simple')
          .size('capacity', [15, 15 ])
          .color('capacity',['#004c97', '#004c97', '#004c97'])
          .active(true)
          .style({
            opacity: 0.5,
            strokeWidth: 3
          });

        scene.addLayer(pointLayer);
        pointLayer.on('click', e => {
          ppp=e
          initPlane(e.feature.properties.city)
        })
      });
  });




function initPlane(loc) {
  window.location.href="?name="+loc; 
}

function rem(num){
  var a=num;
  scene.destroy();
  scene = new L7.Scene({
    id: 'map',
    logoVisible:false,
    map: new L7.Mapbox({
          center: [127.859935,35.879258],
          zoom: 6.5,
          logo: false,
          style: {
            version: 8,
            sources: {
              'raster-tiles': {
                type: 'raster',
                tiles: [
                  // mt(0—3) Google地图使用了四个服务地址
                  // lyrs=
                  // m：路线图
                  // t：地形图
                  // p：带标签的地形图
                  // s：卫星图
                  // y：带标签的卫星图
                  // h：标签层（路名、地名等）
                  '//mt1.google.com/maps/vt?lyrs=m%40721&hl=ko-KR&gl=KR&x={x}&y={y}&z={z}',
                ],
                tileSize: 256,
              },
            },
            layers: [
              {
                id: 'google',
                type: 'raster',
                source: 'raster-tiles',
                // minZoom: 0,
                // "maxzoom": 18
              },
            ],
          },
        
      }),
  });
  scene.on('loaded', () => {
    fetch(
      a
    )
      .then(res => res.json())
      .then(data => {
        ppp=data
        data.features = data.features.filter(item => {
          return item.properties.capacity;
        });
        const pointLayer = new L7.PointLayer({})
          .source(data)
          .shape('circle')
          .size('capacity', [ 10, 30 ])
          .color('capacity',['#1059b3', '#b36f10', '#ab2020'])
          .active(true)
          .style({
            opacity: 0.3,
            strokeWidth: 0
          });

        scene.addLayer(pointLayer);
        pointLayer.on('click', e => {
          ppp=e
          ppp1=infor1(e.feature.properties.city,e.feature.properties.date)
          draw10(ppp1)
        })
      });
  });
}




// 获取元素
var btn = document.getElementById('btn');
var but=document.getElementById('but');
var btn1=document.getElementById('btn1');
var box = document.getElementById('left');
var isShow = true; // 默认div显示

btn.onclick = function () {
	if (isShow) {
		box.className = 'hidden'; // 控制div的显示，改变class属性值 class在js中是关键字，不可以作为变量或者属性的名字 用className代替
		// btn.value = '显示';
		but.className='show';
		isShow = false;
	} else {
		box.className = 'show';
		// btn.value = '隐藏';
		isShow = true;
	}
}
btn1.onclick = function () {
	if (isShow) {
		 // 控制div的显示，改变class属性值 class在js中是关键字，不可以作为变量或者属性的名字 用className代替
		// btn.value = '显示';
		but.className='hidden';
		isShow = false;
	} else {
    but.className='hidden';
    box.className = 'show';
		// btn.value = '隐藏';
		isShow = true;
	}
}
        </script>
   <script type="text/javascript">
    function sleep(ms){
   var start=Date.now(),end = start+ms;
   while(Date.now() < end);
   return;
};
    var btn2;
    var btn3;
    var city='Loading';
    var data = [];
    var dateList,valueList;
    var wendulist;
    var wenduvaluelist=[];
    var newdataList;
    var newdataList2;
    var data2=[];
    var data3=[];
    var name;
    var dataqqq;
    var qqq;
    var wendu,shidu;
    var shiduvaluelist=[];
    var zhengqiyavaluelist=[];
    var ludianwenduvaluelist=[];
    var dangdiqiyavaluelist=[];
    var haimianqiyavaluelist=[];
    var dimianwenduvaluelist=[];
    
    var getting={
                type: "get",
                async: false,
                url: weburl,
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
    var getting3={
                type: "get",
                async: true,
                timeout: 10000000,
                url: './qqq6.php?name=<?php echo $location ?>&begin=<?php echo $begin ?>&end=<?php echo $end ?>',
                data200: {},
                dataType: "json",
                success: function(result){
                    
                    if(result){
                        data200=result;
                        wendulist = data200.map(function (item) { return item[0];});
                        wenduvaluelist = data200.map(function (item) {return item[1];});
                        shiduvaluelist = data200.map(function (item) {return item[2];});
                        zhengqiyavaluelist = data200.map(function (item) {return item[3];}); 
                        ludianwenduvaluelist = data200.map(function (item) {return item[4];});
                        dangdiqiyavaluelist = data200.map(function (item) {return item[5];});
                        haimianqiyavaluelist = data200.map(function (item) {return item[6];});
                        dimianwenduvaluelist = data200.map(function (item) {return item[7];});

                    }

                },
                error: function(errmsg) {
                  if(errmsg){
                    data2=errmsg;
                    wendulist = data200.map(function (item) { return item[0];});
                    wenduvaluelist = data200.map(function (item) {return item[1];});
                    shiduvaluelist = data200.map(function (item) {return item[2];});
                    zhengqiyavaluelist = data200.map(function (item) {return item[3];}); 
                    ludianwenduvaluelist = data200.map(function (item) {return item[4];});
                    dangdiqiyavaluelist = data200.map(function (item) {return item[5];});
                    haimianqiyavaluelist = data200.map(function (item) {return item[6];});
                    dimianwenduvaluelist = data200.map(function (item) {return item[7];});
                }
                }
                
            };
    var getting4={
                type: "get",
                async: true,
                timeout: 10000000,
                url: './xin.php?name=<?php echo $location ?>&begin=<?php echo $begin ?>&end=<?php echo $end ?>',
                data2: {},
                dataType: "json",
                success: function(result){
                    
                    if(result){
                        data2=result;
                      

                    }

                },
                error: function(errmsg) {
                  if(errmsg){
                    data2=errmsg;
                
                }
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
    var max = Math.max.apply(null, valueList);
    var min = Math.min.apply(null, valueList);
    // prettier-ignore
    option = {

      title: [
      {
        left: 'center',
        text: city+' Anomaly Score'
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
        }
      ],
        yAxis:[{
            type: 'value',
          gridIndex: 0,
          axisLabel: {
            formatter: '{value}'
          }
            }
        ],
        
        visualMap: {
        show:false, 
        splitNumber : 9,
        min: min, 
        max: max,
        inRange: {
          color: ['lightskyblue','#5470c6', 'yellow', 'orangered','#AC3B2A']
        },
        outOfRange: {
          color: '#999'
        }
      },
        dataZoom: [{
                  textStyle: {
                      color: '#8392A5'
                  },
                  start:0,
                  xAxisIndex: [0], // 对应网格的索引
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
            name: '점수',
            type: 'line',
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
          myChart.group='weather';
          myChart.on('click', function (params) {
            
            rem('xin1.php?date='+params.name);
  
            
            // window.webkit.messageHandlers.iOSObj.postMessage(data)
          });
        };
        window.addEventListener('resize', myChart.resize);
        };
    <?php 
    if ($begin) {
      echo "$.ajax(getting3); $.ajax(getting);";
      echo "draw(dateList,valueList,'".$location."');";
    }else{
      echo "draw(['0000-00-00'],[0],city);";
    }
    ?>


    /* window.addEventListener("touchstart",function(){ $.ajax(getting);
      draw(dateList,valueList,"<?php echo $location ?>")}); 
      window.addEventListener("mouseover",function(){ $.ajax(getting);
        draw(dateList,valueList,"<?php echo $location ?>")}); 
      */

    draw(dateList,valueList,"<?php echo $location ?>");



   
    function acc(){
              date = document.getElementById("start").value;
              temp = new Date(document.getElementById("end").value);
              temp=temp.setDate(temp.getDate()+1);
              temp = new Date(temp);
              date1 =  new Date(temp).format("yyyy-MM-dd");
              window.location.href="?name=<?php echo $location ?>"+"&begin="+date+'&end='+date1; 
    }
    function acc2(){
              date = document.getElementById("start1").value;
              temp = new Date(document.getElementById("end1").value);
              temp=temp.setDate(temp.getDate()+1);
              temp = new Date(temp);
              date1 =  new Date(temp).format("yyyy-MM-dd");
              date2 = document.getElementById("date").value;
              window.location.href="?begin="+date+'&end='+date1+'&date='+date2; 
    }

    function draw2(datalist){
        var dom = document.getElementById('container2');
        var myChart = echarts.init(dom, null, {
          renderer: 'canvas',
          useDirtyRect: false
        });
        
        var app = {};
        var option;
        // prettier-ignore
        option = {
          tooltip: {
            trigger: 'axis'
          },

        dataZoom: [{
                  textStyle: {
                      color: '#8392A5'
                  },
                  start:20,
                  xAxisIndex: [0], // 对应网格的索引
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
        xAxis: {
          
          data: ['서울', '인천','서산','보령', '전주','광주','목포', '제주','여수','부산', '울산','대구','구미', '안동','영덕','태백', '충주','원주','대전'],
          axisLabel: {
            interval: 0,//横轴信息全部显示
            
            margin: 5, //刻度标签与轴线之间的距离
            textStyle: {
              fontSize: 9, //横轴字体大小
              color: "#000000",//颜色
            },
          },
        },

        
        yAxis: {},
        series: [
        {
          type: 'bar',
          data: datalist
          
        }
      ]
    };
        myChart.setOption(option);
        
        
    }
    

    function infor1(city,date){
  
          var getting1={
                          type: "get",
                          async: false,
                          url: "./qqq3.php?name="+city+"&date="+date,
                          data: {},
                          dataType: "json",
                          success: function(result){
                              
                              if(result){ 
                                  data=result;
                                
                                  
                                
                                  
                              }

                          },
                          error: function(errmsg) {
                            
                          }
                          
                      };
            $.ajax(getting1);
            return data;
  }

    function infor2(date){
              var getting2={
                    type: "get",
                    async: false,
                    url: "./qqq5.php?begin=<?php echo $begin?>&end=<?php echo $end?>&date="+date,
                    data20: {},
                    dataType: "json",
                    success: function(result){
                        
                        if(result){ 
                            data20=result;
                            
                            
                          
                            
                        }

                    },
                    error: function(errmsg) {
                      
                    }
              
                };
                $.ajax(getting2);
                return data20;
              }

            

  
  

  function xiangxingtu1(wenduvaluelist,zhengqiyavaluelist,ludianwenduvaluelist,dimianwenduvaluelist){
              var dom = document.getElementById('container11');
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
                text: 'Comparison 1',
                left: 'center'
              },
              {
                text: 'upper: Q3 + 1.5 * IQR \nlower: Q1 - 1.5 * IQR',
                borderColor: '#999',
                borderWidth: 1,
                textStyle: {
                  fontWeight: 'normal',
                  fontSize: 14,
                  lineHeight: 20
                },
                left: '10%',
                top: '90%'
              }
            ],
            dataset: [
              {
                // prettier-ignore
                source: [
                          wenduvaluelist,
                          zhengqiyavaluelist,
                          ludianwenduvaluelist,
                          dimianwenduvaluelist

                      ]
              },
              {
                transform: {
                  type: 'boxplot',
                  config: {
                        itemNameFormatter: function (params) {
                          switch (params.value) {
                                case 0:
                                  return 'Temperature';
                                  break;
                                case 1:
                                  return 'Vapor pressure';
                                  break;
                                case 2:
                                  return 'Dew point temperature';
                                  break;
                                case 3:
                                  return 'Ground temperature';
                                  break;
                                default:
                                  return 'ungrouped';
                              }
                }
              }
            }
          },
              {
                fromDatasetIndex: 1,
                fromTransformResult: 1
              }
            ],
            tooltip: {
              trigger: 'item',
              axisPointer: {
                type: 'shadow'
              }
            },
            grid: {
              left: '10%',
              right: '10%',
              bottom: '15%'
            },
            xAxis: {
              type: 'category',
              boundaryGap: true,
              nameGap: 30,
              
              splitArea: {
                show: false
              },
              splitLine: {
                show: false
              }
            },
            yAxis: {
              type: 'value',
              
              splitArea: {
                show: true
              }
            },
            series: [
              {
                name: 'boxplot',
                type: 'boxplot',
                datasetIndex: 1
              },
              {
                name: 'outlier',
                type: 'scatter',
                datasetIndex: 2
              }
            ]
          };
            if (option && typeof option === 'object') {
              myChart.setOption(option);
              myChart.group='weather';
            }
    
    }
    function xiangxingtu2(shiduvaluelist){
              var dom = document.getElementById('container12');
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
                text: 'Comparison 2',
                left: 'center'
              },
              {
                text: 'upper: Q3 + 1.5 * IQR \nlower: Q1 - 1.5 * IQR',
                borderColor: '#999',
                borderWidth: 1,
                textStyle: {
                  fontWeight: 'normal',
                  fontSize: 14,
                  lineHeight: 20
                },
                left: '10%',
                top: '90%'
              }
            ],
            dataset: [
              {
                // prettier-ignore
                source: [
                          shiduvaluelist

                      ]
              },
              {
                transform: {
                  type: 'boxplot',
                  config: {
                        itemNameFormatter: function (params) {
                          switch (params.value) {
                                case 0:
                                  return 'Humidity';
                                  break;
                                
                                default:
                                  return 'ungrouped';
                              }
                }
              }
            }
          },
              {
                fromDatasetIndex: 1,
                fromTransformResult: 1
              }
            ],
            tooltip: {
              trigger: 'item',
              axisPointer: {
                type: 'shadow'
              }
            },
            grid: {
              left: '10%',
              right: '10%',
              bottom: '15%'
            },
            xAxis: {
              type: 'category',
              boundaryGap: true,
              nameGap: 30,
              
              splitArea: {
                show: false
              },
              splitLine: {
                show: false
              }
            },
            yAxis: {
              type: 'value',
              
              splitArea: {
                show: true
              }
            },
            series: [
              {
                name: 'boxplot',
                type: 'boxplot',
                datasetIndex: 1
              },
              {
                name: 'outlier',
                type: 'scatter',
                datasetIndex: 2
              }
            ]
          };
            if (option && typeof option === 'object') {
              myChart.setOption(option);
              myChart.group='weather';
            }
    
    }
    function xiangxingtu3(dangdiqiyavaluelist,haimianqiyavaluelist){
              var dom = document.getElementById('container13');
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
                text: 'Comparison 3',
                left: 'center'
              },
              {
                text: 'upper: Q3 + 1.5 * IQR \nlower: Q1 - 1.5 * IQR',
                borderColor: '#999',
                borderWidth: 1,
                textStyle: {
                  fontWeight: 'normal',
                  fontSize: 14,
                  lineHeight: 20
                },
                left: '10%',
                top: '90%'
              }
            ],
            dataset: [
              {
                // prettier-ignore
                source: [
                            dangdiqiyavaluelist,
                            haimianqiyavaluelist

                      ]
              },
              {
                transform: {
                  type: 'boxplot',
                  config: {
                        itemNameFormatter: function (params) {
                          switch (params.value) {
                                case 0:
                                  return 'Local air pressure';
                                  break;
                                case 1:
                                  return 'Sea surface pressure';
                                  break;
                              }
                }
              }
            }
          },
              {
                fromDatasetIndex: 1,
                fromTransformResult: 1
              }
            ],
            tooltip: {
              trigger: 'item',
              axisPointer: {
                type: 'shadow'
              }
            },
            grid: {
              left: '10%',
              right: '10%',
              bottom: '15%'
            },
            xAxis: {
              type: 'category',
              boundaryGap: true,
              nameGap: 30,
              
              splitArea: {
                show: false
              },
              splitLine: {
                show: false
              }
            },
            yAxis: {
              type: 'value',
              
              splitArea: {
                show: true
              }
            },
            series: [
              {
                name: 'boxplot',
                type: 'boxplot',
                datasetIndex: 1
              },
              {
                name: 'outlier',
                type: 'scatter',
                datasetIndex: 2
              }
            ]
          };
            if (option && typeof option === 'object') {
              myChart.setOption(option);
              myChart.group='weather';
            }
    
    }
    
    function creatTable(data){
      var tableData="<tr>"
    //动态增加5个td,并且把data数组的五个值赋给每个td
    for(var i=0;i<data.length;i++){
      tableData+="<td>"+data[i]+"</td>"
    }
    tableData+="</tr>"
    //现在tableData已经生成好了，把他赋值给上面的tbody
    $("#tbody1").html(tableData)
  }   
  
    function draw3(shidulist,shiduvaluelist,city){
          var dom = document.getElementById('container3');
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
              text: city+' Temperature(°C)'
            }
          ],
              tooltip: {
                trigger: 'axis'
              },
              xAxis: [
              {
              type: "category",
                gridIndex: 0,
                data: wendulist
              }
            ],
              yAxis:[{
                  type: 'value',
                gridIndex: 0,
                axisLabel: {
                  formatter: '{value}'
                }
                  }
              ],
              dataZoom: [{
                        textStyle: {
                            color: '#8392A5'
                        },
                        start:0,
                        xAxisIndex: [0], // 对应网格的索引
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
                  name: '기온(°C)',
                  type: 'line',
                  data: wenduvaluelist,
                  markPoint: {
                    data: [
                      { type: 'max', name: 'Max' },
                      { type: 'min', name: 'Min' }
                    ]
                  }
                }
              ]
            }
            if (option && typeof option === 'object') {
              myChart.setOption(option);
              myChart.group='weather';
          }
        }
        
        
    function draw4(wendulist,shiduvaluelist,city){
          var dom = document.getElementById('container4');
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
              text: city+' Humidity(%)'
            }
          ],
              tooltip: {
                trigger: 'axis'
              },
              xAxis: [
              {
              type: "category",
                gridIndex: 0,
                data: wendulist
              }
            ],
              yAxis:[{
                  type: 'value',
                gridIndex: 0,
                axisLabel: {
                  formatter: '{value}'
                }
                  }
              ],
              dataZoom: [{
                        textStyle: {
                            color: '#8392A5'
                        },
                        start:0,
                        xAxisIndex: [0], // 对应网格的索引
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
                  name: '습도(%)',
                  type: 'line',
                  data: shiduvaluelist,
                  markPoint: {
                    data: [
                      { type: 'max', name: 'Max' },
                      { type: 'min', name: 'Min' }
                    ]
                  }
                }
              ]
            }
            if (option && typeof option === 'object') {
              myChart.setOption(option);
              myChart.group='weather';
          }
        }




        function draw5(zhengqiyalist,zhengqiyavaluelist,city){
              var dom = document.getElementById('container5');
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
                  text: city+' Vapor pressure(hPa)'
                }
              ],
                  tooltip: {
                    trigger: 'axis'
                  },
                  xAxis: [
                  {
                  type: "category",
                    gridIndex: 0,
                    data: zhengqiyalist
                  }
                ],
                  yAxis:[{
                      type: 'value',
                    gridIndex: 0,
                    axisLabel: {
                      formatter: '{value}'
                    }
                      }
                  ],
                  dataZoom: [{
                            textStyle: {
                                color: '#8392A5'
                            },
                            start:0,
                            xAxisIndex: [0], // 对应网格的索引
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
                      name: '증기압(hPa)',
                      type: 'line',
                      data: zhengqiyavaluelist,
                      markPoint: {
                        data: [
                          { type: 'max', name: 'Max' },
                          { type: 'min', name: 'Min' }
                        ]
                      }
                    }
                  ]
                }
                if (option && typeof option === 'object') {
                  myChart.setOption(option);
                  myChart.group='weather';
              }
            }

          
      



      function draw6(ludianwendulist,ludianwenduvaluelist,city){
              var dom = document.getElementById('container6');
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
                  text: city+' Dew point temperature(°C)'
                }
              ],
                  tooltip: {
                    trigger: 'axis'
                  },
                  xAxis: [
                  {
                  type: "category",
                    gridIndex: 0,
                    data: ludianwendulist
                  }
                ],
                  yAxis:[{
                      type: 'value',
                    gridIndex: 0,
                    axisLabel: {
                      formatter: '{value}'
                    }
                      }
                  ],
                  dataZoom: [{
                            textStyle: {
                                color: '#8392A5'
                            },
                            start:0,
                            xAxisIndex: [0], // 对应网格的索引
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
                      name: '이슬점온도(°C)',
                      type: 'line',
                      data: ludianwenduvaluelist,
                      markPoint: {
                        data: [
                          { type: 'max', name: 'Max' },
                          { type: 'min', name: 'Min' }
                        ]
                      }
                    }
                  ]
                }
                if (option && typeof option === 'object') {
                  myChart.setOption(option);
                  myChart.group='weather';
              }
            }

         


      

      function draw7(wendulist,wenduvaluelist,city){
              var dom = document.getElementById('container7');
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
                  text: city+' Local air pressure(hPa)'
                }
              ],
                  tooltip: {
                    trigger: 'axis'
                  },
                  xAxis: [
                  {
                  type: "category",
                    gridIndex: 0,
                    data: wendulist
                  }
                ],
                  yAxis:[{
                      type: 'value',
                    gridIndex: 0,
                    axisLabel: {
                      formatter: '{value}'
                    }
                      }
                  ],
                  dataZoom: [{
                            textStyle: {
                                color: '#8392A5'
                            },
                            start:0,
                            xAxisIndex: [0], // 对应网格的索引
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
                      name: '현지기압(hPa)',
                      type: 'line',
                      data: wenduvaluelist,
                      markPoint: {
                        data: [
                          { type: 'max', name: 'Max' },
                          { type: 'min', name: 'Min' }
                        ]
                      }
                    }
                  ]
                }
                if (option && typeof option === 'object') {
                  myChart.setOption(option);
                  myChart.group='weather';
              }
            }





        function draw8(wendulist,wenduvaluelist,city){
              var dom = document.getElementById('container8');
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
                  text: city+' Sea surface pressure(hPa)'
                }
              ],
                  tooltip: {
                    trigger: 'axis'
                  },
                  xAxis: [
                  {
                  type: "category",
                    gridIndex: 0,
                    data: wendulist
                  }
                ],
                  yAxis:[{
                      type: 'value',
                    gridIndex: 0,
                    axisLabel: {
                      formatter: '{value}'
                    }
                      }
                  ],
                  dataZoom: [{
                            textStyle: {
                                color: '#8392A5'
                            },
                            start:0,
                            xAxisIndex: [0], // 对应网格的索引
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
                      name: '이상 값이',
                      type: 'line',
                      data: wenduvaluelist,
                      markPoint: {
                        data: [
                          { type: 'max', name: 'Max' },
                          { type: 'min', name: 'Min' }
                        ]
                      }
                    }
                  ]
                }
                if (option && typeof option === 'object') {
                  myChart.setOption(option);
                  myChart.group='weather';
              }
            }

          




    function draw9(wendulist,wenduvaluelist,city){
              var dom = document.getElementById('container9');
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
                  text: city+' Ground temperature(°C)'
                }
              ],
                  tooltip: {
                    trigger: 'axis'
                  },
                  xAxis: [
                  {
                  type: "category",
                    gridIndex: 0,
                    data: wendulist
                  }
                ],
                  yAxis:[{
                      type: 'value',
                    gridIndex: 0,
                    axisLabel: {
                      formatter: '{value}'
                    }
                      }
                  ],
                  dataZoom: [{
                            textStyle: {
                                color: '#8392A5'
                            },
                            start:0,
                            xAxisIndex: [0], // 对应网格的索引
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
                      name: '지면온도(°C)',
                      type: 'line',
                      data: wenduvaluelist,
                      markPoint: {
                        data: [
                          { type: 'max', name: 'Max' },
                          { type: 'min', name: 'Min' }
                        ]
                      }
                    }
                  ]
                }
                if (option && typeof option === 'object') {
                  myChart.setOption(option);
                  myChart.group='weather';
              }
            }
          function draw10(datalist){
              var dom = document.getElementById('container14');
              var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
              });
              var app = {};
              var option;
              // prettier-ignore
              option = {
                xAxis: {
                        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                      },
                      yAxis: {},
                      series: [
                        {
                          type: 'bar',
                          data: datalist
                        }
                      ]
              
}
          if (option && typeof option === 'object') {
                  myChart.setOption(option);
                  myChart.group='weather';
              }


              }
          
          
        

          
          setInterval(redraw, 1000);
          function redraw(){
          draw3(wendulist,wenduvaluelist,"<?php echo $location ?>");
          draw4(wendulist,shiduvaluelist,"<?php echo $location ?>");
          draw5(wendulist,zhengqiyavaluelist,"<?php echo $location ?>");
          draw6(wendulist,ludianwenduvaluelist,"<?php echo $location ?>");
          draw7(wendulist,dangdiqiyavaluelist,"<?php echo $location ?>");
          draw8(wendulist,haimianqiyavaluelist,"<?php echo $location ?>");
          draw9(wendulist,dimianwenduvaluelist,"<?php echo $location ?>");
          xiangxingtu1(wenduvaluelist,zhengqiyavaluelist,ludianwenduvaluelist,dimianwenduvaluelist);
          xiangxingtu2(shiduvaluelist);
          xiangxingtu3(dangdiqiyavaluelist,haimianqiyavaluelist);
          draw10(newdataList);
          };
          draw3(wendulist,wenduvaluelist,"<?php echo $location ?>");
          draw4(wendulist,shiduvaluelist,"<?php echo $location ?>");
          draw5(wendulist,zhengqiyavaluelist,"<?php echo $location ?>");
          draw6(wendulist,ludianwenduvaluelist,"<?php echo $location ?>");
          draw7(wendulist,dangdiqiyavaluelist,"<?php echo $location ?>");
          draw8(wendulist,haimianqiyavaluelist,"<?php echo $location ?>");
          draw9(wendulist,dimianwenduvaluelist,"<?php echo $location ?>");
          xiangxingtu1(wenduvaluelist,zhengqiyavaluelist,ludianwenduvaluelist,dimianwenduvaluelist);
          xiangxingtu2(shiduvaluelist);
          xiangxingtu3(dangdiqiyavaluelist,haimianqiyavaluelist);
          echarts.connect('weather');

      </script>
      <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?4cab256b685e337f7ee22ecf6f71b0e1";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();

</script>

</body>
</html>