# Behat
Behat is a test framework for behavior-driven development written in the PHP programming language.

## Requirements
* __Composer__
* __PHP__ 5.3.5+
* __Selenium__ latest version

## Get Started
1. Create a new directory called __new-dir__. Note that this is __Demo__ directory in our demo.
2. Create __composer.json__ file. Copy and paste from [here](https://github.com/alice-0-kim/testing-tool-explained/blob/master/Behat/Demo/composer.json).
3. Run `composer install` from __new-dir__ directory.
4. Run `bin/behat --init`. This will create a features/ directory.
5. Run `bin/behat -dl` to make sure everything has been configured. The output should look similar to:
```
$ bin/behat -dl
default | Given I am an anonymous user
default | Given I am not logged in
default | Given I am logged in as a user with the :role role(s)
```

## Directory Structure for a Simple Project Directory
___Demo___<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- __behat.yml__<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- bin<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- __composer.json__<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- composer.lock<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'-- __features__<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- bootstrap<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'-- __FeatureContext.php__<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'-- __demo.feature__<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'-- vendor<br>

## To Run Test from Terminal
Run __bin/behat__ from the root(__Demo__ directory in our demo).
It will look smiliar to:

![screenshot](screenshot001.png)

## Example output for irenebae.feature file

### When the test fails:
![screenshot](screenshot003.png)

### When the test succeeds:
![screenshot](screenshot004.png)

### UPDATE: test run with multiple scenarios
![screenshot](screenshot005.png)

![screenshot](test.gif)

## Drush/Drupal API Driver
* use to add users, reset passwords, and log in to websites
### Set up
  Locate to the local project directory and run:
```
drush sa
```
  Grab one alias to use in your behat.yml:
```
Drupal\DrupalExtension:
  blackbox: ~
  api_driver: 'drush' 
  drush:
    root: YOUR_PROJECT_ROOT
    alias: 'YOUR_ALIAS'
  region_map:
    footer: "#footer"
```
  Then in your .feature file, add @api tag:
```
@api
  Scenario: Check that Administrator has access to ...
```
  Run using `bin/behat` to make sure no error is being thrown

## Using Selenium2 and ChromeDriver
### Selenium installation
1. Download __Selenium Standalone Server__ from [here](https://www.seleniumhq.org/download/). As of today, the current download version is 3.9.1.<br> The file name should be similar to this:__selenium-server-standalone-3.9.1.jar__. Replace the version number if necessary.
2. Download __ChromeDriver__ from [here](https://chromedriver.storage.googleapis.com/index.html?path=2.35/). Click one of the links depending on your local environment.
3. Once you have the ZIP file downloaded on your machine, unzip it and move it to __/usr/local/bin__ directory, or run:
```
mv PATH-TO-CHROMEDRIVER/chromedriver /usr/local/bin
```
4. Edit behat.yml file.&#42; &#42;&#42;
5. Edit composer.json file.&#42;
6. Run `composer update`. This will take a while.
7. Add @javascript tag in .feature files.
```
Feature: Check link functionality of website
  In order to ...
  As an administrator
  I want to be able to ...

  @javascript
  Scenario: Should be redirected to homepage when I click home
    Given I am on "/"
    ...
```
8. Run below line to start Selenium Server.
```
java -jar ~/Downloads/selenium-server-standalone-3.9.1.jar -port 4444
```
9. Open up a new terminal to run `bin/behat`. You should see that Google Chrome web browser is launched whenever any scenarios with @javascript tag attached.

&#42; The example behat.yml and composer.json files are located in /Drupal.<br>
&#42;&#42; __wd_host__ in behat.yml file should be adjusted based on the output when you start the Selenium Server. The output can be found in the similar format as:
```
09:21:55.237 INFO - Selenium Grid hub is up and running
09:21:55.237 INFO - Nodes should register to http://128.189.64.164:4444/grid/register/
09:21:55.237 INFO - Clients should connect to http://128.189.64.164:4444/wd/hub
```
