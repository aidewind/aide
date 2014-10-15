#!/bin/bash
#reference: http://howtoubuntu.org/things-to-do-after-installing-ubuntu-14-04-trusty-tahr

sudo rm -rf /etc/apt/sources.list.d/*

#enable partner repository
sudo sed -i "/^# deb .*partner/ s/^# //" /etc/apt/sources.list
echo 'deb http://download.videolan.org/pub/debian/stable/ /' | sudo tee -a /etc/apt/sources.list.d/libdvdcss.list &&
echo 'deb-src http://download.videolan.org/pub/debian/stable/ /' | sudo tee -a /etc/apt/sources.list.d/libdvdcss.list &&
wget -O - http://download.videolan.org/pub/debian/videolan-apt.asc | sudo apt-key add -

#ppa repository
sudo add-apt-repository -y ppa:otto-kesselgulasch/gimp
sudo add-apt-repository -y ppa:videolan/stable-daily
sudo add-apt-repository -y ppa:webupd8team/java
sudo add-apt-repository -y ppa:webupd8team/sublime-text-3
sudo add-apt-repository -y ppa:webupd8team/y-ppa-manager
sudo apt-add-repository -y "deb http://repository.spotify.com stable non-free" &&
sudo apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 94558F59 &&

#updates and upgrades
sudo apt-get update -qq
sudo apt-get upgrade
sudo apt-get dist-upgrade

#essentials
PACKAGE_LIST="
aptitude
abntex 
ant 
arj
avr-libc 
avrdude 
binutils-avr 
binutils-msp430 
bleachbit
build-essential 
cabextract
cm-super 
faac
faad
ffmpeg2theora
file-roller
flac
flashplugin-installer
gcc-avr 
gcc-msp430 
gdb-avr 
gedit
gimp
gimp-data
gimp-data-extras
gimp-plugin-registry
git
gparted
htop
htop 
icedax
id3v2
jabref
lame
liba52-dev
libdvdcss2
libdvdnav4
libdvdread4
libflac++6
libjpeg-progs
libmad0
libmpeg2-4
libmpeg3-1
libncurses5-dev 
libreoffice
libreoffice-l10n-pt-br
libswscale-extra-2
libxine1-ffmpeg
make
mencoder
mpack
mpeg2dec
mpeg3-utils
mpegdemux
mpg123
mpg321
mplayer 
msp430-libc 
nautilus-dropbox 
nmap 
openjdk-7-jdk 
openjdk-7-jre
openssh-server 
oracle-java8-installer
p7zip-full
p7zip-rar
python-dev
rar
sharutils
sox
spotify-client
sublime-text-installer 
synaptic
texlive 
texlive-lang-portuguese 
texlive-latex-extra 
totem-mozilla
ubuntu-restricted-extras
ubuntu-wallpapers*v
unace
unrar
unzip
uudeview
vim
vlc
vorbis-tools
wine
y-ppa-manager
zip
"

for pak in $PACKAGE_LIST ; do
  if ! dpkg -s $pak > /dev/null; then
      sudo apt-get install -y $pak
  fi
done

#youtube-dl
sudo wget https://yt-dl.org/downloads/2014.08.10/youtube-dl -O /usr/local/bin/youtube-dl
sudo chmod a+x /usr/local/bin/youtube-dl

#google chrome
if [[ $(getconf LONG_BIT) = "64" ]]
then
	echo "64bit Detected" &&
	echo "Installing Google Chrome" &&
	wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb &&
	sudo dpkg -i google-chrome-stable_current_amd64.deb &&
	rm -f google-chrome-stable_current_amd64.deb
else
	echo "32bit Detected" &&
	echo "Installing Google Chrome" &&
	wget https://dl.google.com/linux/direct/google-chrome-stable_current_i386.deb &&
	sudo dpkg -i google-chrome-stable_current_i386.deb &&
	rm -f google-chrome-stable_current_i386.deb
fi

#contiki
 #git clone https://github.com/contiki-os/contiki.git
 #cd contiki/
 #git submodule update --init
 #cd tools/cooja

#eargasm
 #FILENAME=links
 #count=0
 #m=12
 #rm html
 #rm $FILENAME
 #wget --tries 70 -c http://eargasmusic.com/playlist/ -O html 
 #cat html | egrep -o  "(http|https)://www.youtube.*\"allow" | awk 'BEGIN {FS="\""};{print $1}' | sed 's/,/\n/g' > $FILENAME
 #while read LINE
 #do
 #  let count++
 #  if [ ${#LINE} -lt $m ]; then
 #    youtube-dl -o "%(id)s" $LINE
 #  fi
 #done < $FILENAME
 #echo -e "\nTotal $count Lines read"

#yEd
 #cd /tmp
 #wget -c http://www.yworks.com/products/yed/demo/yEd-3.13_64-bit_setup.sh
 #chmod +x yEd-3.13_64-bit_setup.sh
 #./yEd-3.13_64-bit_setup.sh

#cito
 #wget -c http://chianti.ucsd.edu/cytoscape-3.1.1/Cytoscape_3_1_1_unix.sh
 #chmod +x Cytoscape_3_1_1_unix.sh
 #./Cytoscape_3_1_1_unix.sh


#cleaning and finishing
echo "Cleaning Up" &&
sudo apt-get -f install &&
sudo apt-get autoremove &&
sudo apt-get -y autoclean &&
sudo apt-get -y clean
sudo apt-get upgrade -y
sudo reboot

