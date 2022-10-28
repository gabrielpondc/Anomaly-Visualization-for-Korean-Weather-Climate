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
import datetime
import time

def wendu(name,begin,end):
    db_connection_str = 'mysql+pymysql://root:caucse1234@caucse.club/virus'
    db_connection = create_engine(db_connection_str)
    df = pd.read_sql('SELECT test.city,weather.dangdiqiya FROM weather,test where weather.KID=test.KID and test.city="'+name+'" and weather.date >="'+begin+'" AND weather.date <"'+end+'"', con=db_connection)
    df1 = df.iloc[:,1:]
    list=df1['dangdiqiya'].values.tolist()
    sum=0
    avg=[]
    for i in range(int(len(list)/24)):
        sum=0
        for j in range(24):  
            sum=sum+list[j+(i*24)]
        avg.append(sum/24) 
    return avg

if __name__ == '__main__':
    a=wendu(str(sys.argv[1]),sys.argv[2],sys.argv[3])
    for i in range(0,len(a)):
        print(a[i])