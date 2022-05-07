from tkinter import Checkbutton
import flask
from tokenize import group


app = flask.Flask(__name__)
app.config["DEBUG"] = True

def CheckButton():
    pass

def getData():
    pass

@app.route('/check', methods=['GET'])
def home():
    CheckButton()
    listData=getData()
    return listData

@app.route('/control', methods=['POST'])
def home1():
    return ""

app.run()