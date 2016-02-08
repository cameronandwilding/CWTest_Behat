#!/bin/bash

#  Stop Selenium Server
printf "\nStopping selenium server...\n"
cURL http://localhost:4444/selenium-server/driver/?cmd=shutDownSeleniumServer



