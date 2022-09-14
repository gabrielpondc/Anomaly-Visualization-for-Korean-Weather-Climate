import urllib.request
from urllib.parse import urlencode
import json
import win32com.client
import requests

# 엑셀 열기
def openExcel(url) :
    excel = win32com.client.Dispatch("Excel.Application")
    excel.Visible = True
    wb = excel.Workbooks.Open(url)
    return wb.ActiveSheet


file_url = 'C:\\Users\\Administrator\\Documents\\GitHub\\DentalGeoAnalytics\\DentalGeoAnalyticsExtractor\\extractor\\excelForClientJson1.xlsx'
consumer_key = "9128622b98084aaab044"
consumer_secret = "6a1a740b800f46438616"
ws = openExcel(file_url)

key = 'U01TX0FVVEgyMDE3MDgxNTAwMTQ1MTIzODI1'

i = 2
while True :
    # 몇번째인지
    if i % 1000 == 0:
        print(i)

    # while 루프 탈출조건
    if str(ws.Cells(i, 1).Value) == "None":
        break

    # 지번이 없는 경우에만
    if str(ws.Cells(i, 37).Value) != "null" :
        i += 1
        continue

    #print(i, end=" ")

    #주소 받아오기
    address = str(ws.Cells(i, 29).Value)
    address_list = list(address.split(" "))

    while True :
        #try :
        parameters = {'confmKey' : key,
                      'currentPage' : 1,
                      'countPerPage' : 1,
                      'keyword' : address,
                      'resultType' : 'json'}
        query = urlencode(parameters)
        url = "http://www.juso.go.kr/addrlink/addrLinkApi.do?"
        url += query
        try :
            data = requests.get(url).json()
            #fp = urllib.request.urlopen(url)
            #data = json.load(fp)

            #검색된 주소가 없을 경우
            if data['results']['common']['totalCount'] == '0' :
                if len(address_list) <= 1 :
                    break
                else :
                    address_list.pop()
                    address = " ".join(address_list)
                    continue
            else :
                #print(data)
                break
        except :
            print(url)
            if len(address_list) <= 1:
                break
            else:
                address_list.pop()
                address = " ".join(address_list)
                print(address, end=" ")
                print("except again")
                continue

    # 대체 주소 입력하기
    try :
        if int(data['results']['common']['totalCount']) < 50 :
            ws.Cells(i, 43).Value = data['results']['juso'][0]['jibunAddr']
    except :
        j = 0

    i += 1