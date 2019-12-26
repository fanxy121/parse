#!/usr/bin/env python
# encoding: utf-8

import requests, urllib, json

appId = ""
appSecret = ""
url = ""

params = {
    "appId": appId,
    "appSecret": appSecret,
    "url": url
}

api_url = "https://api-sv.videoparse.cn/api/video/normalParse"

def get(url):
    '''

    :param url:
    :return:
    '''
    msg = {"code": 0, "msg": "", "body": ""}
    url = url + "?" + urllib.parse.urlencode(params)
    response = requests.get(url=url, timeout=30)
    if response.status_code != 200:
        msg['code'] = 1
        msg["msg"] = "请求出现问题"
        return msg
    # result = json.loads(response.text)      如果你直接拿到系统中使用请将返回参数直接转为json
    result = response.text  # 如果你不需要转换json，则直接接受数据并返回
    return result

def post(url, data):
    '''
    :param url:
    :param data:
    :param headers:
    :return:
    '''
    msg = {"code": 0, "msg": "", "body": ""}
    response = requests.post(url=url, data=data, timeout=30)
    if response.status_code != 200:
        msg['code'] = 1
        msg["msg"] = "请求出现问题"
        return msg
    #result = json.loads(response.text)      如果你直接拿到系统中使用请将返回参数直接转为json
    result = response.text                  # 如果你不需要转换json，则直接接受数据并返回
    return result
