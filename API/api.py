from tkinter import Checkbutton
import flask
from tokenize import group
import requests
import json


app = flask.Flask(__name__)
app.config["DEBUG"] = True

def CheckButton():
    pass

def getData():
    dic={}
    try:
        responseNhietDo = requests.get("https://io.adafruit.com/api/v2/hoangproIT/feeds/nhiet-do/data")
        responseDoAm = requests.get("https://io.adafruit.com/api/v2/hoangproIT/feeds/do-am/data")
        lst_temp=json.loads(responseNhietDo.text.strip())
        lst_humi=json.loads(responseDoAm.text.strip())
        dic['nhiet_do']=[]
        dic['do_am']=[]
        for i in lst_temp:
            dic['nhiet_do']+=[(i["created_at"],i["value"])]
        for i in lst_humi:
            dic['do_am']+=[(i["created_at"],i["value"])]
    except:
        pass
    return dic

@app.route('/check', methods=['GET'])
def home():
    CheckButton()
    listData=getData()
    return listData

@app.route('/control', methods=['POST'])
def home1():
    return ""

app.run()