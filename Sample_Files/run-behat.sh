#!/bin/sh

##############################################################################
###    GLOBAL VARS
##############################################################################
CW_TEST_DIR = ../vendor/cw/cw_test
SERVERS_DIR = ../Servers
BEHAT_DIR = ../vendor/bin

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
   sh {$CW_TEST_DIR}/Servers/start_selenium_server.sh $SERVERS_DIR/selium.jar;
   if [ ! -z "$SCENARIO_NAME" ]
   then
      {$BEHAT_DIR}/behat -c behat.yml --tags=@$TAG -p $PROFILE --name="$SCENARIO_NAME"
   else
      {$BEHAT_DIR}/behat -c behat.yml --tags=@$TAG -p $PROFILE
   fi
fi

if [ $PROFILE = "phantomjs" ]
then
   sh {$CW_TEST_DIR}/Servers/start_phantomjs_webdriver.sh;
   {$BEHAT_DIR}/behat --tags=@$TAG -p $PROFILE
fi


##############################################################################
###    TEARDOWN
##############################################################################
#  Stop PhantomJS webdriver.
if [ $PROFILE = "phantomjs" ]
then
   sh {$CW_TEST_DIR}/Servers/stop_phantomjs_webdriver.sh
fi

#  Stop Selenium server.
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh {$CW_TEST_DIR}/Servers/stop_selenium_server.sh
fi


##############################################################################
###    BACKUP RESULT FILES
##############################################################################
mkdir -p ../Results/Behat/History
mv ../Results/Behat/*.html ../Results/Behat/History