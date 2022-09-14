import pymysql
import urllib.request, urllib.error
import ssl
import os
import time
import time
from bs4 import BeautifulSoup
import re
conn = pymysql.connect( # 创建数据库连接
    host='localhost', # 要连接的数据库所在主机ip
    user='root', # 数据库登录用户名
    password='caucse1234', # 登录用户密码
    database='virus', # 连接的数据库名，也可以后续通过cursor.execture('user test_db')指定
    charset='utf8mb4' # 编码，注意不能写成utf-8
)
cursor = conn.cursor()
KID=input('Please input the city id \n 41	경기도\n 11	서울특별시\n26	부산광역시\n48	경상남도\n28	인천광역시\n47	경상북도\n27	대구광역시\n44	충청남도\n45	전라북도\n46	전라남도\n43	충청북도\n29	광주광역시\n42	강원도\n30	대전광역시\n31	울산광역시\n49	제주특별자치도\n50	세종특별자치시')
time=input('Please input time of weather data')
weather=float(input('Please input the value of this city'))
KID=int(KID)
cursor.execute("INSERT INTO chart (KID,time,value) VALUES(%d,'%s',%f)" % (KID,time,weather))
conn.commit()
cursor.close()
