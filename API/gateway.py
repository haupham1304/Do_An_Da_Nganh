from http import client
import random
import time
import sys
from Adafruit_IO import MQTTClient



AIO_FEED_ID=["nhiet-do","do-am","changetem"]
AIO_USERNAME="hoangproIT"
AIO_KEY="aio_ovLE08GZ234DJz0saHx0tSF57ZLW"

def connected(client):
    print("Ket noi thanhh cong")
    for feed in AIO_FEED_ID:
        client.subscribe(feed)

def subscribe(client,userdata,mid,granted_qos):
    print("Subscribe thanhh cong")

def disconnected(client):
    print("Ngat ket noi")
    sys.exit(1)
    
def message(payload,client=client,feed_id=AIO_FEED_ID):
    print("message")
    
def random_data(value):
    if value == AIO_FEED_ID[0]:
        return random.randint(80, 110)/3
    else:
        return random.randint(400, 500)/5
    
def writeData():
    client.publish(AIO_FEED_ID[0], random_data(AIO_FEED_ID[0]))
    client.publish(AIO_FEED_ID[1], random_data(AIO_FEED_ID[1]))

client=MQTTClient(AIO_USERNAME,AIO_KEY)
client.on_connect=connected
client.on_disconnect=disconnected
client.on_message=message
client.on_subscribe=subscribe
client.connect()
client.loop_background()

while True:
    writeData()
    time.sleep(300)