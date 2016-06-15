Writing tests
=============

It is a good idea to read through the LOGIN feature, page, and context files while reading through the following descriptions.

In the following, XXXX is the name of the page being tested, e.g. Basic, Article, Login, etc.

"ACTION" indicates a step that you have to do.

The basic process for writing any test would be:

Scenarios
---------

   Decide on a business scenario that you would like to automate.

   This often comes from a User Story or piece of functionality that you'd like to test.

   For the rest of the following, let's think of a login scenario where a user is going:

   #. open the login page.
   #. enter a username and password.
   #. click the login button.

Features
--------

   This file contains the high-level test scenarios written in a Gherkin syntax.

   These files are located in Behat/features/.

   They all follow the naming convention XXXX.feature.

   For example, in the LoginPage.feature, there are tests to ensure a valid login is successful.

   **ACTION:** Create a .feature file, using the template provided, and write your scenario into the .feature file.

   Follow the syntax used in other tests.

   Where possible, re-use existing sentences from the .feature file as these will already have been automated.

   If you are creating a new sentence, keep it short but descriptive.

   * template - /Sample_Files/Behat/features/LoginPage.feature
   * `Gherkin <http://docs.behat.org/en/v3.0/guides/1.gherkin.html>`_

Page.php
--------

   This file contains the path, page objects, and getters/setters for all the fields on the page XXXX.

   These files are located in src/Util/.

   They all follow the naming convention XXXXPage.php.

   For example, in the LoginPage.php, there are the username, password, and login button objects detailed.

   **ACTION:** Create a Page.php file, and add the objects to it.

   For Create/Edit/View content types, you generally want to add every object that an end-user would use to the XXXXPage.php file.

   Using the template provided, create your XXXXPage.php file.

   Take care to separate textfields, buttons, frames, etc, and follow the syntax and naming conventions from other PAGE files.

   Where possible, always use IDs for your objects. If IDs are not available, consider using name, data-drupal-selector, or xpath.

   * template - /Sample_Files/src/Util/ArticlePage.php

Context.php
-----------

   This file contains all of the functions that are specific to the XXXX page.

   These files are located in src/Context.

   They all follow the naming convention XXXXContext.php.

   For example, in the LoginContext.php, there are functions to fill in the username and password fields, and press the login button.

   **ACTION:** Create a XXXXContext.php file, and add the relevant functions to interact with the objects from the Page.php file.

   This file will detail function for interacting with your objects.

   The number of functions you write will vary from context to context - typically, the more complicated a UI is, the more functions will be required.

   Follow the syntax and naming conventions from other CONTEXT files.

   Keep all functions as short as possible, ideally doing one thing each, like filling in a text field.

   * template - /Sample_Files/src/Context/ArticleContext.php
   * `Step definitions <http://docs.behat.org/en/v3.0/guides/2.definitions.html>`_
   * `Hooks <http://docs.behat.org/en/v3.0/guides/3.hooks.html>`_
   * `Contexts <http://docs.behat.org/en/v3.0/guides/4.contexts.html>`_

