#!/bin/sh

##############################################################################
###    BACKUP PREVIOUS RESULT FILES
##############################################################################
mkdir -p ../Results/History
mv ../Results/*.html ../Results/History


##############################################################################
###    GLOBAL VARS
##############################################################################
COMPOSER_BIN=../bin

##############################################################################
###    ASSIGN SCRIPT VARIABLES
##############################################################################
TAG=$1
PROFILE=$2
SCENARIO_NAME=$3


##############################################################################
###    HELP OPTION
##############################################################################
if [ "$1" == "-h" ]; then
  printf 'Usage:    ./run-behat.sh [tag] [profile]\n\n'
  printf 'To execute all tests on firefox:\n    ./run-behat.sh regression firefox\n'
  printf '\nTo execute all tests on chrome:\n   ./run-behat.sh regression chrome\n'
  printf '\nTo execute a specific named test:\n   ./run-behat.sh regression firefox \"name_of_test\"\n'
  exit 0
fi


##############################################################################
###    SHELL SCRIPT MUST ALWAYS BE PASSED THE TAG AND PROFILE VARIABLES
##############################################################################
if [ -z $PROFILE ] || [ -z $TAG ]
then
   printf 'ERROR: Expected Tag followed by Profile.\nE.g. ./run-behat.sh [tag] [profile]\n'
   exit 0
fi


##############################################################################
###    TEST EXECUTION
##############################################################################
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh $COMPOSER_BIN/start_selenium_server.sh;
   if [ ! -z "$SCENARIO_NAME" ]
   then
      $COMPOSER_BIN/behat -c behat.yml --tags=@$TAG -p $PROFILE --name="$SCENARIO_NAME"
   else
      $COMPOSER_BIN/behat -c behat.yml --tags=@$TAG -p $PROFILE
   fi
fi

if [ $PROFILE = "phantomjs" ]
then
   sh $COMPOSER_BIN/start_phantomjs_webdriver.sh;
   $COMPOSER_BIN/behat --tags=@$TAG -p $PROFILE
fi


##############################################################################
###    TEARDOWN
##############################################################################
#  Stop PhantomJS webdriver.
if [ $PROFILE = "phantomjs" ]
then
   sh $COMPOSER_BIN/stop_phantomjs_webdriver.sh
fi

#  Stop Selenium server.
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh $COMPOSER_BIN/stop_selenium_server.sh
fi
