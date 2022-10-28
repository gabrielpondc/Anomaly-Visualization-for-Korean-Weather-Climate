import win32com.client

fw = open("client_raw_data.js", "w")

excel = win32com.client.Dispatch("Excel.Application")
excel.Visible = True
# 고객 데이터 불러오기
wb = excel.Workbooks.Open('C:\\Users\\Administrator\\PycharmProjects\\DentalGeoAnalytics\\client_raw_data_new.xlsx')
ws = wb.ActiveSheet

fw.write("var customersite = {\n")
fw.write("\t\"searchResult\": {\n")
fw.write("\t\t\"client\": [\n")

i = 2
while True:
    print(i)
    if str(ws.Cells(i, 21).Value) == "None":
        i += 1
        print("좌표없음")
        continue
    else :
        fw.write("\t\t\t{\"year\": \"")
        fw.write(str(ws.Cells(i, 1).Value))
        fw.write("\", \"month\": \"")
        fw.write(str(ws.Cells(i, 2).Value))
        fw.write("\", \"name\": \"")
        fw.write(str(ws.Cells(i, 7).Value))
        fw.write("\", \"route\": \"")
        fw.write(str(ws.Cells(i, 16).Value))
        fw.write("\", \"sex\": \"")
        fw.write(str(ws.Cells(i, 17).Value))
        fw.write("\", \"age\": \"")
        fw.write(str(ws.Cells(i, 20).Value))
        fw.write("\", \"x\": \"")
        fw.write(str(ws.Cells(i, 22).Value))
        fw.write("\", \"y\": \"")
        fw.write(str(ws.Cells(i, 21).Value))
        fw.write("\"}")
    if str(ws.Cells(i + 1, 1).Value) == "None":
        break
    fw.write(",\n")
    i += 1

fw.write("\n\t\t]\n")
fw.write("\t},\n\t\"resultCode\": \"Success\"\n}")
