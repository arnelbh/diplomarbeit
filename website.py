#!/usr/bin/env python3

from flask import Flask, redirect, url_for, render_template, request
from diplomski import *

app = Flask(__name__)


def control():
    if request.method == 'POST':
        if request.form['submit_button'] == 'Do Something':
            pass # do something
        elif request.form['submit_button'] == 'Do Something Else':
            pass # do something else
        else:
            pass # unknown
    elif request.method == 'GET':
        return render_template('contact.html', form=form)

# Defining the home page of our site
@app.route("/")  # this sets the route to this page
def home():
	#return "Hello"
    return render_template("glasshaus.html")

if __name__ == "__main__":
    app.run()