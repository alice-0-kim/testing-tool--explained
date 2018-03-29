<?php

use Drupal\Component\Utility\Random;
use Drupal\DrupalExtension\Context\DrupalContext;
use Drupal\DrupalExtension\Context\RawDrupalContext;
use Drupal\DrupalExtension\Event\EntityEvent;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Step\Given;
use Behat\Behat\Context\TranslatableContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Element\Element;
//use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext, TranslatableContext {

	protected $screenshot_dir = '/tmp';

	/**
	* Initializes context.
	*
	* Every scenario gets its own context instance.
	* You can also pass arbitrary arguments to the
	* context constructor through behat.yml.
	*/
	public function __construct($parameters) {
		if (isset($parameters['screenshot_dir'])) {
			$this->screenshot_dir = $parameters['screenshot_dir'];
		}
	}
	/**
	* Returns list of definition translation resources paths.
	*
	* @return array
	*/
	public static function getTranslationResources()
	{
		return glob(__DIR__ . '/../../../../i18n/*.xliff');
	}
//////////////////////////////////////////////////////////////////////////////////////////
	/**
	* @Then :arg1 is visible that says :arg2
	*/
	public function isVisibleThatSays($arg1, $arg2)
	{
		$element = $this->findOnPage($arg1);
		if (!isset($element)) throw new \Exception($arg1 ." is not visible!");
		if (strcmp($element->getText(), $arg2) === false) throw new \Exception($arg1 ." != ". $arg2);
	}
	/**
	* @Then :arg1 is not visible
	*/
    public function isNotVisible($arg1)
    {
		$element = $this->findOnPage($arg1);
		if (isset($element)) throw new \Exception($arg1 ." is visible!");
    }
	/**
	* @Then :arg1 are visible that say :arg2:
	*/
    public function areVisibleThatSay($arg1, $arg2, TableNode $table)
    {
        foreach ($table as $row) {
        	$sel = $row[$arg1];
        	$val = $row[$arg2];
        	$element = $this->findOnPage($sel);
			if (!isset($element)) throw new \Exception($sel ." is not visible!");
			if (strcmp($element->getAttribute('value'), $val) === false) throw new \Exception($sel ." != ". $val);
			echo "..." . explode("-", $sel)[sizeof(explode("-", $sel)) - 1] ." == ". $val . "\n";
        }
    }
//////////////////////////////////////////////////////////////////////////////////////////
	/**
	* @Then I execute JavaScript
	*/
    public function iExecuteJavascript()
    {
        $this->getSession()->executeScript("document.getElementsByClassName('dropbutton-action').className = 'dropbutton-action' ");
        $this->getSession()->wait(5000);
        $this->getSession()->resizeWindow(500, 500);
        $this->getSession()->resizeWindow(2560, 1200);
    }
	/**
	* @Then I set value :arg1 to :arg2
	*
	* Example: Then I set value ".image-widget-data input" to "/Users/alicekim/Sites/devdesktop/D8.5.0.2/flower_600x400.jpg"
	* Caution: Path needs to be absolute
	*/
    public function iSetValueTo($arg1, $arg2)
    {
        echo '/////////////';
        $element = $this->findOnpage($arg1);
        echo $element->getAttribute('value');
        $element->setValue($arg2);
        echo $element->getAttribute('value');
        echo '/////////////';
    }
	/**
	* @When I set value :arg1 for :arg2
	*/
    public function iSetValueFor($arg1, $arg2)
    {
        throw new PendingException();
    }
	/**
	* @Then I should not be on :arg1
	*/
    public function iShouldNotBeOn($arg1)
    {
        throw new PendingException();
    }
	/**
	* Set a waiting time in seconds
	*
	* @Given /^I wait for "([^"]*)" seconds$/
	*/
	public function iWaitForSeconds($arg1) {
		$this->getSession()->wait($arg1);
	}
	/**
	* @When I attach :path to :field
	*/
	public function iAttachTo($path, $field) {
		$element = $this->findOnPage($field);
		if (!isset($element)) {
			throw new \Exception($field . " not found!");
		}
		$element->attachFile($path);
	}
//////////////////////////////////////////////////////////////////////////////////////////
	/**
	* Take screenshot when step fails. Works only with Selenium2Driver.
	* Screenshot is saved at [Date]/[Feature]/[Scenario]/[Step].jpg
	*  @AfterStep
	*/
	public function after(Behat\Behat\Hook\Scope\AfterStepScope $scope) {
		if ($scope->getTestResult()->getResultCode() === 99) {
			$driver = $this->getSession()->getDriver();
			if ($driver instanceof Behat\Mink\Driver\Selenium2Driver) {
				$fileName = date('Y-m-d \a\t h.i.s') . '.png';
				$this->saveScreenshot($fileName, $this->screenshot_dir);
				print 'Screenshot at: '.$this->screenshot_dir.'/' . $fileName;
			}
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////
	/**
	* Example: $this->findOnPage('tag')
	*          $this->findOnPage('#id')
	*          $this->findOnPage('.class')
	*/
	private function findOnPage($selector)
	{
		$this->getSession()->wait(5000);
        $page = $this->getSession()->getPage();
        $element = $page->find('css', $selector);
        return $element;
	}
}
