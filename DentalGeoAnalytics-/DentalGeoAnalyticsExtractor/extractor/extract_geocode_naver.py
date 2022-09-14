import json
import urllib.request
import win32com.client


def modify_address(address):
    address_list = list(address.split())
    address_list.pop()
    address = " ".join(address_list)
    return address


client_id = "h0rGWZRMoc3lrpOq8ClN"
client_secret = "ZTkHWo_UxI"

# 엑셀 열기
excel = win32com.client.Dispatch("Excel.Application")
excel.Visible = True
wb = excel.Workbooks.Open('C:\\Users\\Administrator\\Documents\\GitHub\\DentalGeoAnalytics\\DentalGeoAnalyticsExtractor\\extractor\\excelForClientJson1.xlsx')
ws = wb.ActiveSheet

# 파일 쓰기
# fw = open("site_json.txt","w")

# 주소 받아오기
i = 2
while str(ws.Cells(i, 1).Value) != 'None' :

    # 지번이 없는 경우만 고르기
    if str(ws.Cells(i, 37).Value) != 'null' :
        i += 1
        continue

    # 상세주소 없는것만 고르기
    a = '''
    if address[-1] == '동' or address[-1] == '시' :
        print(i, end=" ")
        print(address)
        i += 1
        continue
    if address[-2] == '동' or address[-2] == '시' :
        print(i, end=" ")
        print(address)
        i += 1
        continue
    #'''

    address = str(ws.Cells(i, 29).Value)
    # 주소 검색
    while True:
        try:
            encText = urllib.parse.quote(address)
            url = "https://openapi.naver.com/v1/map/geocode?query=" + encText  # json 결과
            # url = "https://openapi.naver.com/v1/map/geocode.xml?query=" + encText # xml 결과
            request = urllib.request.Request(url)
            request.add_header("X-Naver-Client-Id", client_id)
            request.add_header("X-Naver-Client-Secret", client_secret)
            response = urllib.request.urlopen(request)

        # 없는 주소일 경우
        except urllib.error.HTTPError:
            #break

            #b = '''
            address_list = list(address.split(" "))
            if len(address_list) > 2 :
                address_list.pop()
                address = " ".join(address_list)
                continue
            else :
                break
            # '''

        except urllib.error.URLError :
            print("retry")
            continue
        break

    try :
        rescode = response.getcode()
        if (rescode == 200):
            response_body = response.read()
            data = json.loads(response_body.decode('utf-8'))
            # 데이터 저장
            #ws.Cells(i, 43).Value = data['result']['items'][0]['addrdetail']['sido']
            #ws.Cells(i, 44).Value = data['result']['items'][0]['addrdetail']['sigugun']
            #ws.Cells(i, 45).Value = data['result']['items'][0]['addrdetail']['dongmyun']
            #ws.Cells(i, 46).Value = data['result']['items'][0]['addrdetail']['rest']
            #ws.Cells(i, 47).Value = data['result']['items'][0]['point']['x']
            #ws.Cells(i, 48).Value = data['result']['items'][0]['point']['y']
            if (data['result']['items'][0]['addrdetail']['dongmyun'] != '') :
                print(i, end=" ")
                print(data)
                ws.Cells(i, 44).Value = data['result']['items'][0]['addrdetail']['dongmyun']
                ws.Cells(i, 43).Value = data['result']['items'][0]['address']
            #point = data['result']['items'][0]['point']
            #print(point)
            #fw.write(str(point)+",")

        else:
            print("Error Code:" + rescode)
    except :
        print(i)

    i += 1


