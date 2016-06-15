Initial setup
=============

#. Create the Behat folder structure.

   Run the bootstrap shell script:

    cd bin && ./cwtest-bootstrap.sh
    cd ..

#. Update your local configuration

   In your Test folder, edit Behat/behat.local.yml.

   Update:
   the base_url to your local site url
   the drupal_root value to the path to your local drupal installation.

#. Configure Chrome - Optional Step

   This is only required if you want to run tests on Chrome. Skip if you don't.

   (By default, Firefox works out-of-the-box.)

   Download chromedriver from http://chromedriver.storage.googleapis.com/index.html?path=2.17/
   Save it to /usr/local/bin

#. Verify Setup Successful

   Navigate to the Behat folder inside your Test folder:

    cd Behat

   Execute the following:

    ./run-behat.sh setup firefox

   Selenium will launch and run a test. You should see 1 scenarios (1 passed) in the terminal window after 15-20 seconds.

# Running tests

   To run tests, execute the following:

    ./run-behat.sh {tag} {profile}