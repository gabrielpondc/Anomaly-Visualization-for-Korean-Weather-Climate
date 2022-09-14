import torch
import torch.nn as nn

class Graph2Vec(nn.Module):
    def __init__(self, n_input, n_output):
        super(Graph2Vec, self).__init__()

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