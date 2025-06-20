#!/usr/bin/env python3
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from sys import argv, exit
import os

# check args
if len(argv) == 2 and argv[1] == "-h":
    print("""usage:
    ./send_mail.py [to] [subject] [content]

        [to]: the mail of the person that will recive the mail
        [subject]: the subject of the mail
        [content]: the content of the mail

    ex: ./send_mail.py "exemple@mail.com" "SUBJECT" "this is an automatic mail\"""")
    exit(0)
if len(argv) != 4:
    exit(1)

# get .env var
from dotenv import load_dotenv
load_dotenv()

MAIL_MAIL = os.getenv("MAIL_MAIL")
MAIL_MDP = os.getenv("MAIL_MDP")
MAIL_RECEPTOR = argv[1]
SUBJECT = argv[2]
CONTENT = argv[3]

# create the mail to send
msg = MIMEMultipart()
msg["From"] = MAIL_MAIL
msg["To"] = MAIL_RECEPTOR
msg["Subject"] = SUBJECT
msg.attach(MIMEText(CONTENT, "plain", "utf-8"))

try:
    with smtplib.SMTP("smtp." + MAIL_MAIL.split("@")[1], 587) as server:
        server.starttls()
        server.login(MAIL_MAIL, MAIL_MDP)
        server.send_message(msg)
        print("Email sent successfully")
except:
    print("Error with the mail: ", MAIL_RECEPTOR)
    exit(2)
