SETUP & EXECUTION
=================


Get the framework
=================
Install the framework:

```
composer require cw_test/behat_framework
``` 
    
Behat configuration
===================
1. Run the bootstrap shell script:

```
cd vendor/cw_behat/framework
```

```
./bootstrap.sh
```

2. Inside `Behat/behat.local.yml`, update:

* the `base_url` to your local site url
* the `drupal_root` value to the path to your local drupal installation.
       

Optional Step
=============
This is only required if you want to run tests on Chrome. 
(By default, Firefox works out-of-the-box.)

1. Download chromedriver from `http://chromedriver.storage.googleapis.com/index.html?path=2.17/`
2. Save it to `/usr/local/bin`



Verify Setup Successful
=======================
Navigate to:

```
[LOCAL DRUPAL INSTALL FOLDER]/Behat
```

Execute the following:

```
./run-behat.sh login firefox
```

You should see `6 scenarios (6 passed)` in the terminal window after 15-20 seconds.

Test Execution
==============
Navigate to:

```
[LOCAL DRUPAL INSTALL FOLDER]/Behat
```

To execute the tests, select one of the following options based on the format `./run-behat.sh [tag] [profile]`:

```
./run-behat.sh regression firefox
```

or

```
./run-behat.sh regression chrome
```

Test Results
============
The results of all tests will be stored in `[LOCAL DRUPAL INSTALL FOLDER]/Results/Twig_***.html`

