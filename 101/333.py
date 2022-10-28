import mysql.connector as sql
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


db_connection = sql.connect(host='localhost', database='virus', user='root', password='caucse1234')
db_cursor = db_connection.cursor()
db_cursor.execute('SELECT * FROM weather')

table_rows = db_cursor.fetchall()

df = pd.DataFrame(table_rows)
df1 = df.iloc[:,2:]
df2 = pd.read_csv('F:\\avwc\\Busan.csv').iloc[:,4:11]
def processingforcorr(data):
        Corr = data.corr().values
        Corr = np.abs(Corr)
        Corr = pd.DataFrame(Corr)
        return Corr.fillna(0).values
def Graph(data):
        maxlag = 1
        test = 'ssr_chi2test'
        X = []
        new = processingforcorr(data.iloc[:4])
        X.append(new)
        i = 1
        while i<=data.shape[0]-5:
            new = processingforcorr(data.iloc[i:i+4])
            X.append(new)
            i=i+4
            
        return np.array(X)

x = Graph(df1[:120])
print(df1[:120].iloc[:4].corr().values)
#print(df1[:120])
#print(df2[:120])