#!/bin/bash -e
CWD="$(cd -P -- "$(dirname -- "$0")" && pwd -P)"
SELENIUM_PATH="${SELENIUM_PATH:-$(find "$CWD/.." -name selenium.jar -print -quit)}"

function checkAndStartSeleniumServer {
  if ! </dev/tcp/localhost/4444
  then
    printf "Port 4444 is free - starting Selenium server...\n"
    runSeleniumServer
    return $?
  else
    printf "Port 4444 is in use - Selenium server is already running.\n"
    return 0
  fi
}

function runSeleniumServer {
  if type selenium-server; then
    selenium-server &
  elif [ "$SELENIUM_PATH" ] && [ -f "$SELENIUM_PATH" ]; then
    java -jar "$SELENIUM_PATH" -port 4444 -trustAllSSLCertificates &
  else
    printf "Selenium JAR not found, please run manually or specify its path by SELENIUM_PATH!\n"
    false
  fi
  local err_code=$?
  sleep 4
  return $err_code
}

checkAndStartSeleniumServer
