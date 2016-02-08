#!/bin/sh

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
###    SYNC Project_Files PRIOR TO EXECUTION
##############################################################################
rsync ../Project_Files/behat.yml features/..
rsync ../Project_Files/contexts/*.php features/bootstrap
rsync -a ../Project_Files/features/* features/
rsync -a ../Project_Files/images ../Behat
rsync -a ../Project_Files/pages ../Behat


##############################################################################
###    TEST EXECUTION
##############################################################################
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh ../Servers/start_selenium_server.sh;
   if [ ! -z "$SCENARIO_NAME" ]
   then
      bin/behat -c behat.ym --tags=@$TAG -p $PROFILE --name="$SCENARIO_NAME"
   else
      bin/behat -c behat.yml --tags=@$TAG -p $PROFILE
   fi
fi

if [ $PROFILE = "phantomjs" ]
then
   sh ../Servers/start_phantomjs_webdriver.sh;
   bin/behat --tags=@$TAG -p $PROFILE
fi


##############################################################################
###    TEARDOWN
##############################################################################
# Remove YML config
rm behat.yml

# Remove all feature subdirectories except bootstrap.
find ./features -type d -not -name bootstrap -not -name features -exec rm -R {} \;

# Remove 'pages'
rm -R pages

# Remove 'images'
rm -R images

# Remove all files in 'bootstrap' except HelperContext.php
cd features/bootstrap
ls * | grep -v HelperContext.php | xargs rm -rf
cd ../..

#  Stop PhantomJS webdriver.
if [ $PROFILE = "phantomjs" ]
then
   sh ../Servers/stop_phantomjs_webdriver.sh
fi

#  Stop Selenium server.
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh ../Servers/stop_selenium_server.sh
fi


##############################################################################
###    BACKUP RESULT FILES
##############################################################################
mkdir -p ../Results/Behat/History
mv ../Results/Behat/*.html ../Results/Behat/History