#!/bin/bash -e

##############################################################################
###    GLOBAL VARS
##############################################################################
CWD="$(cd -P -- "$(dirname -- "$0")" && pwd -P)"
COMPOSER_BIN="$CWD"/../bin

##############################################################################
###    BACKUP PREVIOUS RESULT FILES
##############################################################################
mkdir -p "$CWD"/../Results/History
ls "$CWD"/../Results/*.html && mv "$CWD"/../Results/*.html "$CWD"/../Results/History

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
   exit 1
fi

##############################################################################
###    TEST EXECUTION
##############################################################################
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   if ! . "$COMPOSER_BIN"/start_selenium_server.sh
   then
     printf 'ERROR: Failed to run Selenium server!\n'
     exit 1
   fi
   if [ ! -z "$SCENARIO_NAME" ]
   then
      "$COMPOSER_BIN"/behat -c "$CWD"/behat.yml --tags=@$TAG -p $PROFILE --name="$SCENARIO_NAME" ${@:4}
   else
      "$COMPOSER_BIN"/behat -c "$CWD"/behat.yml --tags=@$TAG -p $PROFILE ${@:4}
   fi
fi

if [ $PROFILE = "phantomjs" ]
then
   if ! . "$COMPOSER_BIN"/start_phantomjs_webdriver.sh; then
     printf 'ERROR: Failed to run PhantomJS web driver!\n'
     exit 1
   fi
   "$COMPOSER_BIN"/behat --tags=@$TAG -p $PROFILE ${@:4}
fi

##############################################################################
###    TEARDOWN
##############################################################################
#  Stop PhantomJS webdriver.
if [ $PROFILE = "phantomjs" ]
then
   . "$COMPOSER_BIN"/stop_phantomjs_webdriver.sh
fi

#  Stop Selenium server.
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   . "$COMPOSER_BIN"/stop_selenium_server.sh
fi
