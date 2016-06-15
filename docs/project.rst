Adding it to an existing project
================================

To add the tool to an existing project follow the next steps
------------------------------------------------------------

#. Select a location for the framework

   Create a folder, ideally in a Test folder in your project, outside your Drupal webroot.

#. Create a composer JSON file Composer

   Create a composer.json file in the test folder root.

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

#. Follow the installation instructions:
   :ref:`installation`