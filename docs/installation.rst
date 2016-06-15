Installation
============

These are the steps to install the tool from different sources.

Install via Composer
--------------------

.. _installation:

#. Select a location for the framework

   Create a folder, ideally in a Test folder in your project, outside your Drupal webroot.

#. Create a composer JSON file Composer

   Create a composer.json file in the test folder root::

    {
      "require": {
        "cw/behat_test": "*"
      },
      "config": {
        "bin-dir": "bin/"
      },
      "autoload": {
        "psr-4": {
          "CWTest\\": "src/"
        }
      }
    }

#. From the Test folder created st step 1, run::

    composer install

Install via Github
------------------

#. Select a location for the framework and clone it::

    git clone https://github.com/cameronandwilding/CWTest_Behat --branch={8.x|7.x} {folder}