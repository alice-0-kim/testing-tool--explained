# <span id="top">Testing Drupal 8 website using Blackfire</span>
> For more information about Blackfire, please visit [here](https://blackfire.io/docs/introduction).

__Blackfire Profiler__ is a tool that instruments PHP applications to gather data about consumed server resources like memory, CPU time, and I/O operations.

It can be used at any step of your application's lifecycle. The available features in __Blackfire__ are:
* Assertions
* Performance tests
* Test scenarios
* Integration with current development tools<br>
    - Platform.sh
    - PHPUnit
* Periodically test scenarios
* Notifications

## Profiling HTTP Requests
Blackfire's main use case is to profile HTTP requests like web pages, web service calls, or API calls

### Profiling Simple HTTP Requests
The easiest way to profile an HTTP request: use `curl` sub-command. It accepts the same arguments and options as the regular `curl`:
```
$ blackfire curl http://example.com/
```
To get more accurate results:
```
// take several samples of the request
$ blackfire --samples 10 curl http://example.com/
```

### JSON Output
```
$ blackfire --json curl http://example.com/
```

### Profiling Part of an HTTP Call
[PHP SDK](#phpsdk) allows users to focus on the profiling on only part of the code.

For more information on this section [->](https://blackfire.io/docs/cookbooks/profiling-http)
<hr>

## Profiling CLI Commands
### Profiling Simple CLF Scripts
```
// example.php
<?php
    echo "Hello, world!";
?>
```
In the same directory as your PHP file resides:
```
$ blackfire run php example.php
```
The output should look similar to:

## Integration with Platform.sh
> Detailed steps are provided [here](https://docs.platform.sh/administration/integrations/blackfire.html)<br>
> Platform.sh documentation is [here](https://github.com/ubc-web-services/platformsh-documentation)

## Integration with PHPUnit
The Blackfire PHP SDK provides a simple and powerful integration with PHPUnit.

### <div id="phpsdk">Blackfire PHP SDK</div>
> For more information about the installation process, visit [here](https://blackfire.io/docs/reference-guide/php-sdk).
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
## JSON representation of a profile
To export Blackfire results in JSON, use `--json` option:
```
blackfire --json run php testrun.php
```
The sample JSON output looks like:
```json
{
   "id":"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
   "label":"",
   "created_at":"2018-04-03T18:42:38+0000",
   "updated_at":"2018-04-03T18:42:38+0000",
   "status":{
      "name":"finished",
      "code":64,
      "failure_reason":null,
      "updated_at":"2018-04-03T18:42:38+0000"
   },
   "arguments":null,
   "layers":null,
   "report":null,
   "recommendations":null,
   "store":[

   ],
   "_links":{
      "self":{
         "href":"https:\/\/blackfire.io\/api\/v1\/profiles\/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
      },
      "graph_url":{
         "href":"https:\/\/blackfire.io\/profiles\/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx\/graph"
      },
      "store":{
         "href":"https:\/\/blackfire.io\/api\/v1\/profiles\/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx\/store"
      },
      "promote_reference":{
         "href":"https:\/\/blackfire.io\/api\/v1\/profiles\/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx\/promote-reference"
      }
   },
   "envelope":{
      "ct":1,
      "wt":507.6,
      "mu":2536,
      "pmu":41091.200000000004,
      "nw_in":0,
      "nw_out":0
   }
}
```
Back to [Top](#top)
