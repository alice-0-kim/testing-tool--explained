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

<?php
/**
 * @Note: This is for irenebae.feature
 */
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\TranslatableContext;
use Behat\Mink\Element\Element;

use Behat\Gherkin\Node\TableNode;

class FeatureContext extends \Drupal\DrupalExtension\Context\DrupalContext
{
    /**
     * @Given I am at :arg1
     *
     * @override
     */
    public function iAmAt($arg1)
    {
        echo "I want to be at.. " . $arg1;
        $this->getSession()->visit('http://drupal-8-4-4-clone.dd:8083/' . $arg1);
        $url = $this->getSession()->getCurrentUrl();
        $parsed_url = parse_url($url);
        
		// echo implode(" ", array_keys($parsed_url));
		
        $path = trim($parsed_url['path'], '/');
        
        echo "\nNow I am at.. " . $path;
        
        return $path;
    }

    /**
     * @Then I should see :arg1
     *
     * @override
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
     * @Then I should not see :arg1
     *
     * @override
     */
    public function iShouldNotSee($arg1)
    {
        echo "I should not see.. " . $arg1;
        
        $this->iAmAt("node/3");
        $css_selector = ".field--name-title";
        
        $element = $this->getSession()->getPage()->find("css", $css_selector);
        
        if (empty($element)) {
            throw new \Exception(sprintf("The page '%s' does not contain the css selector '%s'", $this->getSession()->getCurrentUrl(), $css_selector));
        }
        
        $text = $element->getText();
        echo "\nNow I see.. " . $text;
        
        if (strpos($text, $arg1) === false) {
        	echo "\nIt is no where to be seen!!!";
        } else {
        	throw new \Exception(sprintf("The text '%s' does not contain the text '%s' in the page '%s'", $text, $arg1, $this->getSession()->getCurrentUrl()));
        }        
    }
}
