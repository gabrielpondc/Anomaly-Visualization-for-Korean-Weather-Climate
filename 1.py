import pandas as pd

import sys
 
def csv_file_read(csv):
    # 读取表头
    # 你猜猜这是干啥的
    head_row = pd.read_csv(csv, nrows=0)
    print(list(head_row))
    # 表头列转为 list
    head_row_list = list(head_row)
 
    # 读取
    csv_result = pd.read_csv(csv, usecols=head_row_list)
    row_list = csv_result.values.tolist()
    print(f"行读取结果：{row_list}")
    col_obj = csv_result.T
    col_list = col_obj.values.tolist()
    print(f"行转列读取结果：{col_list}")
    return head_row_list, col_list


arg1 = sys.argv[1]+'?raw=true'

csv_file_read(arg1)
