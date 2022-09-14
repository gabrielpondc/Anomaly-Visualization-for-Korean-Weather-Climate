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
df1 = pd.read_sql('SELECT * FROM weather', con=db_connection)
df1 = df1.iloc[:,2:]
with db_connection.connect() as conn, conn.begin():

	df3= pd.read_sql_table("weather", conn)
def anomaly_score(df):
    #df = pd.read_csv(path).iloc[:,3:].set_index('일시')

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

    x = Graph(df[:120])
    X = x.reshape(30,49)
    pca = PCA(n_components=4*4)
    X= pca.fit_transform(X)
    for i in range(X.shape[0]):
        for j in range(X.shape[1]):
            if X[i][j] == 0:
                X[i][j] = 1
    X = np.abs(X.reshape(X.shape[0],4,4))

    def entropy(X):
        E = []
        for i in range(X.shape[0]):
            P = []
            for j in range(X.shape[1]):
                if i !=j:
                    e = -X[i][j]*np.log(X[i][j])
                    P.append(e)
            P = np.array(P)
            E.append(np.sum(P))
        return np.array(E)

    def graphentropy(X):
        E = []
        for i in range(X.shape[0]):
            e = entropy(X[i])
            E.append(np.sum(e))
        return np.array(E)

    E = graphentropy(X)

    def distance(x,y):
        distance = np.mean(np.power((x - y),2))
        return distance

    def getMatrix(data,E):
        Matrix = []
        for i in range(E.shape[0]):
            dis = []
            for j in range(30):
                dis.append(distance(E[i],E[j]))
            dis = np.array(dis)
            index = np.argsort(dis)[1]
            Matrix.append(data[index])
            
        return np.array(Matrix)

    MatrixX = getMatrix(X,E)

    TrainXTensor = torch.from_numpy(X.reshape(X.shape[0], 16)).type(torch.FloatTensor)
    TrainSTensor = torch.from_numpy(MatrixX.reshape(X.shape[0], 16)).type(torch.FloatTensor)
        
    model = torch.load('Model.pth')
    model.eval()
    ed1, ed2, de1, de2 = model(TrainXTensor, TrainSTensor)
    Embed = ed1.data.numpy()

    df_Embed = pd.DataFrame(Embed)
    df_Embed.columns = ['C0','C1','C2','C3','C4','C5','C6','C7','C8','C9']

    lof = LocalOutlierFactor(n_neighbors=10, contamination=0.2, algorithm='auto', n_jobs=-1, novelty=True)
    lof.fit(Embed)
    y_pred_outliers_LOF = lof.predict(Embed)
    print(np.abs(lof.negative_outlier_factor_))


anomaly_score(df1)   
