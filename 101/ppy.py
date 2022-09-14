#coding:utf-8
from datetime import datetime
import pymysql
from lxml import html
import urllib.request, urllib.error
import ssl
import os
import time
from selenium import webdriver
import time
from bs4 import BeautifulSoup
import prettytable as pt

url = 'https://h5.133.cn/hangban/vue/dynamic/hotFlight?tabName=specialFlights'
option = webdriver.ChromeOptions()
option.add_argument("--headless")
option.add_argument('--no-sandbox')
driver = webdriver.Chrome(executable_path='/media/ubuntu/Newdisk/xyo/admin/aacc_80/wwwroot/chromedriver',options=option)
driver.get(url)
time.sleep(4)
shi = driver.page_source.encode('utf-8')
etree = html.etree
etree_html = etree.HTML(shi)
l={}
for i in range(0,100):
    sj=etree_html.xpath('//*[@id="app"]/div/div[1]/div[3]/div/div/div[1]/div/div['+str(i)+']/div[2]/div[1]/text()[1]')
    en=etree_html.xpath('//*[@id="app"]/div/div[1]/div[3]/div/div/div[1]/div/div['+str(i)+']/div[2]/div[1]/text()[2]')
    hb=etree_html.xpath('//*[@id="app"]/div/div[1]/div[3]/div/div/div[1]/div/div['+str(i)+']/div[2]/div/font/text()')
   
    for q in hb:
       for a in sj:
            for b in en:
                d={}
                g=a.split('至')
                mm=g[0].replace('月','-').replace('日','').split('-')
                dd=g[1].replace('月','-').replace('日','').split('-')
                d['starttime']=mm[0].zfill(2)+'-'+mm[1].zfill(2)
                d['endtime']=dd[0].zfill(2)+'-'+dd[1].zfill(2)
                d['event']=b.replace('航班熔断','').replace('周',' weeks')
                l[q]=d

            #print("现存确诊:"+str(xc)+"治愈:"+str(zhi)+"死亡:"+str(si)+"累计确诊:"+str(que))
print(l)
driver.quit()