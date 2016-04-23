# PHP SDK for Blizzard's WoW API
[![experimental](http://badges.github.io/stability-badges/dist/experimental.svg)](http://github.com/badges/stability-badges)

Overview

**Note:** This library utilizes [GuzzlePHP](http://guzzle.readthedocs.org/) 

## Main features

ToDo

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

To

```php
<?php
use WowApi\WowApi;
use WowApi\Exceptions\WowApiException;

$api = new WowApi('your mashery api key');
$api->bossService->getBoss(24723);
```
