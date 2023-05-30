#!/bin/bash

sudo service apache2 start
sudo service mysql start
sudo php -S 127.0.0.1:8000
#sudo curl ifconfig