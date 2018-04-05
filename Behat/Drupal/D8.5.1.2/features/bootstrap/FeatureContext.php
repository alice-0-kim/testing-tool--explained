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
	
  /**
  * @Then current url is :page
  */
  public function currentUrlIs($page)
  {
    $this->addressEquals($this->locatePath($page));
  }
  
  /**
  * @return true if the given address matches with the current url
  *         false, otherwise
  */
  private function addressEquals($page)
  {
    $expected = $page;
    $actual = $this->getSession()->getCurrentUrl();
    $this
      ->assert(strpos($actual,$expected) !== false, sprintf('Current page is "%s", but "%s" expected.', $actual, $expected));
  }
  
  /**
  * @throw Exception when the condition is not met
  */
  private function assert($condition, $message) {
    if ($condition) {
      return;
    }
    throw new \Exception($message);
  }
  
  /**
  * @When I wait for :arg1
  */
  public function iWaitFor($arg1)
  {
    $this->getSession()->wait($arg1);
  }
}