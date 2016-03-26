<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use WowApi\Util\Helper;

/**
 * Character Unit Tests
 *
 * @author		Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class CharacterServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\CharacterService $access
     */
    private $_access;


    /**
     * @var Client $_client
     */
    private $_client;


    protected function setUp() {
        $this->_access = Auth::getClient()->characterService;
        $this->_client = new Client();
    }

    protected function tearDown() {
        $this->_access = null;
    }


    public function testGetCharacter() {
        $character = $this->_access->getCharacter('Hyjal', 'Ardeel');
        $this->assertInstanceOf('\WowApi\Components\Character', $character);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     */
    public function testCharacterNotFound() {
        $t = $this->_access->getCharacter('FakeRealm', 'FakeChar');
        Helper::print_rci($t);
    }

}