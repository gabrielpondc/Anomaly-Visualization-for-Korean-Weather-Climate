import win32com.client
import json

fw = open("clients_7.json", "w", encoding='utf-8')

excel = win32com.client.Dispatch("Excel.Application")
excel.Visible = True
# 고객 데이터 불러오기
wb = excel.Workbooks.Open('C:\\Users\\Administrator\\Documents\\GitHub\\DentalGeoAnalytics\\DentalGeoAnalyticsExtractor\\extractor\\excelForClientJson1.xlsx')
ws = wb.ActiveSheet


clients = {
    'clients' : []
}


i = 30002
while i <= 35375 :

    client = {
        'chartCode': str(ws.Cells(i, 1).Value),
        'identity': {},
        'firstDate': {},
        'lastDate': {},
        'route': {},
        'address': {}
    }

    client['identity']['name'] = str(ws.Cells(i, 2).Value)
    client['identity']['registrant'] = str(ws.Cells(i, 3).Value)
    client['identity']['sex'] = str(ws.Cells(i, 4).Value)
    client['identity']['age'] = str(ws.Cells(i, 5).Value)
    client['identity']['phoneNumber'] = str(ws.Cells(i, 6).Value)
    client['identity']['cellphoneNumber'] = str(ws.Cells(i, 7).Value)
    client['identity']['email'] = str(ws.Cells(i, 8).Value)
    client['identity']['dependent'] = str(ws.Cells(i, 9).Value)
    client['identity']['birthYear'] = str(ws.Cells(i, 10).Value)
    client['identity']['birthMonth'] = str(ws.Cells(i, 11).Value)
    client['identity']['birthDay'] = str(ws.Cells(i, 12).Value)
    client['identity']['citizenship'] = str(ws.Cells(i, 13).Value)
    client['identity']['remain'] = str(ws.Cells(i, 28).Value)

    client['route']['category'] = str(ws.Cells(i, 14).Value)
    client['route']['division'] = str(ws.Cells(i, 15).Value)
    client['route']['section'] = str(ws.Cells(i, 16).Value)
    client['route']['rest'] = str(ws.Cells(i, 17).Value)

    client['firstDate']['year'] = str(ws.Cells(i, 18).Value)
    client['firstDate']['month'] = str(ws.Cells(i, 19).Value)
    client['firstDate']['day'] = str(ws.Cells(i, 20).Value)
    client['firstDate']['quarter'] = str(ws.Cells(i, 21).Value)
    client['firstDate']['age'] = str(ws.Cells(i, 22).Value)

    client['lastDate']['year'] = str(ws.Cells(i, 23).Value)
    client['lastDate']['month'] = str(ws.Cells(i, 24).Value)
    client['lastDate']['day'] = str(ws.Cells(i, 25).Value)
    client['lastDate']['quarter'] = str(ws.Cells(i, 26).Value)
    client['lastDate']['age'] = str(ws.Cells(i, 27).Value)

    client['address']['address'] = str(ws.Cells(i, 29).Value)
    client['address']['zipCode'] = str(ws.Cells(i, 30).Value)
    client['address']['sido'] = str(ws.Cells(i, 31).Value)
    client['address']['sidoCode'] = str(ws.Cells(i, 32).Value)
    client['address']['sgg'] = str(ws.Cells(i, 33).Value)
    client['address']['sggCode'] = str(ws.Cells(i, 34).Value)
    client['address']['emdong'] = str(ws.Cells(i, 35).Value)
    client['address']['emdongCode'] = str(ws.Cells(i, 36).Value)
    client['address']['jibun'] = str(ws.Cells(i, 37).Value)
    client['address']['subJibun'] = str(ws.Cells(i, 38).Value)
    client['address']['bdName'] = str(ws.Cells(i, 39).Value)
    client['address']['subBdName'] = str(ws.Cells(i, 40).Value)
    client['address']['X'] = str(ws.Cells(i, 41).Value)
    client['address']['Y'] = str(ws.Cells(i, 42).Value)

    clients['clients'].append(client)

    if i % 100 == 0 :
        print(i)
        print(client)

    # 마지막행
    if str(ws.Cells(i + 1, 1).Value) == "None":
        print("finish")
        break

    i += 1

clients = json.dumps(clients, indent=4, ensure_ascii=False)

fw.write(clients)
fw.close()