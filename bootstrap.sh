#!/bin/sh

# Scaffold out project structure.
BEHAT_DIR=./../../../Behat
SERVER_DIR=./../../../Servers
RESULTS_DIR=./../../../Results

mkdir ${BEHAT_DIR}
mkdir ${SERVER_DIR}
mkdir ${RESULTS_DIR}

# Copy the sample files over to the main directory.
cp -R Sample_Files/* ${BEHAT_DIR}

# Get Selenium Server.
wget http://selenium-release.storage.googleapis.com/2.49/selenium-server-standalone-2.49.1.jar -O ${SERVER_DIR}/selenium.jar

# Create screenshots directory.
cd ${RESULTS_DIR} && mkdir Behat && cd Behat && mkdir screenshots
