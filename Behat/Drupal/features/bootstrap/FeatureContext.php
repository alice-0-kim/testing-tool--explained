<?php

/**
 * @Note: This is a code snippet for header.feature, footer.feature, link.feature
 */

use Drupal\DrupalExtension\Context\DrupalContext, Drupal\DrupalExtension\Context\RawDrupalContext, Drupal\DrupalExtension\Event\EntityEvent, Drupal\Component\Utility\Random, Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext, Behat\Behat\Context\Step, Behat\Behat\Context\Step\Given, Behat\Gherkin\Node\PyStringNode, Behat\Gherkin\Node\TableNode, Behat\Behat\Tester\Exception\PendingException;

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
            echo "\n*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*";
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
     * @When I click the link :arg1
     */
    public function iClick($arg1)
    {
        echo "Before I click: " . $this->getSession()->getCurrentUrl();
        
        $this->getSession()->wait(5000);
        
        $page  = $this->getSession()->getPage();
        $links = $page->findAll('css', "a");
        
        echo "Originally 24, now it is: " . sizeof($links);
        
        $test_links = $page->findAll('css', "a[href^='http']");
        echo "size of test_links: " . sizeof($test_links);
        
        $index = $arg1;
        $link  = $links[$index];
        
        echo "\n" . $link->getText();
        
        $link->click();
        
        $current_url = $this->getSession()->getCurrentUrl();
        
        echo "\n" . "After I click: " . $current_url;
        
    }
    
    
    /**
     * @When I click the link that ends with :arg1
     */
    public function iClickTheLinkThatEndsWith($arg1)
    {
        
        echo "Before I click: " . $this->getSession()->getCurrentUrl();
        
        $this->getSession()->wait(5000);
        
        $page = $this->getSession()->getPage();
        
        $link = $page->find('css', "a[href$=" . $arg1 . "]");
        
        echo "\n" . $link->getText();
        
        $link->click();
        
        $current_url = $this->getSession()->getCurrentUrl();
        
        echo "\n" . "After I click: " . $current_url;
    }
    
    /**
     * @When I click the link in global footer that ends with :arg1
     */
    public function iClickTheLinkInGlobalFooterThatEndsWith($arg1)
    {
        
        echo "Before I click: " . $this->getSession()->getCurrentUrl();
        
        $this->getSession()->wait(5000);
        
        $page = $this->getSession()->getPage();
        
        $link = $page->find('css', "#ubc7-global-footer a[href$=" . $arg1 . "]");
        
        echo "\n" . $link->getText();
        
        $link->click();
        
        $current_url = $this->getSession()->getCurrentUrl();
        
        echo "\n" . "After I click: " . $current_url;
    }
    
    /**
     * @When I click the link in minimal footer that ends with :arg1
     */
    public function iClickTheLinkInMinimalFooterThatEndsWith($arg1)
    {
        
        echo "Before I click: " . $this->getSession()->getCurrentUrl();
        
        $this->getSession()->wait(5000);
        
        $page = $this->getSession()->getPage();
        
        $link = $page->find('css', "#ubc7-minimal-footer a[href$=" . $arg1 . "]");
        
        echo "\n" . $link->getText();
        
        $link->click();
        
        $current_url = $this->getSession()->getCurrentUrl();
        
        echo "\n" . "After I click: " . $current_url;
    }
    
}
