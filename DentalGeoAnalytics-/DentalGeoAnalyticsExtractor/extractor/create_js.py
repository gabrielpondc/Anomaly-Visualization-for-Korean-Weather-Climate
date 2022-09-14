import DentalGeoAnalyticsExtractor.extractor.data_adm_codes as codes
import DentalGeoAnalyticsExtractor.extractor.data_sido as sido

# 시도js생성
f = open("writeex.py", "w")
a = sido.geodatas_sido[0]
print(a)
f.write(str(a))

