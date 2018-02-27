# features/bootstrap/FeatureContext.php
<?php
/**
 * @Note: This is for demo.feature
 */
use Behat\Behat\Context\Context,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

class FeatureContext implements Context
{
    private $output;

    /** @Given /^I am in a directory "([^"]*)"$/ */
    public function iAmInADirectory($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        chdir($dir);
    }

    /** @Given /^I have a file named "([^"]*)"$/ */
    public function iHaveAFileNamed($file)
    {
        touch($file);
    }

    /** @When /^I run "([^"]*)"$/ */
    public function iRun($command)
    {
        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /** @Then /^I should get:$/ */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string) $string !== $this->output) {
            throw new Exception("Actual output is:\n" . $this->output);
        }
    }
}


//=========================================================================================================================================


<?php

/**
 * @Note: This is a code snippet for irenebae.feature
 */
	 
use Drupal\DrupalExtension\Context\DrupalContext,
	Drupal\DrupalExtension\Context\RawDrupalContext,
    Drupal\DrupalExtension\Event\EntityEvent,
    Drupal\Component\Utility\Random;
    
use Behat\Behat\Context\BehatContext,
    Behat\Behat\Context\Step,
    Behat\Behat\Context\Step\Given,
    Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

class FeatureContext extends RawDrupalContext {

    protected $base_url = 'http://drupal-8-4-4-clone.dd:8083/';
	
	public function __construct() {
    	// Initiliaze subcontexts.
    	// $this->useContext('OgContext', new OgContext($parameters));
  	}

    /**
     * @Given /^I am at:$/
     *
     */
    public function iAmAt($arg1)
    {
        echo "I want to be at.. " . $arg1;
        $this->getSession()->visit($this->base_url . $arg1);
        $url = $this->getSession()->getCurrentUrl();
        $parsed_url = parse_url($url);
        
		// echo implode(" ", array_keys($parsed_url));
		
        $path = trim($parsed_url['path'], '/');
        
        echo "\nNow I am at.. " . $path;
        
        return $path;
    }

    /**
     * @Then /^I should see:$/
     *
     */
    public function iShouldSee($arg1)
    {
        echo "I should see.. " . $arg1 . "\n";
        
        $this->iAmAt("node/3");
        $css_selector = ".field--name-title";
        
        $element = $this->getSession()->getPage()->find("css", $css_selector);
        
        if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getSession()->getCurrentUrl(), $css_selector));
        }
        
        $text = $element->getText();
        echo "\nNow I see.. " . $text;
        
        if (strpos($text, $arg1) !== false) {
        	echo "\nIt matches!!!";
        } else {
        	throw new \Exception(sprintf("The text '%s' does not contain the text '%s' in the page '%s'", $text, $arg1, $this->getSession()->getCurrentUrl()));
        }
    }

    /**
     * @Then /^I should not see:$/
     * @Then I should not see the node title :arg1
     *
     */
    public function iShouldNotSee($arg1)
    {
        echo "I should not see.. " . $arg1;
        
        $css_selector = ".field--name-title";
        
        $element = $this->getSession()->getPage()->find("css", $css_selector);
        
        if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getSession()->getCurrentUrl(), $css_selector));
        }
        
        $text = $element->getText();
        echo "\nNow I see.. " . $text;
        
        if (strpos($text, $arg1) !== false) {
        	throw new \Exception(sprintf("The text '%s' contains the text '%s' in the page '%s'", $text, $arg1, $this->getSession()->getCurrentUrl()));
        } else {
        	echo "\nIt is no where to be seen!!!";
        }        
    }
    
    /**
     * @Given I am on the homepage
     */
    public function iAmOnTheHomepage()
    {
    	//$base_url = 'http://drupal-8-4-4-clone.dd:8083';
        if($this->getSession()->getCurrentUrl() !== $this->base_url) {
        	$this->getSession()->visit($this->base_url);
        }
    }
    
	/**
     * @Given I am logged in as a user with the :role
     */
    public function iAmLoggedInAsAUserWithThe($role)
    {
        $this->getSession()->visit($this->base_url);
        if (!$this->loggedInWithRole($role)) {
            // Create user (and project)
            $user = (object) array(
            'name' => $this->getRandom()->name(8),
            'pass' => $this->getRandom()->name(16),
            'role' => $role,
            );
            $user->mail = "{$user->name}@example.com";
            $this->userCreate($user);
            $roles = explode(',', $role);
            $roles = array_map('trim', $roles);
            foreach ($roles as $role) {
                if (!in_array(strtolower($role), array('authenticated', 'authenticated user'))) {
                    // Only add roles other than 'authenticated user'.
                    $this->getDriver()->userAddRole($user, $role);
                }
            }
            // Login.
            $this->login($user);
        }
    }

    /**
     * @When I visit :arg1
     */
    public function iVisit($arg1)
    {
        echo "I am going to visit " . $arg1;

        $this->getSession()->visit($this->base_url . $arg1);

        echo "\nNow I am at " . $this->getSession()->getCurrentUrl();
    }

    /**
     * @Then I should see the node title :arg1
     *
     * @AfteriVisit
     */
    public function iShouldSeeTheNodeTitle($arg1)
    {
        echo "I should see the node title " . $arg1;
        
        //$this->iVisit("node/4");
        $css_selector = ".field--name-title";
        
        $element = $this->getSession()->getPage()->find("css", $css_selector);
        
        if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getSession()->getCurrentUrl(), $css_selector));
        }
        
        $text = $element->getText();
        echo "\nNow I see.. " . $text;
        
        if (strpos($text, $arg1) !== false) {
        	echo "\nIt matches!!!";
        } else {
        	throw new \Exception(sprintf("The text '%s' does not contain the text '%s' in the page '%s'", $text, $arg1, $this->getSession()->getCurrentUrl()));
        }        
    }

    /**
     * @Then I should not find the node title
     *
     * @AfteriShouldNotSeeTheNodeTitle
     */
    public function iShouldNotFindTheNodeTitle()
    {
        echo "I should not find the node title ";
        
        $css_selector = ".field--name-title";
        try
        {
    		$element = $this->getSession()->getPage()->find("css", $css_selector);
    		throw new \Exception(sprintf("Oh no, I see it..."));
        }
        catch (Exception $e)
        {
        	echo "I don't see the node title. Succeed!";
        	
        }

    }

    /**
     * @Then I should see the page title :arg1
     */
    public function iShouldSeeThePageTitle($arg1)
    {
        echo "I should see the page title " . $arg1;
        
        $css_selector = ".page-title";
   		$element = $this->getSession()->getPage()->find("css", $css_selector);
   		
   		if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getSession()->getCurrentUrl(), $css_selector));
        }
        
        $text = $element->getText();
        echo "\nNow I see.. " . $text;
        
        if (strpos($text, $arg1) !== false) {
        	echo "\nIt matches!!!";
        } else {
        	throw new \Exception(sprintf("The text '%s' does not contain the text '%s' in the page '%s'", $text, $arg1, $this->getSession()->getCurrentUrl()));
        } 
        
    }
    
}
