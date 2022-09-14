
//selectlist 조건

var select = {yearlist : [], monthlist : [], routelist : [], sex : ["남", "여"], agelist : []};
for (var i = 0, ii = client_raw_data.searchResult.client.length; i < ii; i++){
    if (select.yearlist.indexOf(client_raw_data.searchResult.client[i].year) == -1){
        select.yearlist.push(client_raw_data.searchResult.client[i].year);
    }
    if (select.monthlist.indexOf(client_raw_data.searchResult.client[i].month) == -1){
        select.monthlist.push(client_raw_data.searchResult.client[i].month);
    }
    if (select.routelist.indexOf(client_raw_data.searchResult.client[i].route) == -1){
        select.routelist.push(client_raw_data.searchResult.client[i].route);
    }
    if (select.agelist.indexOf(client_raw_data.searchResult.client[i].age) == -1){
        select.agelist.push(client_raw_data.searchResult.client[i].age);
    }
}
select.yearlist.sort();
select.monthlist.sort();
select.agelist.sort();
var selected = {selectedYear : [], selectedMonth : [], selectedRoute : [], selectedSex : [], selectedAge: []};