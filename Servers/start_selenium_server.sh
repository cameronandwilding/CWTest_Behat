#!/bin/bash

function checkAndStartSeleniumServer {
  if ! lsof -i:4444
  then
    printf "Port 4444 is free - starting selenium server...\n"
    runSeleniumServer
    sleep 4;
  else
    printf "Port 4444 is in use - selenium server already running.\n"
  fi
}

function runSeleniumServer {
  java -jar ../Servers/selenium.jar -port 4444 -trustAllSSLCertificates &
}

checkAndStartSeleniumServer

