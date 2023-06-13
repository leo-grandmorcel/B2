import pickle
import base64
from flask import Flask, render_template, redirect, request, make_response

app = Flask(__name__)
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "memcached"


@app.route("/")
def index():
    if request.cookies.get("username"):
        username = pickle.loads(base64.b64decode(request.cookies.get("username")))
        return render_template("index.html", name=username)
    return redirect("/login")


@app.route("/login", methods=["POST", "GET"])
def login():
    if request.method == "POST":
        resp = make_response(redirect("/"))
        username = base64.b64encode(pickle.dumps(request.form.get("name")))
        resp.set_cookie("username", username)
        return resp
    return render_template("login.html")


@app.route("/logout")
def logout():
    resp = make_response(redirect("/login"))
    resp.set_cookie("username", "", expires=0)
    return resp


if __name__ == "__main__":
    app.run(debug=True)
