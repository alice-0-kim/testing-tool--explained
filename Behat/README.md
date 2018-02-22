# Behat
Behat is a test framework for behavior-driven development written in the PHP programming language.

## Requirements
* __Composer__
* __PHP__ 5.3.5+
* __Selenium__ latest version

## Get Started
1. Create a new directory called __new-dir__. Note that this is __Demo__ directory in our demo.
2. Create __composer.json__ file. Copy and paste from [here](https://github.com/alice-0-kim/testing-tool-explained/edit/master/Behat/Demo/composer.json).
3. Run `composer install` from __new-dir__ directory.

## Directory Structure for a Simple Project Directory
Demo<br>
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
