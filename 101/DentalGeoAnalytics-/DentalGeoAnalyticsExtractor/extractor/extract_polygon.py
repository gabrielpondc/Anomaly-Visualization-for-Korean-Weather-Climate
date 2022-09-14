import urllib.request
import json
import DentalGeoAnalyticsExtractor.geojson_eupmyeondong_11150 as sigungu



accessToken = "f4c5e8b5-3deb-4942-ad43-a02b31780a1a"
posX = "959572.7160448928"
posY = "959572.7160448928"

file = open("polygon_eupmyeondong_11150.js", "w")

for i in range(len(sigungu.eupmyeondong_11150)) :
    print(sigungu.eupmyeondong_11150[i]['features'][0]['properties']['adm_nm'])
    print(len(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates']))

    # 폴리곤 생성
    file.write("var polygon_eupmyeondong_11150_" + str(sigungu.eupmyeondong_11150[i]['features'][0]['properties']['adm_cd']) + " = new naver.maps.Polygon({\n")
    file.write("\tmap: map,\n")
    file.write("\tpaths: [\n")
    for j in range(len(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'])) :
        print(j)

        file.write("\t\t[\n")
        for k in range(len(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j])) :
            if type(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j][k][0]) != list:
                print("k=%d" % k)
                posX = str(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j][k][0])
                posY = str(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j][k][1])
                coordChangerurl = "http://sgisapi.kostat.go.kr/OpenAPI3/transformation/transcoord.json"
                coordChangerurl += "?accessToken=" + accessToken + "&src=5179&dst=4326&posX=" + posX + "&posY=" + posY
                fp = urllib.request.urlopen(coordChangerurl)
                data = json.load(fp)
                lat = round(data['result']['posY'], 6)
                lng = round(data['result']['posX'], 6)
                file.write("\t\t\tnew naver.maps.LatLng(" + str(lat) + ", " + str(lng) + "),\n")
            else :
                for l in range(len(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j][k])) :
                    print("l=%d" % l)
                    posX = str(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j][k][l][0])
                    posY = str(sigungu.eupmyeondong_11150[i]['features'][0]['geometry']['coordinates'][j][k][l][1])
                    coordChangerurl = "http://sgisapi.kostat.go.kr/OpenAPI3/transformation/transcoord.json"
                    coordChangerurl += "?accessToken=" + accessToken + "&src=5179&dst=4326&posX=" + posX + "&posY=" + posY
                    fp = urllib.request.urlopen(coordChangerurl)
                    data = json.load(fp)
                    lat = round(data['result']['posY'], 6)
                    lng = round(data['result']['posX'], 6)
                    file.write("\t\t\tnew naver.maps.LatLng(" + str(lat) + ", " + str(lng) + "),\n")

        file.write("\t\t],\n")
    file.write("\t],\n")
    file.write("fillColor: '#000000',\n")
    file.write("fillOpacity: 0.0,\n")
    file.write("strokeColor: '#000000',\n")
    file.write("strokeOpacity: 0.6,\n")
    file.write("strokeWeight: 3\n")
    file.write("});\n\n")

file.close()