from sre_constants import SUCCESS
from flask import Flask, request, jsonify
from flask_cors import CORS
import requests
import json 
import sys
import random
from Adafruit_IO import MQTTClient
from http import client

app = Flask(__name__)
CORS(app)

AIO_FEED_ID=["nhiet-do","do-am","changetem","lasttime"]
AIO_USERNAME="hoangproIT"
AIO_KEY="aio_TOfW954PUsB8V2W3ezbOwV0jAcrZ"

def connected(client):
    print("Ket noi thanhh cong")
    for feed in AIO_FEED_ID:
        client.subscribe(feed)

def disconnected(client):
    print("Ngat ket noi")
    sys.exit(1)
    
def subscribe(client,userdata,mid,granted_qos):
    print("Subscribe thanhh cong")
    
def message(payload,client=client,feed_id=AIO_FEED_ID):
    print("message")

client=MQTTClient(AIO_USERNAME,AIO_KEY)
client.on_connect=connected
client.on_disconnect=disconnected
client.on_message=message
client.on_subscribe=subscribe
client.connect()
client.loop_background()

def getData():
    dct = {}
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
    dct = {}
    try:
        responseTime = requests.get("https://io.adafruit.com/api/v2/hoangproIT/feeds/lasttime/data")
        lst_time=responseTime.text.strip()
        dct["time"]=lst_time
        print("success")
    except:
        pass
        print("error")
    return  json.dumps(dct, indent = 4) 

def random_data(value):
    if value == AIO_FEED_ID[0]:
        return random.randint(80, 110)/3
    else:
        return random.randint(400, 500)/5

@app.route('/check', methods=['GET'])
def home():
    client.publish(AIO_FEED_ID[0], random_data(AIO_FEED_ID[0]))
    client.publish(AIO_FEED_ID[1], random_data(AIO_FEED_ID[1]))
    client.publish(AIO_FEED_ID[3],"1")
    return getData()

@app.route('/check1', methods=['GET'])
def home2():
    return getData()

@app.route('/time', methods=['GET'])
def time():
    return getDataTime()

@app.route('/control', methods=['POST'])
def home1():
    client.publish(AIO_FEED_ID[2],request.data)
    return jsonify({'task': SUCCESS})

app.run()