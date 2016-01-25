#!/bin/sh

#  Get Selenium Server.
wget http://selenium-release.storage.googleapis.com/2.49/selenium-server-standalone-2.49.1.jar -O Servers/selenium.jar


#  Create a local behat configuration file.
cat > Behat/behat.local.yml << EOF
default:
  extensions:
    Behat\MinkExtension:
      base_url: http://
    Drupal\DrupalExtension:
      drupal:
        drupal_root: /Applications/MAMP/htdocs/
EOF


#  Rename the 'Sample_Files' directory so that does not get updated by composer update.
mv Sample_Files Project_Files