# PHP Unit Testing: PHPUnit
## Installation
### Using Composer
```
composer require phpunit/phpunit
```
and run `composer install` or `composer update`.

## To enable auto-load
Update composer.json file:
```json
"autoload": {
  "psr-4": {
    "App\\":"app"
  }
}
```
