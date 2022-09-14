import win32com.client

# 엑셀 열기
excel = win32com.client.Dispatch("Excel.Application")
excel.Visible = True
wb = excel.Workbooks.Open('C:\\Users\\Administrator\\PycharmProjects\\CustomerSiteSolution\\client_raw_data2.xlsx')
ws = wb.ActiveSheet

fw = open("site_raw2.js", "w")

i = 28332

while str(ws.Cells(i,1)) != "None" :
    if str(ws.Cells(i,17)) == "None" :
        i += 1
        continue
    fw.write("{\"name\": \"")
    fw.write(str(ws.Cells(i, 3).Value))
    fw.write("\", \"sigu\": \"")
    fw.write(str(ws.Cells(i, 14).Value))
    fw.write("\", \"dong\": \"")
    fw.write(str(ws.Cells(i, 15).Value))
    fw.write("\", \"rest\": \"")
    fw.write(str(ws.Cells(i, 16).Value))
    fw.write("\", \"x\": ")
    fw.write(str(ws.Cells(i, 17).Value))
    fw.write(", \"y\": ")
    fw.write(str(ws.Cells(i, 18).Value))
    fw.write("},")
    fw.write("\n")
    print(i)
    i += 1
    if i == 33833 :
        break