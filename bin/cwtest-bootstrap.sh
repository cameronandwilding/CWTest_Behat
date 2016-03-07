#!/bin/sh

# Make directories.
mkdir ./../Servers
mkdir ./../Results
mkdir ./../Results/Behat
mkdir ./../Results/Behat/screenshots

# Download selenium
SELENIUM_URL="https://selenium-release.storage.googleapis.com/2.52/selenium-server-standalone-2.52.0.jar"
SELENIUM_DESTINATION="./../Servers/selenium.jar"
if type wget -v >/dev/null 2>&1; then
  wget ${SELENIUM_URL} -O ${SELENIUM_DESTINATION}
elif type curl -V >/dev/null 2>&1; then
  curl ${SELENIUM_URL} -O ${SELENIUM_DESTINATION}
else
  echo "Unable to download Selenium. Please download it from ${SELENIUM_URL} and place it in ${SELENIUM_DESTINATION}"
fi

# Copy over the sample files directory.
BIN_DIR="$(dirname $(readlink $BASH_SOURCE))"
cp -nR ${BIN_DIR}/../Sample_Files/* ./../
cp -R ${BIN_DIR}/../README.md ./../
cp -R ${BIN_DIR}/../.gitignore ./../
cp ${BIN_DIR}/../Sample_Files/Behat/run-behat.sh ./../Behat