<?php
/**
 * @Note: updated in a daily basis to reflect changes/progress
 */
use Drupal\DrupalExtension\Context\DrupalContext,
    Drupal\DrupalExtension\Context\RawDrupalContext,
    Drupal\DrupalExtension\Event\EntityEvent,
    Drupal\Component\Utility\Random,
    Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\BehatContext,
    Behat\Behat\Context\Step,
    Behat\Behat\Context\Step\Given,
    Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode,
    Behat\Behat\Tester\Exception\PendingException;
class FeatureContext extends RawDrupalContext {
    protected $base_url = 'http://drupal-8-5-0.dd:8083';
    //    protected $base_url = 'https://www.ubc.ca'; //live website with UBC CLF theme
    //    protected $base_url = 'http://drupal-8-4-4-clone.dd:8083'; //Drupal 8 local website with UBC CLF theme
    //    protected $base_url = 'https://www.facebook.com'; //random website without UBC CLF theme
    
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
     * @Given I am on :arg1
     * @When I visit :arg1
     */
    public function iAmOn($arg1) {
        $this->getSession()->visit($this->base_url . $arg1);
        echo "The current URL: " . $this->getURL();
    }
    /**
     * @Then I should see the text :arg1 as the unit name
     */
    public function iShouldSeeTheTextAsTheUnitName($arg1) {
        $css_selector = "#ubc7-unit-identifier";
        $element = $this->findOnPage($css_selector);
        if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getURL(), $css_selector));
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
    public function iClickThe($arg1) {
        try {
            $element = $this->findOnPage($arg1);
            $element->click();
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    /**
     * @Then I should be on :arg1
     */
    public function iShouldBeOn($arg1) {
        if (strpos($arg1, "https://") !== false) {
            $ideal_url = $arg1;
        } else {
            $ideal_url = $this->base_url . $arg1;
        }
        $site_domain = explode('/', $this->base_url) [2];
        if (strpos($this->getURL(), $arg1) !== false) {
            echo "*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*";
        } else {
            echo $arg1;
            throw new \Exception("Oh no, I am on " . $this->getURL());
        }
    }
    /**
     * @Given I fill in :arg1 with :arg2
     * @When I select :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2) {
        $element = $this->findOnPage($arg1);
        $element->setValue($arg2);
    }
    /**
     * @When I click :arg1
     * @When I click the link :arg1
     */
    public function iClick($arg1) {
        echo "Before I click: " . $this->getURL();
        $links = $this->findAllOnPage("a");
        $index = $arg1;
        $link = $links[$index];
        echo "\n" . $link->getText();
        $link->click();
        echo "\n" . "After I click: " . $this->getURL();
    }
    /**
     * @When I click the link that ends with :arg1
     */
    public function iClickTheLinkThatEndsWith($arg1) {
        echo "Before I click: " . $this->getURL();
        $selector = "a[href$=" . $arg1 . "]";
        $link = $this->findOnPage($selector);
        echo "\n" . $link->getText();
        $link->click();
        echo "\n" . "After I click: " . $this->getURL();
    }
    /**
     * @When I click the link in global footer that ends with :arg1
     */
    public function iClickTheLinkInGlobalFooterThatEndsWith($arg1) {
        echo "Before I click: " . $this->getURL();
        $selector = "#ubc7-global-footer a[href$=" . $arg1 . "]";
        $link = $this->findOnPage($selector);
        echo "\n" . $link->getText();
        $link->click();
        echo "\n" . "After I click: " . $this->getURL();
    }
    /**
     * @When I click the link in minimal footer that ends with :arg1
     */
    public function iClickTheLinkInMinimalFooterThatEndsWith($arg1) {
        echo "Before I click: " . $this->getURL();
        $selector = "#ubc7-minimal-footer a[href$=" . $arg1 . "]";
        $link = $this->findOnPage($selector);
        echo "\n" . $link->getText();
        $link->click();
        echo "\n" . "After I click: " . $this->getURL();
    }
    /**
     * @When I click :arg1 on :arg2 region
     */
    public function iClickOnRegion($arg1, $arg2) {
        echo "Before I click: " . $this->getURL();
        $container = $this->findOnPage($arg2);
        $link = $container->find('css', "a:contains(" . $arg1 . ")");
        if (isset($link)) {
            $link->click();
        } else {
            throw new \Exception($link . "does not exist");
        }
        echo "\n" . "After I click: " . $this->getURL();
    }
    /**
     * @When I click the link that ends with :arg1 in the :arg2 region
     */
    public function iClickTheLinkThatEndsWithInTheRegion($arg1, $arg2) {
        echo "Before I click: " . $this->getURL();
        $selector = $arg2 . " a[href$=" . $arg1 . "]";
        $element = $this->findOnPage($selector);
        echo "\n" . $element->getText();
        $element->click();
        echo "\n" . "After I click: " . $this->getURL();
    }
    /**
     * @Then :arg1 should contain :arg2
     */
    public function shouldContain($arg1, $arg2) {
        $container = $this->findOnPage($arg1);
        $element = $container->find('css', "div:contains(" . $arg2 . ")");
        echo $element->getText();
        if (!isset($element)) {
            throw new \Exception("'%s' does not exist", $arg2);
        }
    }
    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        $element = $this->findOnPage($arg1);
        if (!isset($element)) {
        	throw new \Exception($arg1 . " is not visible!");
        }
        
        echo $arg1 . " is visible";
    }
    
    /**
     * @Then I should not see :arg1
     */
    public function iShouldNotSee($arg1)
    {
        $element = $this->findOnPage($arg1);
        if (isset($element)) {
        	throw new \Exception($arg1 . " is visible!");
        }
        
        echo $arg1 . " is not visible";
    }
    
    /**
     * @Then I should see :arg1 in :arg2 with a tag name :arg3:
     */
    public function iShouldSeeInWithATagName($arg1, $arg2, $arg3, TableNode $table) {
        $container = $this->findOnPage($arg2);
        foreach ($table as $row) {
            $text = $row[$arg1];
            $element = $container->find('css', $arg3 . ":contains(" . $text . ")");
            if (!isset($element)) {
                throw new \Exception($text . " does not exist");
            }
        }
    }
    /**
     * @Then I should see class name :arg1 in :arg2:
     */
    public function iShouldSeeClassNameIn($arg1, $arg2, TableNode $table) {
        $container = $this->findOnPage($arg2);
        foreach ($table as $row) {
            $class_name = $row[$arg1];
            $element = $container->find('css', $class_name);
            if (!isset($element)) {
                throw new \Exception($class_name . " does not exist");
            }
        }
    }
    /**
     * @Then I should see :arg1 with a tag name :arg2
     */
    public function iShouldSeeWithATagName($arg1, $arg2) {
        $element_s = $this->findAllOnPage($arg2);
        foreach ($element_s as $element) {
            $text = $element->getText();
            if (strcmp($arg1, $text) == 0) {
                echo $arg1 . " matches " . $text;
                return;
            }
        }
        throw new \Exception("Error: None of them matches!");
    }
    /**
     * @Then I should not see :arg1 with a tag name :arg2
     */
    public function iShouldNotSeeWithATagName($arg1, $arg2) {
        $element_s = $this->findAllOnPage($arg2);
        foreach ($element_s as $element) {
            $text = $element->getText();
            if (strcmp($arg1, $text) == 0) {
                throw new \Exception("Error: It matches!");
            }
        }
    }
    /**
     * @When I create :arg1 with the following:
     */
    public function iCreateWithTheFollowing($arg1, TableNode $table) {
        foreach ($table as $row) {
            $this->getSession()->visit($this->base_url . "/node/add/" . $arg1);
            $id = $row['id'];
            $value = $row['value'];
            $selector = "input[id='" . $id . "']";
            $element = $this->findOnPage($selector);
            $element->setValue($value);
            if (strpos($arg1, "ubc_announcement") !== false) {
                $category = $this->findOnPage("select[name=field_announcement_category]");
                $category->setValue("news");
            }
            $save = $this->findOnPage("input[value='Save']");
            $save->click();
        }
    }
    
    /**
     * @Then :arg1 should be enabled
     */
    public function shouldBeEnabled($arg1) {
    	$ubc_web_services = $this->findOnPage("#edit-modules-ubc-web-services");
    	$checkboxes = $ubc_web_services->findAll("css", "input");
    	foreach ($checkboxes as $checkbox) {
    		if (!$checkbox->getAttribute("checked")) {
    			throw new \Exception($checkbox->getAttribute("id") . " is not enabled");
    		}
    	}
    }
    
    /**
     * @Then I should see :arg1 with a role :arg2:
     */
    public function iShouldSeeWithARole($arg1, $arg2, TableNode $table) {
        foreach ($table as $row) {
            $tab = $row[$arg1];
            $element = $this->findOnPage("a:contains(" . $tab . ")");
            if (!isset($element)) {
                throw new \Exception($tab . " does not exist");
            }
            if (strpos($arg2, $element->getAttribute('role')) !== false) {
            } else {
                throw new \Exception($tab . "is not a tab");
            }
            echo $tab . " has a role: " . $arg2;
        }
    }
    /**
     * @Then :arg1 should contain the text :arg2
     */
    public function shouldContainTheText($arg1, $arg2) {
        $element = $this->findOnPage($arg1);
        if (!isset($element)) {
            throw new \Exception($arg1 . "does not exist in " . $this->getURL());
        }
        if (strcmp($arg2, $element->getText()) == 0) {
            echo $element->getText() . " == " . $arg2;
        } else {
            throw new \Exception($element->getText() . " != " . $arg2);
        }
    }
    /**
     * @Given UBC Search is open
     */
    public function ubcSearchIsOpen() {
        $element = $this->findOnPage("button:contains('UBC Search')");
        echo $element->getText();
        echo $element->click();
    }
    /**
     * @Then the current URL should contain search keyword :arg1
     */
    public function theCurrentUrlShouldContainSearchKeyword($arg1) {
        $current_url = $this->getURL();
        $encoded_keyword = urlencode($arg1);
        echo $encoded_keyword;
        if (strpos($current_url, $encoded_keyword)) {
            echo $current_url . " contains " . $arg1;
        } else {
            throw new \Exception($current_url . " does not contain " . $arg1);
        }
    }    
    /**
     * @Then I should be able to check navigation mode
     */
    public function iShouldBeAbleToCheckNavigationMode()
    {
        $selected = $this->findOnPage("#edit-clf-navigation-placement")->getAttribute("value");
        
        echo $selected . " is selected\n";
        
        $this->iAmOn('/');
        switch($selected) {
        	case 'default':
        		$this->iShouldSee('#ubc7-unit-menu');
        		$height = $this->findOnPage('#ubc7-unit-menu')->getAttribute('height');
        		echo $height;
        		break;
        	case 'double':
        		$this->iShouldSee('#ubc7-unit-menu');
        		break;
        	case 'higher':
        		$this->iShouldSee('#ubc7-unit-menu');
        		$height = $this->findOnPage('#ubc7-unit-menu')->getAttribute('height');
        		echo $height;
        		break;
        	case 'slidein':
        		//$target = $this->findOnPage('#ubc7-unit-menu');
        		//echo $target->getAttribute('display');
        		//if (strcmp($target->getAttribute('display'), 'none') != 0) {
        		//	throw new \Exception('#ubc7-unit-menu is visible!');
        		//}
        		$this->iShouldSeeWithATagName('Menu ☰','button');
        		break;
        	default:
        		throw new \Exception($selected . ' is not applicable!');
        }
    }
    
    /**
     * Example: When I attach the file "flower_1200x600.jpg" to "#edit-field-landing-feature-image-0-upload"
     *
     * @When I attach the file :arg1 to :arg2
     */
    public function iAttachTheFileTo($arg1, $arg2)
    {
    	$element = $this->findOnPage($arg2);
    	$path = $this->getMinkParameter('files_path').DIRECTORY_SEPARATOR. $arg1;
		$element->attachFile($path);
    }
    
    // ##################################################################################
    // ##################################################################################

    /**
     * Returns the element on page with :selector
     */
    private function findOnPage($selector) {
        $this->getSession()->wait(5000);
        $page = $this->getSession()->getPage();
        $element = $page->find('css', $selector);
        return $element;
    }
    /**
     * Returns all elements on page with :selector
     */
    private function findAllOnPage($selector) {
        $this->getSession()->wait(5000);
        $page = $this->getSession()->getPage();
        $element = $page->findAll('css', $selector);
        return $element;
    }
    /**
     * Returns a current URL
     */
    private function getURL() {
        return $this->getSession()->getCurrentUrl();
    }
}