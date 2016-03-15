#GUIDE

|Link|What do you want to do?|
|-----|----------|
|[Initial Set-up](#initial-set-up)|If you are the first person on the project to install this framework, please complete the initial set-up steps|
|[Onbording to a project](#onboarding-to-a-project)|If the framework is already part of your project repo, please complete the onboarding steps|
|[Ongoing Update](#ongoing-update)|If you are only updating the framework, please complete the ongoing update steps|
|[Test Execution](#test-execution)|How to run tests?|
|[Test Results](#test-results)|Where to find the test results?|
|[Behat test writing process](#behat-test-writing-process)|How to write new tests?|


##INITIAL SET-UP

1. Select a location for the framework
--------------------------------------
Create a folder, ideally in a Test folder in your project, outside your Drupal webroot.


2. Create a composer JSON file [Composer](https://getcomposer.org/)
---------------------------------------------------
Create a `composer.json` file in the test folder root.
```
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
```

3. Install via [Composer](https://getcomposer.org/)
---------------------------------------------------
From the Test folder created st step 1, run:

```
composer install
```

4. Create the Behat folder structure
------------------------------------
Run the bootstrap shell script:

```
cd bin && ./cwtest-bootstrap.sh
cd ..
```

5. Update your local configuration
------------------------------------
In your Test folder, edit `Behat/behat.local.yml`. Update:

* the `base_url` to your local site url
* the `drupal_root` value to the path to your local drupal installation.


6. Configure Chrome - Optional Step
-----------------------------------
This is only required if you want to run tests on Chrome. Skip to step 7 if you don't.

(By default, Firefox works out-of-the-box.)

1. Download chromedriver from `http://chromedriver.storage.googleapis.com/index.html?path=2.17/`
2. Save it to `/usr/local/bin`


7. Verify Setup Successful
--------------------------
Navigate to the Behat folder inside your Test folder:

```
cd Behat
```

Execute the following:

```
./run-behat.sh setup firefox
```

Selenium will launch and run a test. You should see `1 scenarios (1 passed)` in the terminal window after 15-20 seconds.


##ONBOARDING TO A PROJECT

1. Install via [Composer](https://getcomposer.org/)
---------------------------------------------------
From the project Test folder, run:

```
composer install
```

2. Create the Behat folder structure
------------------------------------
Run the bootstrap shell script:

```
cd bin && ./cwtest-bootstrap.sh
cd ..
```

3. Update your local configuration
------------------------------------
In your Test folder, edit `Behat/behat.local.yml`. Update:

* the `base_url` to your local site url
* the `drupal_root` value to the path to your local drupal installation.


4. Configure Chrome - Optional Step
-----------------------------------
This is only required if you want to run tests on Chrome. Skip to step 7 if you don't.

(By default, Firefox works out-of-the-box.)

1. Download chromedriver from `http://chromedriver.storage.googleapis.com/index.html?path=2.17/`
2. Save it to `/usr/local/bin`


5. Verify Setup Successful
--------------------------
Navigate to the Behat folder inside your Test folder:

```
cd Behat
```

Execute the following:

```
./run-behat.sh setup firefox
```

Selenium will launch and run a test. You should see `1 scenarios (1 passed)` in the terminal window after 15-20 seconds.


##ONGOING UPDATE

1. Update via [Composer](https://getcomposer.org/)
---------------------------------------------------
From the project Test folder, run:

```
composer update
```

2. Update the Behat folder structure
------------------------------------
Run the bootstrap shell script:

```
cd bin && ./cwtest-bootstrap.sh
cd ..
```


##Test Execution

Navigate to the Behat folder inside your Test folder:

```
cd Behat
```

To execute all of the tests, select one of the following options based on the format `./run-behat.sh [tag] [profile]`:

```
./run-behat.sh regression firefox
```

or

```
./run-behat.sh regression chrome
```

##Test Results

The results of all tests will be stored in `/Results/Behat/Twig_***.html`


##Behat test writing process

It is a good idea to read through the LOGIN feature, page, and context files while reading through the following descriptions.

In the following, XXXX is the name of the page being tested, e.g. Basic, Article, Login, etc.

<b>"ACTION"</b> indicates a step that you have to do.

The basic process for writing any test would be:

<u>1. SCENARIOS</u>

Decide on a business scenario that you would like to automate.

This often comes from a User Story or piece of functionality that you'd like to test.

For the rest of the following, let's think of a login scenario where a user is going:

 - open the login page
 - enter a username and password.
 - click the login button.

<u>2. FEATURE file</u>

This file contains the high-level test scenarios written in a Gherkin syntax.

These files are located in Behat/features/.

They all follow the naming convention XXXX.feature.

For example, in the `LoginPage.feature`, there are tests to ensure a valid login is successful.


<b>ACTION:</b> Create a `.feature` file, using the template provided, and write your scenario into the `.feature` file.

Follow the syntax used in other tests.

Where possible, re-use existing sentences from the `.feature` file as these will already have been automated.

If you are creating a new sentence, keep it short but descriptive.

 * template - `/Sample_Files/Behat/features/LoginPage.feature`
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/1.gherkin.html">Gherkin</a>

<u>3. PAGE.php file</u>

This file contains the path, page objects, and getters/setters for all the fields on the page XXXX.

These files are located in src/Util/.

They all follow the naming convention XXXXPage.php.

For example, in the `LoginPage.php`, there are the username, password, and login button objects detailed.

<b>ACTION:</b> Create a `Page.php` file, and add the objects  to it.

For Create/Edit/View content types, you generally want to add every object that an end-user would use to the `XXXXPage.php` file.

Using the template provided, create your `XXXXPage.php` file. 

Take care to separate textfields, buttons, frames, etc, and follow the syntax and naming conventions from other PAGE files.

Where possible, always use IDs for your objects. If IDs are not available, consider using name, data-drupal-selector, or xpath.

 * template - `/Sample_Files/src/Util/ArticlePage.php`

<u>4. CONTEXT.php file</u>

This file contains all of the functions that are specific to the XXXX page.

These files are located in src/Context.

They all follow the naming convention XXXXContext.php.

For example, in the `LoginContext.php`, there are functions to fill in the username and password fields, and press the login button.


<b>ACTION:</b> Create a `XXXXContext.php` file, and add the relevant functions to interact with the objects from the `Page.php` file.

This file will detail function for interacting with your objects.

The number of functions you write will vary from context to context - typically, the more complicated a UI is, the more functions will be required.

Follow the syntax and naming conventions from other CONTEXT files.

Keep all functions as short as possible, ideally doing one thing each, like filling in a text field.

 * template - `/Sample_Files/src/Context/ArticleContext.php`
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/2.definitions.html">Step definitions</a>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/3.hooks.html">Hooks</a>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/4.contexts.html">Contexts</a>

<u>5. behat.yml file</u>

This file contains most of the configuration settings that are required for behat to run.

Every new feature file that gets created will require that a new entry is made to this file.

<b>ACTION:</b> Follow the example of the `login` from lines 3-15. Copy and paste this inside the `default` profile, and update the `login` values with the correct values.

 * file - `/Behat/behat.yml`
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/5.suites.html">Suites</a>
 * reference - <a href="http://docs.behat.org/en/v3.0/guides/6.profiles.html">Profiles</a>

TAGS
====

@todo: Please add section detailing the tagging process.



TROUBLESHOOTING
===============
1. If you get API rate limit messages during the `./bootstrap.sh` step, please see:

https://github.com/composer/composer/blob/master/doc/articles/troubleshooting.md#api-rate-limit-and-oauth-tokens

2. If you get the folowing when running the tests, please upgrade your version of java:

`Exception in thread "main" java.lang.UnsupportedClassVersionError: org/openqa/grid/selenium/GridLauncher : Unsupported major.minor version 51.0`

3. If you get errors related to timezone settings, add the following to your path profile (with the appropriate version of PHP):

`export PATH="/Applications/MAMP/bin/php/php5.6.7/bin:$PATH"`
