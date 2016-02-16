#!/bin/bash

function checkAndStartPhantomJS {
  if ! lsof -i:4445
  then
    echo Port 4445 is free
    printf "\nStarting phantomjs...\n"
    runPhantomJS
    sleep 4;
  else
    echo Port 4445 is in use
    printf "\nPhantomjs already running.\n"
  fi
}

function runPhantomJS {
  phantomjs --webdriver=4445 &
}

checkAndStartPhantomJS

