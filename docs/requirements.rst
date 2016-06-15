System Requirements
===================

Required
--------

#. Check your PHP version::

    php --version

   It must be higher than 5.3.5

   PHP will also need to have the following libraries installed:

   * `curl <http://curl.haxx.se/libcurl/php/install.html>`_
   * `mbstring <http://php.net/manual/en/mbstring.installation.php>`_
   * `xml <http://www.php.net/manual/en/dom.setup.php#102046>`_

   These dependency comes from `Behat Drupal Extension <http://behat-drupal-extension.readthedocs.io/en/latest/requirements.html>`_ requirements.

2. Check for Java::

    java -version

   It must be 1.7+. It will be required for Selenium.

Optional
--------

`Download chromedriver <http://chromedriver.storage.googleapis.com/index.html?path=2.17/>`_ in case you want
integration with this browser.