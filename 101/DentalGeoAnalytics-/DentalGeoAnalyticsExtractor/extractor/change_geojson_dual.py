import urllib.request
import json

accessToken = "6806d683-0020-441a-a7b3-83aa9445f52f"

geojsons = [

]

fw = open("geojson_.js", "w")

fw.write("var geojsons_ = [")

for geojson in geojsons:
    posX = str(geojson['features'][0]['properties']['x'])
    posY = str(geojson['features'][0]['properties']['y'])
    coordChangerurl = "http://sgisapi.kostat.go.kr/OpenAPI3/transformation/transcoord.json"
    coordChangerurl += "?accessToken=" + accessToken + "&src=5179&dst=4326&posX=" + posX + "&posY=" + posY
    fp = urllib.request.urlopen(coordChangerurl)
    data = json.load(fp)
    X = round(data['result']['posX'], 6)
    Y = round(data['result']['posY'], 6)
    geojson['features'][0]['properties']['x'] = X
    geojson['features'][0]['properties']['y'] = Y
    print(geojson)
    for coordinates in geojson['features'][0]['geometry']['coordinates']:
        if type(coordinates[0][0]) != list:
            for i in range(len(coordinates)):
                posX = str(coordinates[i][0])
                posY = str(coordinates[i][1])
                coordChangerurl = "http://sgisapi.kostat.go.kr/OpenAPI3/transformation/transcoord.json"
                coordChangerurl += "?accessToken=" + accessToken + "&src=5179&dst=4326&posX=" + posX + "&posY=" + posY
                fp = urllib.request.urlopen(coordChangerurl)
                data = json.load(fp)
                X = round(data['result']['posX'], 6)
                Y = round(data['result']['posY'], 6)
                coordinates[i][0] = X
                coordinates[i][1] = Y
                print(i)
            print()
        else:
            for i in range(len(coordinates)):
                for j in range(len(coordinates[i])):
                    posX = str(coordinates[i][j][0])
                    posY = str(coordinates[i][j][1])
                    coordChangerurl = "http://sgisapi.kostat.go.kr/OpenAPI3/transformation/transcoord.json"
                    coordChangerurl += "?accessToken=" + accessToken + "&src=5179&dst=4326&posX=" + posX + "&posY=" + posY
                    fp = urllib.request.urlopen(coordChangerurl)
                    data = json.load(fp)
                    X = round(data['result']['posX'], 6)
                    Y = round(data['result']['posY'], 6)
                    coordinates[i][j][0] = X
                    coordinates[i][j][1] = Y
                    print(j)
            print()
    print(geojson)
    fw.write(str(geojson))
    fw.write(",\n")

fw.write("];\n")




