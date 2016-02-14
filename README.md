#SETUP & EXECUTION 

1. Select a location for the framework
--------------------------------------
Create a folder, ideally in a Test folder in your project, outside your Drupal webroot.


2. Install via [Composer](https://getcomposer.org/)
---------------------------------------------------
Create a `composer.json` file in the test folder root.
```
{
  "require": {
    "cw/cw_test": "*"
  },
  "config": {
    "bin-dir": "bin/"
  },
  "autoload": {
    "psr-4": {
      "ProjectFiles\\": "src/"
    }
  }
}
```

3. Install the framework
------------------------
Run the bootstrap shell script:<br>
```
cd bin && ./cwtest-bootstrap.sh
```

### Update your local configuration

Inside `/Behat/behat.local.yml`, update:<br>
* the `base_url` to your local site url<br>
* the `drupal_root` value to the path to your local drupal installation.


### 3a. Optional Step
This is only required if you want to run tests on Chrome.<br>
(By default, Firefox works out-of-the-box.)

1. Download chromedriver from `http://chromedriver.storage.googleapis.com/index.html?path=2.17/`
2. Save it to `/usr/local/bin`


4. Verify Setup Successful
--------------------------
Navigate to:

```
/Behat
```

Execute the following:

```
./run-behat.sh setup firefox
```

You should see `1 scenarios (1 passed)` in the terminal window after 15-20 seconds.


Test Execution
==============
Navigate to:

```
/Behat
```

To execute all of the tests, select one of the following options based on the format `./run-behat.sh [tag] [profile]`:

```
./run-behat.sh regression firefox
```

or

```
./run-behat.sh regression chrome
```

Test Results
============
The results of all tests will be stored in `/Results/Behat/Twig_***.html`


BEHAT TEST WRITING PROCESS
==========================

It is a good idea to read through the LOGIN feature, page, and context files while reading through the following descriptions.<br>
In the following, XXXX is the name of the page being tested, e.g. Basic, Article, Login, etc.<br>
<b>"ACTION"</b> indicates a step that you have to do.

The basic process for writing any test would be:

<u>1. SCENARIOS</u><br>
Decide on a business scenario that you would like to automate. <br>
This often comes from a User Story or piece of functionality that you'd like to test.<br>
For the rest of the following, let's think of a login scenario where a user is going:<br>
 - open the login page<br>
 - enter a username and password.<br>
 - click the login button.<br>

<u>2. FEATURE file</u><br>
This file contains the high-level test scenarios written in a Gherkin syntax.<br>
These files are located in Behat/features/.<br>
They all follow the naming convention XXXX.feature.<br>
For example, in the `LoginPage.feature`, there are tests to ensure a valid login is successful.<br>

<b>ACTION:</b> Create a `.feature` file, using the template provided, and write your scenario into the `.feature` file.<br>
Follow the syntax used in other tests.<br>
Where possible, re-use existing sentences from the `.feature` file as these will already have been automated.<br>
If you are creating a new sentence, keep it short but descriptive.<br>
 * template - `/Sample_Files/Behat/features/LoginPage.feature`<br>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/1.gherkin.html">Gherkin</a><br>

<u>3. PAGE.php file</u><br>
This file contains the path, page objects, and getters/setters for all the fields on the page XXXX.<br>
These files are located in src/Util/.<br>
They all follow the naming convention XXXXPage.php.<br>
For example, in the `LoginPage.php`, there are the username, password, and login button objects detailed.<br>

<b>ACTION:</b> Create a `Page.php` file, and add the objects  to it.<br>
For Create/Edit/View content types, you generally want to add every object that an end-user would use to the `XXXXPage.php` file.<br>
Using the template provided, create your `XXXXPage.php` file. <br>
Take care to separate textfields, buttons, frames, etc, and follow the syntax and naming conventions from other PAGE files.<br>
Where possible, always use IDs for your objects. If IDs are not available, consider using name, data-drupal-selector, or xpath.<br>
 * template - `/Sample_Files/src/Util/ArticlePage.php`<br>

<u>4. CONTEXT.php file</u><br>
This file contains all of the functions that are specific to the XXXX page.<br>
These files are located in src/Context.<br>
They all follow the naming convention XXXXContext.php.<br>
For example, in the `LoginContext.php`, there are functions to fill in the username and password fields, and press the login button.<br>

<b>ACTION:</b> Create a `XXXXContext.php` file, and add the relevant functions to interact with the objects from the `Page.php` file.<br>
This file will detail function for interacting with your objects.<br>
The number of functions you write will vary from context to context - typically, the more complicated a UI is, the more functions will be required.<br>
Follow the syntax and naming conventions from other CONTEXT files.<br>
Keep all functions as short as possible, ideally doing one thing each, like filling in a text field.<br>
 * template - `/Sample_Files/src/Context/ArticleContext.php`<br>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/2.definitions.html">Step definitions</a><br>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/3.hooks.html">Hooks</a><br>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/4.contexts.html">Contexts</a><br>

<u>5. behat.yml file</u><br>
This file contains most of the configuration settings that are required for behat to run.<br>
Every new feature file that gets created will require that a new entry is made to this file.<br>

<b>ACTION:</b> Follow the example of the `login` from lines 3-15. Copy and paste this inside the `default` profile, and update the `login` values with the correct values.<br>
 * file - `/Behat/behat.yml`<br>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/5.suites.html">Suites</a><br>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/6.profiles.html">Profiles</a><br>

TAGS
====

@todo: Please add section detailing the tagging process.



TROUBLESHOOTING
===============
1. If you get API rate limit messages during the `./bootstrap.sh` step, please see:<br>
https://github.com/composer/composer/blob/master/doc/articles/troubleshooting.md#api-rate-limit-and-oauth-tokens

2. If you get the folowing when running the tests, please upgrade your version of java:<br>
`Exception in thread "main" java.lang.UnsupportedClassVersionError: org/openqa/grid/selenium/GridLauncher : Unsupported major.minor version 51.0`

3. If you get errors related to timezone settings, add the following to your path profile (with the appropriate version of PHP):<br>
`export PATH="/Applications/MAMP/bin/php/php5.6.7/bin:$PATH"`
