from curses import baudrate
from http import client
from time import time
import sys
from Adafruit_IO import MQTTClient
import serial.tools.list_ports


AIO_FEED_ID=["nhiet-do","do-am","tin-hieu"]
AIO_USERNAME="hoangproIT"
AIO_KEY="aio_ZDWV883Bbj4Y4dZmUxFKNKChA46S"

def connected(client):
    print("Ket noi thanhh cong")
    for feed in AIO_FEED_ID:
        client.subscribe(feed)

def subscribe(client,userdata,mid,granted_qos):
    print("Subscribe thanhh cong")

def disconnected(client):
    print("Ngat ket noi")
    sys.exit(1)

def message(client,feed_id,payload):
    print("data: "+payload)
    if(is_microbit_connected):
        ser.write((str(payload)+"#").encode())

def getPort():
    ports=serial.tools.list_ports.comports()
    N=len(ports)
    comm_port=None
    for i in range(0,N):
        port=ports[i]
        str_port=str(port)
        if "USB Serial Device" in str_port:
            split_port=str_port.split(" ")
            comm_port=(split_port[0])
    return comm_port

def processData(data:str,tranId):
    data=data.replace("!","")
    data=data.replace("#","")
    split_data=data.split(":")
    try:
        if split_data[1]=="TEMP":
            client.publish("nhiet-do",split_data[2])
            if(tranId==int(split_data[1])):
                pass
        else:
            client.publish("do-am",split_data[2])
            if(tranId==int(split_data[1])):
                pass
    except:
        pass



mess=""
def readSerial():
    bytes_to_read=ser.inWaiting()
    if(bytes_to_read>0):
        global mess
        mess+=ser.read(bytes_to_read).decode("UTF-8")
        while("#" in mess) and ("!" in mess):
            start=mess.find("!")
            end=mess.find("#")
            processData(mess[start:end+1])
            if(end==len(mess)):
                mess=""
            else:
                mess=mess[end+1:]

is_microbit_connected=False
if getPort()!="None":
    ser=serial.Serial(port=getPort(),baudrate=115200)
    is_microbit_connected=True


client=MQTTClient(AIO_USERNAME,AIO_KEY)
client.on_connect=connected
client.on_disconnect=disconnected
client.on_message=message
client.on_subscribe=subscribe
client.connect()
client.loop_background()

while True:
    if(is_microbit_connected):
        readSerial()
    time.sleep(1)


