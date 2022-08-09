import sys
import requests
import os
import time

class webChecker:
    def __init__(self, ip):
        self.ip = ip
        self.url = 'http://%s/' % (ip) 
        self.name = 'checker'
        self.password = 'checker123456'
        self.email = 'checker@test.com'
        self.filename = 'check.jpg'

    def check1(self): #check Register
        print("-----check1: Register-----")
        try:
            url = self.url + 'process-signup.php'
            data = {
                "name": self.name,
                "email": self.email,
                "password": self.password,
                "password_confirmation": self.password,
            }
            rs = requests.post(url, data)
            if rs.url == self.url + 'signup-success.html':
                pass
            else: 
                raise Exception("[-] Register failed.")
        except Exception as e:
            raise Exception("[!] Check1 error, %s" % e)
        time.sleep(2)
        print ("[+] Register Success.")

    def check2(self): #check Login
        print("-----check2: Login-----")
        try:
            url = self.url + 'login.php'
            data = {
                "name": self.name,
                "password": self.password,
            }
            rs = requests.post(url, data)
            if rs.url == self.url + 'upload.php' :
                pass
            else:
                raise Exception("[-] Login failed.")
        except Exception as e:
            raise Exception("[!] Check2 error, %s" % e)
        time.sleep(2)
        print ("[+] Login Success.")

    def check3(self): #check Upload
        print("-----check3: Upload-----")
        try:
            url = self.url + 'upload.php'
            path=os.path.dirname(os.getcwd()) + '/check脚本/check.jpg'
            file = {'file':open(path,'rb')}
            rs = requests.post(url=url, files=file)
            if not rs :
                raise Exception("[-] Upload failed.")
        except Exception as e:
            raise Exception("[!] Check3 error, %s" % e)
        time.sleep(2)
        print ("[+] Upload Success.")

    def check4(self): #check Download File
        print("-----check4: Download File-----")
        try:
            url = self.url + 'uploadFiles/' + self.filename
            rs = requests.get(url, stream=True)
            with open(os.path.dirname(os.getcwd()) + '/check脚本/check4/success.jpg', 'wb') as logfile :
                for chunk in rs:
                    logfile.write(chunk)
                logfile.close()
        except Exception as e:
            raise Exception("[!] Check4 error, [-] Download File failed.")
        time.sleep(2)
        print ("[+] Download File Success.")

    def check5(self): #check Flag
        print("-----check5: Get_Flag-----")
        try:
            path=os.path.dirname(os.getcwd()) + '\exp脚本\exp_output.txt'
            f = open(path, 'r')
            content = f.read()
            target = 'Flag is'
            if target in content :
                pass
            else :
                raise Exception("[-] Get Flag failed.")
        except Exception:
            raise Exception("[!] Check5 error, [-] Get Flag failed.")
        time.sleep(2)
        print ("[+] Get Flag Success.")
        print (content)

    def check6(self): #check Logout
        print("-----check6: Logout-----")
        try:
            url = self.url + 'Logout.php'
            rs = requests.post(url)
            if rs.url == self.url + 'index.php' :
                pass
            else:
                raise Exception("[-] Logout failed.")
        except Exception as e:
            raise Exception("[!] Check6 error, %s" % e)
        time.sleep(2)
        print ("[+] Logout Success.")

def checker(ip):
    try:
        check = webChecker(str(ip))
        check.check1()
        check.check2()
        check.check3()
        check.check4()
        check.check5()
        check.check6()
        print ('[!] Checker Is Done')
    except Exception as ex:
        return '[!] Error, Unknown Exception,' + str(ex)

if __name__ == '__main__':
    if len(sys.argv) != 2:
        print("Wrong Params")
        print("example: python %s %s" % (sys.argv[0], 'localhost'))
        exit(0)
    ip = sys.argv[1]

    checker(ip)