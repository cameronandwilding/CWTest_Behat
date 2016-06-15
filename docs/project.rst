Adding it to an existing project
================================

To add the tool to an existing project follow the next steps
------------------------------------------------------------

#. Select a location for the framework

   Create a folder, ideally in a Test folder in your project, outside your Drupal webroot.

#. Add the following to the componser.json file of the project::

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

#. Follow the :doc:`/installation` instructions.