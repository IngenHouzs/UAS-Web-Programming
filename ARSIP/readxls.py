import pandas as pd
import openpyxl
import mysql.connector
import os

from datetime import datetime

db = mysql.connector.connect(
    host = "localhost",
    user = "root",
    password = "",
    database = "projek_uas"
)


data = pd.read_excel(os.getcwd() + '\daftar PD SMP TMS.xlsx')

dbCursor = db.cursor()

now = datetime.now()
time = now.strftime("%Y-%m-%d %H:%M:%S")

for i, row in data[4:].iterrows():
    dbCursor.execute(f"INSERT INTO users VALUES('{row[1]}', '{row[0]}', '{row[1]}', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '{time}', '{time}')")


db.commit()


