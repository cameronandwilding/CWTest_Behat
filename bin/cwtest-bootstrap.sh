#!/bin/sh

# Make directories.
mkdir ./../Servers
mkdir ./../Results
mkdir ./../Results/Behat
mkdir ./../Results/Behat/screenshots

# Download selenium
wget http://selenium-release.storage.googleapis.com/2.49/selenium-server-standalone-2.49.1.jar -O ./../Servers/selenium.jar

# Copy over the sample files directory.
BIN_DIR="$(dirname $(readlink $BASH_SOURCE))"
cp -nR ${BIN_DIR}/../Sample_Files/* ./../
