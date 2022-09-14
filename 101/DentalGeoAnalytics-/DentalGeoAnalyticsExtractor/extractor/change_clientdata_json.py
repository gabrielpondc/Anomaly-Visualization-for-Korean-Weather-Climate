import win32com.client

excel = win32com.client.Dispatch("Excel.Application")
excel.Visible = True

# 새로 작성할 엑셀 문서 #추후 경로 수정 필요
def openNewExcel(filename) :
    url = 'C:\\Users\\Administrator\\Documents\\GitHub\\DentalGeoAnalytics\\DentalGeoAnalyticsExtractor\\extractor\\' + filename
    wb = excel.Workbooks.Open(url)
    return wb.ActiveSheet



#고객 데이터 엑셀
samplesheet = openNewExcel('sample_db.xlsx')
#새로 작성할 엑셀
writesheet = openNewExcel('sampleSetDB.xlsx')

i = 2
leakList = []

# 하나로 엑셀파일에서 기본정보 추출하기
while str(samplesheet.Cells(i, 1).Value) != "None" :
#for i in leakList :
    if i % 100 == 0 :
        print(i)
    try :
        # 차트번호
        writesheet.Cells(i, 1).Value = samplesheet.Cells(i, 2).Value
        # 이름
        writesheet.Cells(i, 2).Value = samplesheet.Cells(i, 3).Value
        # 가입자
        writesheet.Cells(i, 3).Value = samplesheet.Cells(i, 4).Value
        # 전화번호
        writesheet.Cells(i, 6).Value = samplesheet.Cells(i, 6).Value
        # 휴대전화
        writesheet.Cells(i, 7).Value = samplesheet.Cells(i, 7).Value
        # 이메일
        writesheet.Cells(i, 8).Value = samplesheet.Cells(i, 16).Value

        # 부양여부
        if samplesheet.Cells(i, 3).Value == samplesheet.Cells(i, 4).Value :
            writesheet.Cells(i, 9).Value = "부양자"
        elif str(samplesheet.Cells(i, 4).Value) == "None" :
            writesheet.Cells(i, 9).Value = "부양자"
        else :
            writesheet.Cells(i, 9).Value = "피부양자"

        # 주소
        writesheet.Cells(i, 29).Value = samplesheet.Cells(i, 14).Value

        # 주소 시도
        # 시군구
        # 읍면동
        # 나머지
        # x좌표
        # y좌표

        # 우편번호
        writesheet.Cells(i, 30).Value = samplesheet.Cells(i, 15).Value

        # 내원경로 대분류
        # 중분류
        # 소분류
        # 세분류

        # 최초내원 연도, 월, 일, 분기, 당시연령
        writesheet.Cells(i, 18).Value = int(samplesheet.Cells(i, 9).Value[0:4])
        writesheet.Cells(i, 19).Value = int(samplesheet.Cells(i, 9).Value[5:7])
        writesheet.Cells(i, 20).Value = int(samplesheet.Cells(i, 9).Value[8:10])
        if int(samplesheet.Cells(i, 9).Value[5:7]) < 4 :
            writesheet.Cells(i, 21).Value = "Q1"
        elif int(samplesheet.Cells(i, 9).Value[5:7]) < 7 :
            writesheet.Cells(i, 21).Value = "Q2"
        elif int(samplesheet.Cells(i, 9).Value[5:7]) < 10:
            writesheet.Cells(i, 21).Value = "Q3"
        else :
            writesheet.Cells(i, 21).Value = "Q4"

        # 최종내원 연도, 월, 일, 분기, 당시연령
        writesheet.Cells(i, 23).Value = int(samplesheet.Cells(i, 10).Value[0:4])
        writesheet.Cells(i, 24).Value = int(samplesheet.Cells(i, 10).Value[5:7])
        writesheet.Cells(i, 25).Value = int(samplesheet.Cells(i, 10).Value[8:10])
        if int(samplesheet.Cells(i, 10).Value[5:7]) < 4 :
            writesheet.Cells(i, 26).Value = "Q1"
        elif int(samplesheet.Cells(i, 10).Value[5:7]) < 7 :
            writesheet.Cells(i, 26).Value = "Q2"
        elif int(samplesheet.Cells(i, 10).Value[5:7]) < 10:
            writesheet.Cells(i, 26).Value = "Q3"
        else :
            writesheet.Cells(i, 26).Value = "Q4"

        # 이탈여부 전환/이탈
        if samplesheet.Cells(i, 9).Value == samplesheet.Cells(i, 10).Value :
            writesheet.Cells(i, 28).Value = "이탈"
        else :
            writesheet.Cells(i, 28).Value = "전환"

        try :
            # 성별
            if int(str(samplesheet.Cells(i, 5).Value)[7]) % 2 == 1:
                writesheet.Cells(i, 4).Value = "남"
            else:
                writesheet.Cells(i, 4).Value = "여"

            # 나이
            if int(str(samplesheet.Cells(i, 5).Value)[7]) % 4 == 1 or int(str(samplesheet.Cells(i, 5).Value)[7]) % 4 == 2 :
                writesheet.Cells(i, 5).Value = 2017 - int(samplesheet.Cells(i, 5).Value[0:2]) - 1900
            else :
                writesheet.Cells(i, 5).Value = 2017 - int(samplesheet.Cells(i, 5).Value[0:2]) - 2000

            # 생년월일
            if int(str(samplesheet.Cells(i, 5).Value)[7]) % 4 == 1 or int(str(samplesheet.Cells(i, 5).Value)[7]) % 4 == 2 :
                writesheet.Cells(i, 10).Value = int(samplesheet.Cells(i, 5).Value[0:2]) + 1900
            else :
                writesheet.Cells(i, 10).Value =  int(samplesheet.Cells(i, 5).Value[0:2]) + 2000
            writesheet.Cells(i, 11).Value = int(samplesheet.Cells(i, 5).Value[2:4])
            writesheet.Cells(i, 12).Value = int(samplesheet.Cells(i, 5).Value[4:6])

            # 국적
            if int(str(samplesheet.Cells(i, 5).Value)[7]) > 4:
                writesheet.Cells(i, 13).Value = "외국인"
            else:
                writesheet.Cells(i, 13).Value = "내국인"

            writesheet.Cells(i, 22).Value = writesheet.Cells(i, 18).Value - writesheet.Cells(i, 10).Value  # 최초내원당시 연령
            writesheet.Cells(i, 27).Value = writesheet.Cells(i, 23).Value - writesheet.Cells(i, 10).Value  # 최종내원당시 연령
        except :
            print(str(i) + " 주민등록번호가 없습니다.")

        i += 1
    except Exception as error:
        print(i, end=" ")
        print(error)
        leakList.append(i)
        #i += 1
    break

print(leakList)