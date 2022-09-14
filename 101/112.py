import requests
import json
from prettytable import PrettyTable
import time
from datetime import datetime
cookies = {
    'MYC_RCNT_MENU': '%3Cli%3E%3Ca%20href%3D%22javascript%3Amyc_f_goRecentMenu(\'MYC_MNU_00000450\')%3B%22%3E%EC%88%98%EC%9E%85%ED%99%94%EB%AC%BC%20%EC%A7%84%ED%96%89%EC%A0%95%EB%B3%B4%3C%2Fa%3E%3C%2Fli%3E',
    'JSESSIONID': '0001JN7lY82cMI7IPgMb3K6Lz2D_-ZmdpeB7ZeL3MAIhYdEtCcNMNlr1R999Bmbev-uLB5JtWW7qJE8E2WJf7Z3gVnGz9zgEfVoHQhmel2OQCzsMvcae1mXAV5jPjNA17QpI:csp22',
    'WMONID': 'PvHHOrn5VnO',
    'MagicLineSession': 'SaXyT6rMv9G0dhpvezIS',
}

headers = {
    'Accept': 'application/json, text/javascript, */*; q=0.01',
    'Accept-Language': 'zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
    'Connection': 'keep-alive',
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    # Requests sorts cookies= alphabetically
    # 'Cookie': 'MYC_RCNT_MENU=%3Cli%3E%3Ca%20href%3D%22javascript%3Amyc_f_goRecentMenu(\'MYC_MNU_00000450\')%3B%22%3E%EC%88%98%EC%9E%85%ED%99%94%EB%AC%BC%20%EC%A7%84%ED%96%89%EC%A0%95%EB%B3%B4%3C%2Fa%3E%3C%2Fli%3E; JSESSIONID=0001JN7lY82cMI7IPgMb3K6Lz2D_-ZmdpeB7ZeL3MAIhYdEtCcNMNlr1R999Bmbev-uLB5JtWW7qJE8E2WJf7Z3gVnGz9zgEfVoHQhmel2OQCzsMvcae1mXAV5jPjNA17QpI:csp22; WMONID=PvHHOrn5VnO; MagicLineSession=SaXyT6rMv9G0dhpvezIS',
    'Origin': 'https://unipass.customs.go.kr',
    'Referer': 'https://unipass.customs.go.kr/csp/index.do',
    'Sec-Fetch-Dest': 'empty',
    'Sec-Fetch-Mode': 'cors',
    'Sec-Fetch-Site': 'same-origin',
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44',
    'X-Requested-With': 'XMLHttpRequest',
    'isAjax': 'true',
    'sec-ch-ua': '" Not;A Brand";v="99", "Microsoft Edge";v="103", "Chromium";v="103"',
    'sec-ch-ua-mobile': '?0',
    'sec-ch-ua-platform': '"macOS"',
}

data = {
    'firstIndex': '0',
    'recordCountPerPage': '10',
    'page': '1',
    'pageIndex': '1',
    'pageSize': '10',
    'pageUnit': '10',
    'cargMtNo': '22HDFC6114i97704000',
}

response = requests.post('https://unipass.customs.go.kr/csp/myc/bsopspptinfo/cscllgstinfo/ImpCargPrgsInfoMtCtr/retrieveImpCargPrgsInfoDtl.do', cookies=cookies, headers=headers, data=data)
a=response.content.decode('utf-8')
table = PrettyTable(['当前进度', '时间', '审查人员'])
json_data=json.dumps(a,ensure_ascii=False).encode('utf8').decode('utf-8')
json_data=json.loads(json_data)
json_data=json.loads(json_data)
res=json_data['printResultListL']
print(json_data['resultListM'])