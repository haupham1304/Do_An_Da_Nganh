from operator import truediv
from flask import Flask, request, jsonify
from flask_cors import CORS
from tokenize import group
import requests
import json 
import sys
from Adafruit_IO import MQTTClient

app = Flask(__name__)
CORS(app)

AIO_FEED_ID=["nhiet-do","do-am","tin-hieu"]
AIO_USERNAME="hoangproIT"
AIO_KEY="aio_lceG713SqkeRZVzO7sSksNAxko4c"

def connected(client):
    print("Ket noi thanhh cong")
    for feed in AIO_FEED_ID:
        client.subscribe(feed)

def disconnected(client):
    print("Ngat ket noi")
    sys.exit(1)

client=MQTTClient(AIO_USERNAME,AIO_KEY)
client.on_connect=connected
client.on_disconnect=disconnected
client.connect()
client.loop_background()

def getData():
    dct={}
    try:
        responseNhietDo = requests.get("https://io.adafruit.com/api/v2/hoangproIT/feeds/nhiet-do/data")
        responseDoAm = requests.get("https://io.adafruit.com/api/v2/hoangproIT/feeds/do-am/data")
        lst_temp=responseNhietDo.text.strip()
        lst_humi=responseDoAm.text.strip()
        dct["temp"]=lst_temp
        dct["hummid"]=lst_humi
        print("success")
    except:
        pass
        print("error")
    return  json.dumps(dct, indent = 4) 

def getDataTime():
    dct={}
    try:
        responseTime = requests.get("https://io.adafruit.com/api/v2/hoangproIT/feeds/lasttime/data")
        lst_time=responseTime.text.strip()
        dct["time"]=lst_time
        print("success")
    except:
        pass
        print("error")
    return  json.dumps(dct, indent = 4) 
    

@app.route('/check', methods=['GET'])
def home():
    client.publish("lasttime","1")
    return getData()

@app.route('/check1', methods=['GET'])
def home2():
    return getData()

@app.route('/time', methods=['GET'])
def time():
    return getDataTime()

@app.route('/control', methods=['POST'])
def home1():
    return ""

app.run()