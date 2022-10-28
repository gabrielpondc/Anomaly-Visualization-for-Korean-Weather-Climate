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

def anomaly_score(name,begin,end):
    #df = pd.read_csv('F:\\avwc\\'+name+'.csv').iloc[:,3:11].set_index('일시')
    db_connection_str = 'mysql+pymysql://root:caucse1234@caucse.club/virus'
    db_connection = create_engine(db_connection_str)
    df = pd.read_sql('SELECT test.city,weather.* FROM weather,test where weather.KID=test.KID and test.city="'+name+'" and weather.date BETWEEN "'+begin+'" AND "'+end+'"', con=db_connection)
    df = df.iloc[:,3:]
    print(df)

anomaly_score('부산광역시','2020-12-01','2020-12-31')