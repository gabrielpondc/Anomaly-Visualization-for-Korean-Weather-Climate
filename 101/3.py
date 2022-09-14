#!F:\Users\caucse\AppData\Local\Programs\Python\Python38\python.exe
import pandas as pd
import numpy as np
import torch
import torch.nn as nn
from sklearn.decomposition import PCA
from sklearn.neighbors import LocalOutlierFactor
import sys
from embedding import Graph2Vec
from sqlalchemy import create_engine
import pymysql
import pandas as pd
import os

os.environ['HOMEPATH'] = 'F:/Users/caucse/AppData/Local/Programs/Python/Python38'

def aaa(name,time):
    connection=pymysql.connect(db='virus', user='root', password='caucse1234', host='localhost', charset='utf8')
    cursor=connection.cursor()
    cursor.execute('SELECT weather.qiwen,weather.shidu FROM weather,test where weather.KID=test.KID and test.city="'+name+'" and weather.date ="'+time+'"')
    result=cursor.fetchall()
    a=[]
    for data in result:
        a.append(data)
    return a[0]


if __name__ == '__main__':
    print(aaa(str(sys.argv[1]),sys.argv[2]))
  