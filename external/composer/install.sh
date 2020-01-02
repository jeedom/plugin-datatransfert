#!/bin/sh
sudo apt-get -y install wget
ME=`cd $(dirname $0); pwd`
cd $ME
pwd
rm -f composer.phar
wget https://getcomposer.org/download/1.9.1/composer.phar
cd $ME/../..
pwd
php $ME/composer.phar install
rm -f $ME/composer.phar
