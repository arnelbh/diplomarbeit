#!/usr/bin/env python3

""" This program asks a client for data and waits for the response, then sends an ACK. """

# Copyright 2018 Rui Silva.
#
# This file is part of rpsreal/pySX127x, fork of mayeranalytics/pySX127x.
#
# pySX127x is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public
# License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later
# version.
#
# pySX127x is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
# details.
#
# You can be released from the requirements of the license by obtaining a commercial license. Such a license is
# mandatory as soon as you develop commercial activities involving pySX127x without disclosing the source code of your
# own applications, or shipping pySX127x with a closed source product.
#
# You should have received a copy of the GNU General Public License along with pySX127.  If not, see
# <http://www.gnu.org/licenses/>.

import time
from SX127x.LoRa import *
#from SX127x.LoRaArgumentParser import LoRaArgumentParser
from SX127x.board_config import BOARD
from influxdb import InfluxDBClient

import pymysql.cursors

BOARD.setup()
BOARD.reset()
#parser = LoRaArgumentParser("Lora tester")

client = InfluxDBClient(database='glasshaus')


class mylora(LoRa):
    def __init__(self, verbose=False):
        super(mylora, self).__init__(verbose)
        self.set_mode(MODE.SLEEP)
        self.set_dio_mapping([0] * 6)
        self.var=0

    def on_rx_done(self):
        #BOARD.led_on()
        #print("\nRxDone")
        self.clear_irq_flags(RxDone=1)
        payload = self.read_payload(nocheck=True)
        
        print ("Receive: ")
        #print(bytes(payload).decode("utf-8",'ignore')) # Receive DATA
        data_rec = bytes(payload).decode("utf-8",'ignore') # Receive DATA
        print(data_rec)
        #soil_hum_rec, air_hum_rec, air_temp_rec = data_rec.split(' ')
        #soil_hum_rec = data_rec.split(' ')

        soil_hum_rec = data_rec
        air_hum_rec = "48"
        air_temp_rec = "28"

        json_body = [
            {
            "measurement": "sensors",
            "tags": {
                "lora": "arduino",
                },
            "fields": {
                "soil_hum": soil_hum_rec,
                "air_hum": air_hum_rec,
                "air_temp": air_temp_rec
                }
            }
        ]

        client.write_points(json_body)

        # Open database connection
        connection = pymysql.connect(host='localhost',
                             user='root',
        #                     password='passwd',
                             database='gh',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

        with connection:
            #with connection.cursor() as cursor:
                # Create a new record
            #    sql = "SELECT * FROM "act""
            #    cursor.execute(sql)

            # connection is not autocommit by default. So you must commit to save
            # your changes.
            #connection.commit()

            with connection.cursor() as cursor:
                # Read a single record
                sql = "SELECT * FROM `act`"
                cursor.execute(sql)
                result = cursor.fetchone()
            #    print(result)
        


        #BOARD.led_off()
        #time.sleep(2) # Wait for the client be ready
        #print ("Send: ACK")
        # Plava Zuta zelena crvena
        #data_str = "0000"
        data_str = str(result['act1']) + str(result['act2']) + str(result['act3']) + str(result['act4']) + str(result['behelterMax']) + str(result['behelterMin']) + str(result['tempMax']) + str(result['tempMin'])
        print ("Send: ", data_str)
        data_bytes = list(bytes(data_str, encoding='utf-8'))

        LOCAL_ADDR = 255
        RECIEVER_ADDR = 0
        DUMP = 0
        message = [RECIEVER_ADDR, LOCAL_ADDR, DUMP]
        message.append(len(data_bytes))

        for i in range(len(data_bytes)): message.append(data_bytes[i])
        self.write_payload(message)
        print(message)

        # self.write_payload([0, 255, 0, 3, 0, 1, 0]) # Send ACK
        self.set_mode(MODE.TX)
        self.var=1

    def on_tx_done(self):
        print("\nTxDone")
        print(self.get_irq_flags())

    def on_cad_done(self):
        print("\non_CadDone")
        print(self.get_irq_flags())

    def on_rx_timeout(self):
        print("\non_RxTimeout")
        print(self.get_irq_flags())

    def on_valid_header(self):
        print("\non_ValidHeader")
        print(self.get_irq_flags())

    def on_payload_crc_error(self):
        print("\non_PayloadCrcError")
        print(self.get_irq_flags())

    def on_fhss_change_channel(self):
        print("\non_FhssChangeChannel")
        print(self.get_irq_flags())

    def start(self):          
        while True:
            while (self.var==0):
                #print ("Send: INF")
                #self.write_payload([0, 255, 0, 0, 73, 78, 70, 0]) # Send INF
                #self.set_mode(MODE.TX)
                time.sleep(1) # there must be a better solution but sleep() works
                self.reset_ptr_rx()
                self.set_mode(MODE.RXCONT) # Receiver mode
            
                start_time = time.time()
                while (time.time() - start_time < 1): # wait until receive data or 10s
                    pass
            
            self.var=0
            self.reset_ptr_rx()
            self.set_mode(MODE.RXCONT) # Receiver mode
            time.sleep(1)

lora = mylora(verbose=False)
#args = parser.parse_args(lora) # configs in LoRaArgumentParser.py

#     Slow+long range  Bw = 125 kHz, Cr = 4/8, Sf = 4096chips/symbol, CRC on. 13 dBm
#lora.set_pa_config(pa_select=1, max_power=21, output_power=15)
#lora.set_bw(BW.BW125)
#lora.set_coding_rate(CODING_RATE.CR4_8)
#lora.set_spreading_factor(12)
#lora.set_rx_crc(True)
#lora.set_lna_gain(GAIN.G1)
#lora.set_implicit_header_mode(False)
#lora.set_low_data_rate_optim(True)

#  Medium Range  Defaults after init are 434.0MHz, Bw = 125 kHz, Cr = 4/5, Sf = 128chips/symbol, CRC on 13 dBm
lora.set_pa_config(pa_select=1)
lora.set_freq(868)


assert(lora.get_agc_auto_on() == 1)

try:
    print("START")
    lora.start()
except KeyboardInterrupt:
    sys.stdout.flush()
    print("Exit")
    sys.stderr.write("KeyboardInterrupt\n")
finally:
    sys.stdout.flush()
    print("Exit")
    lora.set_mode(MODE.SLEEP)
    BOARD.teardown()


