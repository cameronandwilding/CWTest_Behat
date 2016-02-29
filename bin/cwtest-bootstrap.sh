#!/bin/sh

# Make directories.
mkdir ./../Servers
mkdir ./../Results
mkdir ./../Results/Behat
mkdir ./../Results/Behat/screenshots

# Download selenium
wget https://selenium-release.storage.googleapis.com/2.52/selenium-server-standalone-2.52.0.jar -O ./../Servers/selenium.jar

# Copy over the sample files directory.
BIN_DIR="$(dirname $(readlink $BASH_SOURCE))"
cp -nR ${BIN_DIR}/../Sample_Files/* ./../
cp -R ${BIN_DIR}/../README.md ./../
cp -R ${BIN_DIR}/../.gitignore ./../
cp ${BIN_DIR}/../Sample_Files/Behat/run-behat.sh ./../Behat