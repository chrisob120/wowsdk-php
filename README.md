# PHP SDK for Blizzard's WoW API
[![experimental](http://badges.github.io/stability-badges/dist/experimental.svg)](http://github.com/badges/stability-badges)

PHP WoW SDK is an SDK to interact the World of Warcraft API.

This library utilizes [GuzzlePHP](http://guzzle.readthedocs.org/) 

## Main Features

* ttt

## Requirements

* PHP >= 5.6
* cURL
* JSON

## Installing via Composer

[Composer](http://getcomposer.org) is a dependency management tool for PHP which will allow you to easily add WoW SDK to your project. Simply add "chrisob120/wowsdk-php" to your project's composer.json file.

```javascript
 {
        "require": {
            "chrisob120/wowsdk-php": "1.0.*"
        }
 }
```

## Basic Usage

The WowApi class contains the services that hold the methods which allow you to access the WoW API. Basic access is quite simple and only requires your mashery API key.

```php
use WowApi\WowApi;

$api = new WowApi('your mashery api key');
$api->bossService->getBoss(24723);
```
All optional parameters default to the US region with the 'en_US' locale. These options can be adjusted as shown below. [Here](https://dev.battle.net/docs/read/community_apis) is a list of different regions and locales provided by Blizzard.
```php
use WowApi\WowApi;

$options = [
    'region' => 'eu',
    'locale' => 'en_GB'
];

$api = new WowApi('your mashery api key', $options);
$api->bossService->getBoss(24723);
```

For more information, check out the [wiki](https://github.com/chrisob120/wowsdk-php/wiki) which includes:
* [Services](https://github.com/chrisob120/wowsdk-php/wiki)
* [Authentication](https://github.com/chrisob120/wowsdk-php/wiki)
* [Optional Parameters](https://github.com/chrisob120/wowsdk-php/wiki)
* [Examples](https://github.com/chrisob120/wowsdk-php/wiki)
* [Caching](https://github.com/chrisob120/wowsdk-php/wiki)
* [Testing](https://github.com/chrisob120/wowsdk-php/wiki)

## Todo

* Improve Services for Common Uses
