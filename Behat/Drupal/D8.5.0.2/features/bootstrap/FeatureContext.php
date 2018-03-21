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
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext, TranslatableContext {

	/**
	* Initializes context.
	*
	* Every scenario gets its own context instance.
	* You can also pass arbitrary arguments to the
	* context constructor through behat.yml.
	*/
	public function __construct() {
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
	/**
	* @Then :arg1 is visible that says :arg2
	*/
	public function isVisibleThatSays($arg1, $arg2)
	{
		$element = $this->findOnPage($arg1);
		if (!isset($element)) throw new \Exception($arg1 ." is not visible!");
		if (strcmp($element->getText(), $arg2) === false) throw new \Exception($arg1 ." != ". $arg2);
		echo $arg1 ." == ". $arg2;
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
	/**
	* @When I click :arg1
	*/
    public function iClick($arg1)
    {
        $this->findOnPage($arg1)->click();
    }
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
