import numpy as np
import torch
import torch.nn as nn
from GraphConstruction import T2G
from sklearn.neighbors import LocalOutlierFactor
import sys



if  len(sys.argv) > 1:
    if sys.argv[1] == "-h":
             print("Please upload the raw data from the github\n python3 Graph-Embedding.py github.com/xxx Title index")
    else:
        PATH = sys.argv[1]+'?raw=true'
        INX = sys.argv[2]
#PATH = "D:\Dropbox\Korean Weather\Seuol.csv"
t2g = T2G(PATH, INX)
df = t2g.DataLoading()
X,T = t2g.Graph()[0],t2g.Graph()[1]
e = t2g.graphentropy()
d = t2g.distance(e[0],e[1])
M = t2g.getMatrix()

TrainXTensor = torch.from_numpy(X.reshape(X.shape[0],X.shape[1]*X.shape[1])).type(torch.FloatTensor)
TrainSTensor = torch.from_numpy(M.reshape(X.shape[0],X.shape[1]*X.shape[1])).type(torch.FloatTensor)

class My_Loss(nn.Module):
    def __init__(self):
        super().__init__()
        
    def forward(self,x,de1,s,de2,ed1,ed2):
        l1 = torch.mean(torch.pow((x - de1),2))
        l2 = torch.mean(torch.pow((s - de2),2))
        l3 = torch.mean(torch.pow((ed1 - ed2),2))
        loss = l1 + l2 + l3
        return loss

class Graph2Vec(nn.Module):
    def __init__(self,n_input, n_output):
        super(Graph2Vec,self).__init__()
        self.PATH = PATH
        self.MatrixX = t2g.getMatrix()
        self.encode1 = nn.Sequential(nn.Linear(n_input, 10),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),

                                     nn.Linear(10, 9),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),

                                     nn.Linear(9, 9),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),

                                     nn.Linear(9, 10),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),
                                     )
        self.decode1 = nn.Sequential(nn.Linear(10, 9),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),

                                     nn.Linear(9, 9),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),

                                     nn.Linear(9, 10),
                                     nn.Dropout(0.7),
                                     nn.Tanh(),

                                     nn.Linear(10, n_output), )

    def forward(self, x, matrix):
        ed1 = self.encode1(x)
        ed2 = self.encode1(matrix)

        de1 = self.decode1(ed1)
        de2 = self.decode1(ed2)

        return ed1, ed2, de1, de2

Graph2Vecmodel = Graph2Vec(TrainXTensor.shape[1],TrainXTensor.shape[1])
optimizer = torch.optim.Adam(Graph2Vecmodel.parameters(),lr = 0.001)
loss_func = My_Loss()


Loss = []
Loss1 = []
for i in range(500):
    ed1,ed2,de1,de2 = Graph2Vecmodel(TrainXTensor,TrainSTensor)
    loss = loss_func(TrainXTensor,de1,TrainSTensor,de2,ed1,ed2)
    optimizer.zero_grad()
    loss.backward()
    optimizer.step()
    #print('Epoch: ',i, '|' ,'Traininng loss is %.4f' %loss.data.numpy())
    Embed = ed1.data.numpy()

#print(Embed)

lof = LocalOutlierFactor(n_neighbors = 10, contamination = 0.1,algorithm = 'auto',n_jobs = -1,novelty= True)
lof.fit(Embed)
y_pred_outliers_LOF = lof.predict(Embed)
#print(np.argwhere(y_pred_outliers_LOF == -1).reshape(1,-1))
result=[]
for i in (np.argwhere(y_pred_outliers_LOF == -1).reshape(1,-1)[0]): 
    result.append(T[i])
print(result)





