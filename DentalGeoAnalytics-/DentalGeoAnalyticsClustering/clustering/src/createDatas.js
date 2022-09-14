
//맵 설정
var map = new naver.maps.Map("map", {
    zoom: 10,
    center: new naver.maps.LatLng(37.54218, 126.84215),
    zoomControl: true,
    zoomControlOptions: {
        position: naver.maps.Position.TOP_LEFT,
        style: naver.maps.ZoomControlStyle.SMALL
    }
});
// 마커, 인포윈도우 리스트 생성
var markers = [],
    infoWindows = [],
    data = clients;

function setDatas(){
    var markerstmp = [];
    var infoWindowstmp = [];
    for (var i = 0, ii = data.length; i < ii; i++) {
        var client = data[i];
        // 선택 조건 판별
        if(selected.selectedYear.indexOf(client.firstDate.year) == -1){continue;}
        else if(selected.selectedMonth.indexOf(client.firstDate.month) == -1){continue;}
        else if (selected.selectedRoute.indexOf(client.route.category) == -1){continue;}
        else if (selected.selectedSex.indexOf(client.identity.sex) == -1){continue;}
        else if (selected.selectedAge.indexOf(client.identity.age) == -1){continue;}

        var lat = client.address.lat;
        var lng = client.address.lng;
        var latlng = new naver.maps.LatLng(lat, lng);
        var marker = new naver.maps.Marker({
            position: latlng,
            draggable: true
        });

        var infoWindow = new naver.maps.InfoWindow({
            content: '<div style="width:200px;text-align:center;padding:2px;">이름 : <b>' + client.identity.name + '</b></div>' +
            '<div style="width:200px;text-align:center;padding:2px;">방문시기 : <b>' + client.firstDate.year + '</b>년 <b>' + client.month + '</b>월</div>' +
            '<div style="width:200px;text-align:center;padding:2px;">연령 : <b>' + client.identity.age + '</b>대</div>' +
            '<div style="width:200px;text-align:center;padding:2px;">성별 : <b>' + client.identity.sex + '</b></div>' +
            '<div style="width:200px;text-align:center;padding:2px;">방문경로 : <b>' + client.route.category + '</b></div>'
        });

        markerstmp.push(marker);
        infoWindowstmp.push(infoWindow);
    }
    markers = markerstmp;
    infoWindows = infoWindowstmp;

    for (var i=0, ii=markers.length; i<ii; i++) {
        naver.maps.Event.addListener(markers[i], 'click', getClickHandler_cluster(i));
    }
}

// 해당 마커의 인덱스를 seq라는 클로저 변수로 저장하는 이벤트 핸들러를 반환합니다.
function getClickHandler_cluster(seq) {
    return function(e) {
        var marker = markers[seq],
            infoWindow = infoWindows[seq];

        if (infoWindow.getMap()) {
            infoWindow.close();
        } else {
            infoWindow.open(map, marker);
        }
    }
}

//마커 이미지 설정
var htmlMarker1 = {
        content: '<div style="cursor:pointer;width:40px;height:40px;line-height:42px;font-size:10px;color:white;text-align:center;font-weight:bold;background:url(../images/cluster-marker-1.png);background-size:contain;"></div>',
        size: N.Size(40, 40),
        anchor: N.Point(20, 20)
    },
    htmlMarker2 = {
        content: '<div style="cursor:pointer;width:40px;height:40px;line-height:42px;font-size:10px;color:white;text-align:center;font-weight:bold;background:url(../images/cluster-marker-2.png);background-size:contain;"></div>',
        size: N.Size(40, 40),
        anchor: N.Point(20, 20)
    },
    htmlMarker3 = {
        content: '<div style="cursor:pointer;width:40px;height:40px;line-height:42px;font-size:10px;color:white;text-align:center;font-weight:bold;background:url(../images/cluster-marker-3.png);background-size:contain;"></div>',
        size: N.Size(40, 40),
        anchor: N.Point(20, 20)
    },
    htmlMarker4 = {
        content: '<div style="cursor:pointer;width:40px;height:40px;line-height:42px;font-size:10px;color:white;text-align:center;font-weight:bold;background:url(../images/cluster-marker-4.png);background-size:contain;"></div>',
        size: N.Size(40, 40),
        anchor: N.Point(20, 20)
    },
    htmlMarker5 = {
        content: '<div style="cursor:pointer;width:40px;height:40px;line-height:42px;font-size:10px;color:white;text-align:center;font-weight:bold;background:url(../images/cluster-marker-5.png);background-size:contain;"></div>',
        size: N.Size(40, 40),
        anchor: N.Point(20, 20)
    };

var markerClustering = new MarkerClustering({
    minClusterSize: 2,
    maxZoom: 14,
    map: map,
    markers: markers,
    disableClickZoom: false,
    gridSize: 500,
    icons: [htmlMarker1, htmlMarker2, htmlMarker3, htmlMarker4, htmlMarker5],
    indexGenerator: [5, 20, 50, 100, 500],
    stylingFunction: function(clusterMarker, count) {
        $(clusterMarker.getElement()).find('div:first-child').text(count);
    }
});