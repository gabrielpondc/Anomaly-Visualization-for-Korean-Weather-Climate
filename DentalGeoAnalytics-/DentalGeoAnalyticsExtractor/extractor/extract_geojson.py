import urllib.request
import json


sidocodes = ['11', '21', '22', '23', '24', '25', '26', '29', '31', '32', '33', '34', '35', '36', '37', '38', '39']


# 토큰 받아오기
tokenurl = "http://sgisapi.kostat.go.kr/OpenAPI3/auth/authentication.json"
consumer_key = "9128622b98084aaab044"
consumer_secret = "6a1a740b800f46438616"
tokenurl += "?consumer_key=" + consumer_key + "&consumer_secret=" + consumer_secret
resulturl = urllib.request.urlopen(tokenurl)
key = json.load(resulturl)
accessToken = key['result']['accessToken']



fwsido = open("geojson_sido"+".json", "w", encoding='utf-8')

year = "2015"

# 시도 입력
for sidocode in sidocodes :
    geourl = "http://sgisapi.kostat.go.kr/OpenAPI3/boundary/hadmarea.geojson"
    geourl += "?accessToken=" + accessToken + "&year=" + year + "&adm_cd=" + sidocode + "&low_search=" + "0"

    fp = urllib.request.urlopen(geourl)
    data = json.load(fp)
    adm_nm = (data["features"][0]["properties"]["adm_nm"])
    data = json.dumps(data, indent=4, ensure_ascii=False)

    fwsido.write(str(data)+",\n")
    print(adm_nm)


    # 시군구 입력
    fwsigungu = open("geojson_sgg_" + sidocode + ".json", "w", encoding='utf-8')

    geourl = "http://sgisapi.kostat.go.kr/OpenAPI3/boundary/hadmarea.geojson"
    geourl += "?accessToken=" + accessToken + "&year=" + year + "&adm_cd=" + sidocode + "&low_search=" + "1"

    fp = urllib.request.urlopen(geourl)
    data = json.load(fp)
    adm_nm = (data["features"][0]["properties"]["adm_nm"])
    data = json.dumps(data, indent=4, ensure_ascii=False)


    fwsigungu.write(str(data))
    print(adm_nm)

    fwsigungu.close()

    # 읍면동 입력
    fweupmyeondong = open("geojson_emd_" + sidocode + ".json", "w", encoding='utf-8')

    geourl = "http://sgisapi.kostat.go.kr/OpenAPI3/boundary/hadmarea.geojson"
    geourl += "?accessToken=" + accessToken + "&year=" + year + "&adm_cd=" + sidocode + "&low_search=" + "2"

    fp = urllib.request.urlopen(geourl)
    data = json.load(fp)
    adm_nm = (data["features"][0]["properties"]["adm_nm"])
    data = json.dumps(data, indent=4, ensure_ascii=False)

    fweupmyeondong.write(str(data))
    print(adm_nm)

    fwsigungu.close()

fwsido.close()