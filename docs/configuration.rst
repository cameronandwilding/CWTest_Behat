Configuration
=============

behat.yml
---------

This file contains most of the configuration settings that are required for behat to run.

Every new feature file that gets created will require that a new entry is made to this file.

**ACTION:** Follow the example of the login from lines 3-15. Copy and paste this inside the default profile, and update the login values with the correct values.

   * file - /Behat/behat.yml
   * `Suites <http://docs.behat.org/en/v3.0/guides/5.suites.html>`_
   * `Profiles <http://docs.behat.org/en/v3.0/guides/6.profiles.html>`_

behat.local.yml
---------------

This is a mandatory file that contains the local configuration for the machine were the tests are running.