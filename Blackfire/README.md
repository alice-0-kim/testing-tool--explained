# <span id="top">Testing Drupal 8 website using Blackfire.io</span>
> For more information about Blackfire.io, please visit [here](https://blackfire.io/docs/introduction).

## Blackfire PHP SDK
For more information about the installation process, visit [here](https://blackfire.io/docs/reference-guide/php-sdk).

## Integration with PHPUnit
```php
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Blackfire\Profile;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    use TestCaseTrait;

    /**
     * @group blackfire
     * @requires extension blackfire
     */
    public function testSomething()
    {
        $config = new Profile\Configuration();

        // define some assertions
        $config
            ->assert('metrics.sql.queries.count < 5', 'SQL queries')
            ->assert('metrics.twig.render.count < 3', 'Rendered Twig templates')
            ->assert('metrics.twig.compile.count == 0', 'Twig compilation')
            // ...
        ;

        $profile = $this->assertBlackfire($config, function () {
            // do something that you want to profile
            // and assertions are going to be executed against it
        });
    }
}
```
Source: https://blackfire.io/docs/integrations/phpunit

## Sample .blackfire.yml file
For more information about .blackfire.yml file, visit [here](https://blackfire.io/docs/cookbooks/tests).

Blackfire.io provides their own [.blackfire.yml validator](https://blackfire.io/docs/validator).

Back to [Top](#top)
