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

def processingforcorr(data):
        Corr = data.corr().values
        Corr = np.abs(Corr)
        Corr = pd.DataFrame(Corr)
        return Corr.fillna(0).values

def Graph(data):
    maxlag = 1
    test = 'ssr_chi2test'
    X = []
    new = processingforcorr(data.iloc[:24])
    X.append(new)
    i = 1
    while i<=data.shape[0]-25:
        new = processingforcorr(data.iloc[i:i+24])
        X.append(new)
        i=i+24
            
    return np.array(X)

def entropy(X):
        E = []
        for i in range(X.shape[0]):
            P = []
            for j in range(X.shape[1]):
                if i !=j:
                    e =X[i][j]*np.log(X[i][j])
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

def distance(x,y):
        distance = np.mean(np.power((x,- y),2))
        return distance

def getMatrix(data,E):
        Matrix = []
        for i in range(E.shape[0]):
            dis = []
            for j in range(len(E)):
                dis.append(distance(E[i],E[j]))
            dis = np.array(dis)
            index = np.argsort(dis)[1]
            Matrix.append(data[index])
            
        return np.array(Matrix)
    
def eachcityscore(begin,end,date):
    db_connection_str = 'mysql+pymysql://root:caucse1234@caucse.club/virus'
    db_connection = create_engine(db_connection_str)
    df = pd.read_sql('SELECT test.city,weather.* FROM weather,test where weather.KID=test.KID and weather.date >="'+begin+'" AND weather.date <"'+end+'"', con=db_connection)
    chengshi=["서울특별시","인천광역시","서산","보령","전주","광주광역시","목포","제주특별자치도","여수","부산광역시","울산광역시","대구광역시","구미","안동","영덕","태백","충주","원주","대전광역시"]
    df1=pd.DataFrame()
    df2=pd.DataFrame()
    df3=pd.DataFrame()
    df4=pd.DataFrame()
    df5=pd.DataFrame()
    df6=pd.DataFrame()
    df7=pd.DataFrame()
    df8=pd.DataFrame()
    df9=pd.DataFrame()
    df10=pd.DataFrame()
    df11=pd.DataFrame()
    df12=pd.DataFrame()
    df13=pd.DataFrame()
    df14=pd.DataFrame()
    df15=pd.DataFrame()
    df16=pd.DataFrame()
    df17=pd.DataFrame()
    df18=pd.DataFrame()
    df19=pd.DataFrame()
    df20=pd.DataFrame()
    df_list = [df1,df2,df3,df4,df5,df6,df7,df8,df9,df10,df11,df12,df13,df14,df15,df16,df17,df18,df19,df20]
    a=[]
    blist=[]
    for i in range(0,19):

            df_list[i]=df.loc[df['city']==chengshi[i]]
            df_list[i]=df_list[i].iloc[:,3:]
            x = Graph(df_list[i])
            X = x.reshape(-1,49)
            
            pca = PCA(n_components=4*4)
            X= pca.fit_transform(X)
            for j in range(X.shape[0]):
                for k in range(X.shape[1]):
                    if X[j][k] == 0:
                        X[j][k] = 1
            X = np.abs(X.reshape(X.shape[0],4,4))
            E = graphentropy(X)

            MatrixX = getMatrix(X,E)

            TrainXTensor = torch.from_numpy(X.reshape(X.shape[0], 16)).type(torch.FloatTensor)
            TrainSTensor = torch.from_numpy(MatrixX.reshape(X.shape[0], 16)).type(torch.FloatTensor)
                
            model = torch.load('Model.pth')
            model.eval()
            ed1, ed2, de1, de2 = model(TrainXTensor, TrainSTensor)
            Embed = ed1.data.numpy()

            df_Embed = pd.DataFrame(Embed)
            df_Embed.columns = ['C0','C1','C2','C3','C4','C5','C6','C7','C8','C9']
            blist.append(Embed)
    s1 = begin
    s1=s1.replace("-","")
    a = time.strptime(s1,'%Y%m%d')
    start=a[:3]
    s2 = end
    s2=s2.replace("-","")
    b= time.strptime(s2,'%Y%m%d')
    end=b[:3]
    starttime=datetime.date(start[0],start[1],start[2])
    endtime=datetime.date(end[0],end[1],end[2])
    qqq=(endtime-starttime).days
    day=[]
    for i in range(qqq+1):
        day1=starttime+datetime.timedelta(days=i)
        day.append(str(day1))
    dic00={}
    dic01={}
    dic02={}
    dic03={}
    dic04={}
    dic05={}
    dic06={}
    dic07={}
    dic08={}
    dic09={}
    dic10={}
    dic11={}
    dic12={}
    dic13={}
    dic14={}
    dic15={}
    dic16={}
    dic17={}
    dic18={}
    dic19={}
    PPP=[dic00,dic01,dic02,dic03,dic04,dic05,dic06,dic07,dic08,dic09,dic10,dic11,dic12,dic13,dic14,dic15,dic16,dic17,dic18]
    for key in day:
        dic00[key]=0
    for key in day:
        dic01[key]=0
    for key in day:
        dic02[key]=0
    for key in day:
        dic03[key]=0
    for key in day:
        dic04[key]=0
    for key in day:
        dic05[key]=0
    for key in day:
        dic06[key]=0
    for key in day:
        dic07[key]=0
    for key in day:
        dic08[key]=0
    for key in day:
        dic09[key]=0
    for key in day:
        dic10[key]=0
    for key in day:
        dic11[key]=0
    for key in day:
        dic12[key]=0
    for key in day:
        dic13[key]=0
    for key in day:
        dic14[key]=0
    for key in day:
        dic15[key]=0
    for key in day:
        dic16[key]=0
    for key in day:
        dic17[key]=0
    for key in day:
        dic18[key]=0
    for key in day:
        dic19[key]=0
    #"서울특별시","인천광역시","서산","보령","전주","광주광역시","목포","제주특별자치도","여수","부산광역시","울산광역시","대구광역시","구미","안동","영덕","태백","충주","원주","대전광역시"
    dicsourl={}
    dicsourl[chengshi[0]]=PPP[0]
    dicincheon={}
    dicincheon[chengshi[1]]=PPP[1]
    dicsosan={}
    dicsosan[chengshi[2]]=PPP[2]
    dicbaolin={}
    dicbaolin[chengshi[3]]=PPP[3]
    dicquanzhou={}
    dicquanzhou[chengshi[4]]=PPP[4]
    dicguangzhou={}
    dicguangzhou[chengshi[5]]=PPP[5]
    dicmupu={}
    dicmupu[chengshi[6]]=PPP[6]
    dicjizhou={}
    dicjizhou[chengshi[7]]=PPP[7]
    dicyushui={}
    dicyushui[chengshi[8]]=PPP[8]
    dicbusan={}
    dicbusan[chengshi[9]]=PPP[9]
    diculsan={}
    diculsan[chengshi[10]]=PPP[10]
    dicdaqiu={}
    dicdaqiu[chengshi[11]]=PPP[11]
    dicjiumi={}
    dicjiumi[chengshi[12]]=PPP[12]
    dicandong={}
    dicandong[chengshi[13]]=PPP[13]
    dicyongdo={}
    dicyongdo[chengshi[14]]=PPP[14]
    dictaibai={}
    dictaibai[chengshi[15]]=PPP[15]
    dicqingzhou={}
    dicqingzhou[chengshi[16]]=PPP[16]
    dicyuanzhou={}
    dicyuanzhou[chengshi[17]]=PPP[17]
    dicdatian={}
    dicdatian[chengshi[18]]=PPP[18]
    #"서울특별시","인천광역시","서산","보령","전주","광주광역시","목포","제주특별자치도","여수","부산광역시","울산광역시","대구광역시","구미","안동","영덕","태백","충주","원주","대전광역시"
    for p in range((endtime-starttime).days):
            dicsourl['서울특별시'][day[p]]=blist[0][p]
    for p in range((endtime-starttime).days):
            dicincheon['인천광역시'][day[p]]=blist[1][p]
    for p in range((endtime-starttime).days):
            dicsosan['서산'][day[p]]=blist[2][p]
    for p in range((endtime-starttime).days):
            dicbaolin['보령'][day[p]]=blist[3][p]
    for p in range((endtime-starttime).days):
            dicquanzhou['전주'][day[p]]=blist[4][p]
    for p in range((endtime-starttime).days):
            dicguangzhou['광주광역시'][day[p]]=blist[5][p]
    for p in range((endtime-starttime).days):
            dicmupu['목포'][day[p]]=blist[6][p]
    for p in range((endtime-starttime).days):
            dicjizhou['제주특별자치도'][day[p]]=blist[7][p]
    for p in range((endtime-starttime).days):
            dicyushui['여수'][day[p]]=blist[8][p]
    for p in range((endtime-starttime).days):
            dicbusan['부산광역시'][day[p]]=blist[9][p]
    for p in range((endtime-starttime).days):
            diculsan['울산광역시'][day[p]]=blist[10][p]
    for p in range((endtime-starttime).days):
            dicdaqiu['대구광역시'][day[p]]=blist[11][p]
    for p in range((endtime-starttime).days):
            dicjiumi['구미'][day[p]]=blist[12][p]
    for p in range((endtime-starttime).days):
            dicandong['안동'][day[p]]=blist[13][p]
    for p in range((endtime-starttime).days):
            dicyongdo['영덕'][day[p]]=blist[14][p]
    for p in range((endtime-starttime).days):
            dictaibai['태백'][day[p]]=blist[15][p]
    for p in range((endtime-starttime).days):
            dicqingzhou['충주'][day[p]]=blist[16][p]
    for p in range((endtime-starttime).days):
            dicyuanzhou['원주'][day[p]]=blist[17][p]
    for p in range((endtime-starttime).days):
            dicdatian['대전광역시'][day[p]]=blist[18][p]
    dicfinal={}
    dicfinal.update(dicsourl)
    dicfinal.update(dicincheon)
    dicfinal.update(dicsosan)
    dicfinal.update(dicbaolin)
    dicfinal.update(dicquanzhou)
    dicfinal.update(dicguangzhou)
    dicfinal.update(dicmupu)
    dicfinal.update(dicjizhou)
    dicfinal.update(dicyushui)
    dicfinal.update(dicbusan)
    dicfinal.update(diculsan)
    dicfinal.update(dicdaqiu)
    dicfinal.update(dicjiumi)
    dicfinal.update(dicandong)
    dicfinal.update(dicyongdo)
    dicfinal.update(dictaibai)
    dicfinal.update(dicqingzhou)
    dicfinal.update(dicyuanzhou)
    dicfinal.update(dicdatian)
    #"서울특별시","인천광역시","서산","보령","전주","광주광역시","목포","제주특별자치도","여수","부산광역시","울산광역시","대구광역시","구미","안동","영덕","태백","충주","원주","대전광역시"
    a=dicfinal['서울특별시'][date]
    b=dicfinal['인천광역시'][date]
    c=dicfinal['서산'][date]
    d=dicfinal['보령'][date]
    e=dicfinal['전주'][date]
    f=dicfinal['광주광역시'][date]
    g=dicfinal['목포'][date]
    h=dicfinal['제주특별자치도'][date]
    i=dicfinal['여수'][date]
    j=dicfinal['부산광역시'][date]
    k=dicfinal['울산광역시'][date]
    l=dicfinal['대구광역시'][date]
    m=dicfinal['구미'][date]
    n=dicfinal['안동'][date]
    o=dicfinal['영덕'][date]
    p=dicfinal['태백'][date]
    q=dicfinal['충주'][date]  
    r=dicfinal['원주'][date]
    s=dicfinal['대전광역시'][date]
    ppp = np.vstack((a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s))
    lof = LocalOutlierFactor(n_neighbors=10, contamination=0.2, algorithm='auto', n_jobs=-1, novelty=True)
    lof.fit(ppp)
    return list(np.abs(lof.negative_outlier_factor_))


if __name__ == '__main__':
    a=eachcityscore(sys.argv[1],sys.argv[2],sys.argv[3])
    for i in range(0,len(a)):
        print(a[i])
            