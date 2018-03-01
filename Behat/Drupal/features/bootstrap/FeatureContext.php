<?php

/**
 * @Note: This is a code snippet for testing Drupal 8 UBC CLF Theme 1.0.1
 */

use Drupal\DrupalExtension\Context\DrupalContext,
    Drupal\DrupalExtension\Context\RawDrupalContext,
    Drupal\DrupalExtension\Event\EntityEvent,
    Drupal\Component\Utility\Random;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Context\Step,
    Behat\Behat\Context\Step\Given,
    Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode,
    Behat\Behat\Tester\Exception\PendingException;

class FeatureContext extends RawDrupalContext
{
    protected $base_url = 'http://d8-demo.dd:8083';
    //    protected $base_url = 'http://drupal-8-4-4-clone.dd:8083';
    //    protected $base_url = 'https://www.facebook.com';
    
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
    /**
     * @Given I am on :arg1
     */
    public function iAmOn($arg1)
    {
        $this->getSession()->visit($this->base_url . $arg1);
        
        echo "The current URL: " . $this->getSession()->getCurrentUrl();
    }
    
    /**
     * @Then I should see the text :arg1 as the unit name
     */
    public function iShouldSeeTheTextAsTheUnitName($arg1)
    {
        $css_selector = "#ubc7-unit-identifier";
        
        $element = $this->getSession()->getPage()->find('css', $css_selector);
        
        if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getSession()->getCurrentUrl(), $css_selector));
        }
        $text = $element->getText();
        if ($text !== $arg1) {
            throw new \Exception(sprintf("The text '%s' does not match with the unit name '%s'", $text, $arg1));
        }
        
        echo sprintf("The text '%s' matches with the unit name '%s'", $text, $arg1);
    }
    
    /**
     * @When I click the unit name :arg1
     * @When I click the :arg1
     * @When I click the toggle search button :arg1
     * @When I click the button :arg1
     */
    public function iClickThe($arg1)
    {
        $css_selector = $arg1;
        echo "CSS selector: " . $css_selector;
        
        
        try {
            $element = $this->getSession()->getPage()->find('css', $css_selector);
            $element->click();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
    
    /**
     * @Then I should be on :arg1
     */
    public function iShouldBeOn($arg1)
    {
        if (strpos($arg1, "https://") !== false) {
            $ideal_url = $arg1;
        } else {
            $ideal_url = $this->base_url . $arg1;
        }
        
        $current_url = $this->getSession()->getCurrentUrl();
        
        if (strpos($current_url, $arg1) !== false) {
            echo "The current url: " . $current_url;
        } else {
            echo $arg1;
            throw new \Exception("Oh no, I am on " . $current_url);
        }
    }
    
    /**
     * @Given I fill in :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2)
    {
        $css_selector = $arg1;
        
        $element = $this->getSession()->getPage()->find('css', $css_selector);
        $element->setValue($arg2);
    }
    
    /**
     * @When I click :arg1
     */
    public function iClick($arg1)
    {
        echo "Before I click: " . $this->getSession()->getCurrentUrl();
        
        $links = $this->getSession()->getPage()->findAll('css', "a");
        $index = $arg1;
        $link  = $links[$index];
        
        echo "\n" . $link->getText();
        
        $link->click();
        
        $current_url = $this->getSession()->getCurrentUrl();
        
        echo "\n" . "After I click: " . $current_url;
    }
    
}
