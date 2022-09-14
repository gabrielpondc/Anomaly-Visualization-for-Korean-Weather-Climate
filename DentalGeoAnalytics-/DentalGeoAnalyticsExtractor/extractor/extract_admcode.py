import win32com.client

excel = win32com.client.Dispatch("Excel.Application")
excel.Visible = True
wb = excel.Workbooks.Open('C:\\Users\\Administrator\\PycharmProjects\\CustomerSiteSolution\\adm_codes.xlsx')
ws = wb.ActiveSheet

i = 3
sidocode = []
sigungocode = {}
eupmyeondongcode = {}
a = ""
b = ""
c = ""

while str(ws.Cells(i,1)) != "None" :
    if a != str(ws.Cells(i, 1)) :
        a = str(ws.Cells(i, 1))
        sidocode.append(a)
        sigungocode[a] = []
        eupmyeondongcode[a] = {}
    if b != str(ws.Cells(i, 3)) :
        b = str(ws.Cells(i, 3))
        sigungocode[a].append(b)
        eupmyeondongcode[a][b] = []
    eupmyeondongcode[a][b].append(str(ws.Cells(i, 5)))
    if i%100 == 0 :
        print(i)
    i += 1

print(sidocode)
print(sigungocode)
print(eupmyeondongcode)
