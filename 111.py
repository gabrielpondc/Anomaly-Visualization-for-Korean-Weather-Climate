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
db_connection_str = 'mysql+pymysql://root:caucse1234@localhost/virus'
db_connection = create_engine(db_connection_str)
df1 = pd.read_sql('SELECT test.city,weather.* FROM weather,test where weather.KID=test.KID', con=db_connection)
df1 = df1.iloc[:,3:]

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
print(df1.head())
#print(df1[:120].iloc[:4].corr().values)