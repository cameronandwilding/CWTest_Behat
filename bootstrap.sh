#!/bin/sh

#  Get Selenium Server.
wget http://selenium-release.storage.googleapis.com/2.48/selenium-server-standalone-2.48.2.jar -O Servers/selenium.jar

#  Install Behat via Composer.
export COMPOSER_HOME="./"
composer install -d Behat
rm -rf Behat/.htaccess

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