#!/bin/bash -e

function checkAndStartPhantomJS {
  if ! </dev/tcp/localhost/4445
  then
    echo Port 4445 is free
    printf "\nStarting phantomjs...\n"
    runPhantomJS
    return $?
  else
    echo Port 4445 is in use
    printf "\nPhantomjs already running.\n"
    return 0
  fi
}

function runPhantomJS {
  phantomjs --webdriver=4445 &
  local err_code=$?
  sleep 4
  return $err_code
}

checkAndStartPhantomJS
