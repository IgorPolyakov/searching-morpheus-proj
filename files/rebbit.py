#!/usr/bin/env python
# -*- coding: utf-8 -*-
 
import socket
import threading
import sys
import math
import os
import errno

host = ""
port = 3333
thrs = []

class Connect(threading.Thread):
	def __init__(self, sock, addr):
		self.sock = sock
		self.addr = addr
		self.bKill = False
		threading.Thread.__init__(self)
	def run (self):
		self.sock.send("Wake up, Neo… The Matrix has you\n> ")
		buf = self.sock.recv(20)
		buf = buf.strip()
		if buf == "follow the rabbit":
			self.sock.send("flag:rabbittalkwithyou\n")
		else:
			self.sock.send("Access deny. Bye-bye.\n")

		self.sock.shutdown(socket.SHUT_RDWR);
		self.bKill = True
		thrs.remove(self)
	def kill(self):
		if self.bKill == True:
			return
		self.bKill = True
		self.sock.close()
		# thrs.remove(self)
 
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
s.bind((host, port))
s.listen(10)
print('Started server on ' + str(port) + ' port.');
        
try:
	while True:
		sock, addr = s.accept()
		thr = Connect(sock, addr)
		thrs.append(thr)
		thr.start()
except KeyboardInterrupt:
    print('Bye! Write me letters!')
    s.close()
    for thr in thrs:
		thr.kill()
