#!/bin/bash

###
# it will install prerequisites, deploy and create database.
# 1406382774s : tested on ubuntu trusty tahr
##


echo "prerequisites"

PACKAGE_LIST="
mysql-client
mysql-server
nginx
php5-fpm
php5-mysql
"

for pak in $PACKAGE_LIST ; do
  if ! dpkg -s $pak > /dev/null; then
      sudo apt-get install -y $pak
  fi
done


echo "deploying"
cd /tmp
rm -rf master.zip* aide-master*

wget https://github.com/aidewind/aide/archive/master.zip > /dev/null 2>&1
unzip master.zip > /dev/null 2>&1

sudo mv aide-master/etc/nginx/sites-available/default /etc/nginx/sites-available/default
sudo rm -rf aide-master/etc/nginx/sites-available

sudo rm -rf /usr/share/nginx/html/*
sudo cp -rf aide-master/* /usr/share/nginx/html

sudo chmod 755 -R /usr/share/nginx/html

echo "database creating"
mysql -u root -psecret < /usr/share/nginx/html/db.sql