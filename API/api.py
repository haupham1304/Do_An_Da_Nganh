<<<<<<< Updated upstream
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
AIO_KEY="aio_bkLo16fvKPah5qraWFMOiGQN8RJ2"

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
=======
import flask
from tokenize import group
import json
import requests

api_url_base = 'https://io.adafruit.com/api/v2/'
api_token1 = 'hoangproIT/feeds/nhiet-do'
api_token2 = 'hoangproIT/feeds/do-am'
app = flask.Flask(__name__)
app.config["DEBUG"] = True
>>>>>>> Stashed changes

acc_url1 = api_url_base + api_token1
acc_info1 = json.loads(requests.get(acc_url1).text)
print(acc_info1)
print()
acc_url2 = api_url_base + api_token2
acc_info2 = json.loads(requests.get(acc_url2).text)
print(acc_info2)

data = {}
data['nhiet-do'] = []
data['do-am'] = []
data['nhiet-do'].append({
    'value': acc_info1['last_value'],
    'time': acc_info1['updated_at']
})
data['do-am'].append({
    'value': acc_info2['last_value'],
    'time': acc_info2['updated_at']
})


with open('data.txt', 'w') as outfile:
    json.dump(data, outfile)

def checkButton():
    pass

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