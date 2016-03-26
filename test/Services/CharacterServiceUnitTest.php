<?php

use WowApi\WowApi;
use GuzzleHttp\Client;

/**
 * Character Unit Tests
 *
 * @author		Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class CharacterServiceUnitTest extends PHPUnit_Framework_TestCase {

    private static $client;

    public function setUp() {
        self::$client = new Client();
    }

}