import urllib.request
from urllib.parse import urlencode
import json
import win32com.client

# 주소 검색하기 (sgis)
def search_address() :
    url = "http://sgisapi.kostat.go.kr/OpenAPI3/addr/geocode.json"
    query = "?accessToken=" + accessToken + "&" + queryaddress + "&resultcount=" + "1"
    url += query
    fp = urllib.request.urlopen(url)
    return json.load(fp)

# 주소 수정하기
def modify_address(address):
    address_list = list(address.split(" "))
    print(address_list)
    address_list.pop()
    address = " ".join(address_list)
    print("new" + address)
    return address

# 토큰 받아오기
def getToken(consumer_key, consumer_secret) :
    tokenurl = "http://sgisapi.kostat.go.kr/OpenAPI3/auth/authentication.json"
    tokenurl += "?consumer_key=" + consumer_key + "&consumer_secret=" + consumer_secret
    resulturl = urllib.request.urlopen(tokenurl)
    key = json.load(resulturl)
    accessToken = key['result']['accessToken']
    return accessToken

# 엑셀 열기
def openExcel(url) :
    excel = win32com.client.Dispatch("Excel.Application")
    excel.Visible = True
    wb = excel.Workbooks.Open(url)
    return wb.ActiveSheet


url = 'C:\\Users\\Administrator\\Documents\\GitHub\\DentalGeoAnalytics\\DentalGeoAnalyticsExtractor\\extractor\\excelForClientJson1.xlsx'
consumer_key = "9128622b98084aaab044"
consumer_secret = "6a1a740b800f46438616"

ws = openExcel(url)
accessToken = getToken(consumer_key, consumer_secret)

failList = []


i = 2
while True :
    # 몇번째인지
    if i % 100 == 0 :
        print(i)
    # while 루프 탈출조건
    if str(ws.Cells(i, 1).Value) == "None" :
        break
    # 대체주소 있는것만 고르기
    if str(ws.Cells(i, 43).Value) == "None" :
        i += 1
        continue

    # 주소 받아오기
    address = ws.Cells(i, 43).Value
    address_list = []
    parameters = {'address' : address}
    queryaddress = urlencode(parameters)

    while True :
        try :
            # 주소 검색하기
            url = "http://sgisapi.kostat.go.kr/OpenAPI3/addr/geocode.json"
            query = "?accessToken=" + accessToken + "&" + queryaddress + "&resultcount=" + "1"
            url += query

            fp = urllib.request.urlopen(url)
            data = json.load(fp)
            #data = json.dumps(data, indent=4, ensure_ascii=False)
            #print(data)
            # 주소 없음
            if data["errCd"] == -200 :
                failList.append(i)
                break
            # 주소 검색 불가
            elif data["errCd"] == -100 :
                break

            else :
                print(data)
                ws.Cells(i, 31).Value = data['result']['resultdata'][0]["sido_nm"]
                ws.Cells(i, 32).Value = data['result']['resultdata'][0]["sido_cd"]
                ws.Cells(i, 33).Value = data['result']['resultdata'][0]["sgg_nm"]
                ws.Cells(i, 34).Value = data['result']['resultdata'][0]["sgg_cd"]
                ws.Cells(i, 35).Value = data['result']['resultdata'][0]["adm_nm"]
                ws.Cells(i, 36).Value = data['result']['resultdata'][0]["adm_cd"]
                ws.Cells(i, 37).Value = data['result']['resultdata'][0]["jibun_main_no"]
                ws.Cells(i, 38).Value = data['result']['resultdata'][0]["jibun_sub_no"]
                ws.Cells(i, 39).Value = data['result']['resultdata'][0]["bd_main_nm"]
                ws.Cells(i, 40).Value = data['result']['resultdata'][0]["bd_sub_nm"]
                ws.Cells(i, 41).Value = data['result']['resultdata'][0]["x"]
                ws.Cells(i, 42).Value = data['result']['resultdata'][0]["y"]
                break

        except Exception as error :
            print(str(i) + str(error))
            failList.append(i)
            print(str(failList))
            break
    i += 1