from xml.etree.ElementTree import ProcessingInstruction
import pandas as pd
import numpy as np
import torch
import torch.nn as nn
from sklearn.decomposition import PCA
from sklearn.neighbors import LocalOutlierFactor

class T2G:
    def __init__(self, PATH, index):
        self.PATH = PATH
        self.df = None
        self.index = index
        #self.TimeInterval = None
    
    def DataLoading(self,):
        #self.PATH = PATH
        
        a= pd.read_csv(self.PATH).iloc[:,:].set_index(self.index)
        #print(a.head())
        self.df = a
        return a

    def Professing(self, data):
        #print(self)
        Corr = data.corr().values
        Corr = np.abs(Corr)
        Corr = pd.DataFrame(Corr)
        Corr = Corr.fillna(0).values
        return Corr
    
    def Graph(self,):
        #a=self.df
        X = []
        Time = []
        new = T2G.Professing(self,self.df.iloc[:4])
        Time.append([self.df.index[0],self.df.index[4]])
        X.append(new)
        i = 1
        while i <= self.df.shape[0]-5:
            new = T2G.Professing(self, self.df.iloc[i:i+4])
            Time.append([self.df.index[i],self.df.index[i+4]])
            X.append(new)
            i+=4
            self.X = np.array(X)
            #print(i)
        X = np.array(X)
        X = X.reshape(X.shape[0],-1)
        pca = PCA(n_components=4*4)
        X = pca.fit_transform(X)

        for i in range(X.shape[0]):
            for j in range(X.shape[1]):
                if X[i][j] == 0:
                    X[i][j] = 1
        self.X = np.abs(X.reshape(X.shape[0],4,4))
        #print(self.X)
        return np.abs(X.reshape(X.shape[0],4,4)), Time
    
    def entropy(self,X):
        E = []
        for i in range(X.shape[0]):
            P = []
            for j in range(X.shape[1]):
                if i !=j:
                    e = -X[i][j]*np.log(X[i][j])
                    P.append(e)
            P = np.array(P)
            E.append(np.sum(P))
        E = np.array(E)
        #print(E)
        return E

    def graphentropy(self,):
        E = []
        for i in range(self.X.shape[0]):
            e = T2G.entropy(self, self.X[i])
            #print(e)
            E.append(np.sum(e))
        self.E = np.array(E)
        return np.array(E)

    def distance(self, x,y):
        distance = np.mean(np.power((x-y),2))
        return distance

    def getMatrix(self,):
        Matrix = []
        for i in range(self.E.shape[0]):
            dis = []
            for j in range(self.X.shape[0]):
                dis.append(T2G.distance(self, self.E[i], self.E[j]))
            dis = np.array(dis)
            index = np.argsort(dis)[1]
            Matrix.append(self.X[index])
        Matrix = np.array(Matrix)
        self.Matrix = Matrix
        return Matrix
    
#print(x[1])
#print(e)
#print(e)
#print(e)
#print(x)