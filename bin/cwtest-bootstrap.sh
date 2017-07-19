#!/bin/bash -e
CWD="$(cd -P -- "$(dirname -- "$0")" && pwd -P)"

# Make directories.
mkdir -vp "$CWD"/../Servers "$CWD"/../Results/screenshots

# Download selenium
SELENIUM_URL="https://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.1.jar"
SELENIUM_DESTINATION="${CWD}/../Servers/selenium.jar"
if type wget -v >/dev/null 2>&1; then
  wget -nc ${SELENIUM_URL} -O ${SELENIUM_DESTINATION}
elif type curl -V >/dev/null 2>&1; then
  curl ${SELENIUM_URL} -O ${SELENIUM_DESTINATION}
else
  echo "Unable to download Selenium. Please download it from ${SELENIUM_URL} and place it in ${SELENIUM_DESTINATION}"
fi

# Copy over the sample files directory.
SAMPLE_DIR=$(find "${CWD}"/.. -type d -name "Sample_Files" -print -quit)
if [ -d "$SAMPLE_DIR" ]; then
  cp -vnR "${SAMPLE_DIR}"/* "${CWD}"/../
  cp -vn "${SAMPLE_DIR}"/../*.md "${SAMPLE_DIR}"/../.git* "${CWD}"/../
  cp -vn "${SAMPLE_DIR}"/Behat/*.sh "${CWD}"/../Behat/
fi
