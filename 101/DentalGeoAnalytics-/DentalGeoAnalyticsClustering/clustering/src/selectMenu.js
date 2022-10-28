//selectlist 조건
var select = {yearlist : [], monthlist : [], routelist : [], sex : ["남", "여"], agelist : []};
for (var i = 0, ii = clients.length; i < ii; i++){
    if (select.yearlist.indexOf(clients[i].firstDate.year) == -1){
        select.yearlist.push(clients[i].firstDate.year);
    }
    if (select.monthlist.indexOf(clients[i].firstDate.month) == -1){
        select.monthlist.push(clients[i].firstDate.month);
    }
    if (select.routelist.indexOf(clients[i].route.category) == -1){
        select.routelist.push(clients[i].route.category);
    }
    if (select.agelist.indexOf(clients[i].identity.age) == -1){
        select.agelist.push(clients[i].identity.age);
    }
}
select.yearlist.sort();
select.monthlist.sort();
select.agelist.sort();
var selected = {selectedYear : [], selectedMonth : [], selectedRoute : [], selectedSex : [], selectedAge: []};

// 요소 추가
function addElementLi(id, value, name) {
    $(id).append("<li><input type=\"checkbox\" value="+value+" name="+name+">"+value+"</li>")
}
for (var i = 0, ii = select.yearlist.length; i<ii; i++ ) {
    addElementLi("#yearCheckboxes dd div ul", select.yearlist[i], "year");
}
for (var i = 0, ii = select.monthlist.length; i<ii; i++ ) {
    addElementLi("#monthCheckboxes dd div ul", select.monthlist[i], "month");
}
for (var i = 0, ii = select.routelist.length; i<ii; i++ ) {
    addElementLi("#routeCheckboxes dd div ul", select.routelist[i], "route");
}
for (var i = 0, ii = select.sex.length; i<ii; i++ ) {
    addElementLi("#sexCheckboxes dd div ul", select.sex[i], "sex");
}
for (var i = 0, ii = select.agelist.length; i<ii; i++ ) {
    addElementLi("#ageCheckboxes dd div ul", select.agelist[i], "age");
}

// 전체 체크
$('input:checkbox').each(function() {this.checked = true;});

// 펼치기
$("#yearCheckboxes dt a").on('click', function() {
    $("#yearCheckboxes dd ul").slideToggle('fast');
    $("#monthCheckboxes dd ul").hide();
    $("#routeCheckboxes dd ul").hide();
    $("#sexCheckboxes dd ul").hide();
    $("#ageCheckboxes dd ul").hide();
});
$("#monthCheckboxes dt a").on('click', function() {
    $("#monthCheckboxes dd ul").slideToggle('fast');
    $("#yearCheckboxes dd ul").hide();
    $("#routeCheckboxes dd ul").hide();
    $("#sexCheckboxes dd ul").hide();
    $("#ageCheckboxes dd ul").hide();
});
$("#routeCheckboxes dt a").on('click', function() {
    $("#routeCheckboxes dd ul").slideToggle('fast');
    $("#yearCheckboxes dd ul").hide();
    $("#monthCheckboxes dd ul").hide();
    $("#sexCheckboxes dd ul").hide();
    $("#ageCheckboxes dd ul").hide();
});
$("#sexCheckboxes dt a").on('click', function() {
    $("#sexCheckboxes dd ul").slideToggle('fast');
    $("#yearCheckboxes dd ul").hide();
    $("#monthCheckboxes dd ul").hide();
    $("#routeCheckboxes dd ul").hide();
    $("#ageCheckboxes dd ul").hide();
});
$("#ageCheckboxes dt a").on('click', function() {
    $("#ageCheckboxes dd ul").slideToggle('fast');
    $("#yearCheckboxes dd ul").hide();
    $("#monthCheckboxes dd ul").hide();
    $("#routeCheckboxes dd ul").hide();
    $("#sexCheckboxes dd ul").hide();
});


// 닫기
$("#yearCheckboxes dd ul li a").on('click', function() {$("#yearCheckboxes dd ul").hide();});
$("#monthCheckboxes dd ul li a").on('click', function() {$("#monthCheckboxes dd ul").hide();});
$("#routeCheckboxes dd ul li a").on('click', function() {$("#routeCheckboxes dd ul").hide();});
$("#sexCheckboxes dd ul li a").on('click', function() {$("#sexCheckboxes dd ul").hide();});
$("#ageCheckboxes dd ul li a").on('click', function() {$("#ageCheckboxes dd ul").hide();});
//외부클릭시 닫기
$(document).click(function(){$("#dropdown").hide();});

function getSelectedValue(id) {
    return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown")) $("#yearCheckboxes dd ul").hide();
});
$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown")) $("#monthCheckboxes dd ul").hide();
});
$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown")) $("#routeCheckboxes dd ul").hide();
});
$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown")) $("#sexCheckboxes dd ul").hide();
});
$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown")) $("#ageCheckboxes dd ul").hide();
});

// selected all 클릭 이벤트
$('#yearCheckboxes dd div input[value="Select All"]').on('click', function() {
    if ($(this).is(':checked')) {
        $('#yearCheckboxes dd div input:checkbox[name="year"]').each(function() {this.checked = true;});
    } else {
        $('#yearCheckboxes dd div input:checkbox[name="year"]').each(function() {this.checked = false;});
    }
});
$('#monthCheckboxes dd div input[value="Select All"]').on('click', function() {
    if ($(this).is(':checked')) {
        $('#monthCheckboxes dd div input:checkbox[name="month"]').each(function() {this.checked = true;});
    } else {
        $('#monthCheckboxes dd div input:checkbox[name="month"]').each(function() {this.checked = false;});
    }
});
$('#routeCheckboxes dd div input[value="Select All"]').on('click', function() {
    if ($(this).is(':checked')) {
        $('#routeCheckboxes dd div input:checkbox[name="route"]').each(function() {this.checked = true;});
    } else {
        $('#routeCheckboxes dd div input:checkbox[name="route"]').each(function() {this.checked = false;});
    }
});
$('#sexCheckboxes dd div input[value="Selecte All"]').on('click', function() {
    if ($(this).is(':checked')) {
        $('#sexCheckboxes dd div input:checkbox[name="sex"]').each(function() {this.checked = true;});
    } else {
        $('#sexCheckboxes dd div input:checkbox[name="sex"]').each(function() {this.checked = false;});
    }
});
$('#ageCheckboxes dd div input[value="Select All"]').on('click', function() {
    if ($(this).is(':checked')) {
        $('#ageCheckboxes dd div input:checkbox[name="age"]').each(function() {this.checked = true;});
    } else {
        $('#ageCheckboxes dd div input:checkbox[name="age"]').each(function() {this.checked = false;});
    }
});

function searchBtn_click(){
    markerClustering.setMap();
    // seleted 초기화
    selected.selectedYear = [];
    selected.selectedMonth = [];
    selected.selectedRoute = [];
    selected.selectedSex = [];
    selected.selectedAge = [];

    // 체크박스 넣기
    $('input:checkbox[name="year"]').each(function () {
        if(this.checked){
            selected.selectedYear.push(this.value);
        }
    });
    $('input:checkbox[name="month"]').each(function () {
        if(this.checked){
            selected.selectedMonth.push(this.value);
        }
    });
    $('input:checkbox[name="route"]').each(function () {
        if(this.checked){
            selected.selectedRoute.push(this.value);
        }
    });
    $('input:checkbox[name="sex"]').each(function () {
        if(this.checked){
            selected.selectedSex.push(this.value);
        }
    });
    $('input:checkbox[name="age"]').each(function () {
        if(this.checked){
            selected.selectedAge.push(this.value);
        }
    });

    // 마커 초기화
    setDatas();
    markerClustering = new MarkerClustering({
        minClusterSize: 2,
        maxZoom: 14,
        map: map,
        markers: markers,
        disableClickZoom: false,
        gridSize: 150,
        icons: [htmlMarker1, htmlMarker2, htmlMarker3, htmlMarker4, htmlMarker5],
        indexGenerator: [5, 10, 50, 100, 500],
        stylingFunction: function(clusterMarker, count) {
            $(clusterMarker.getElement()).find('div:first-child').text(count);
        }
    });
}