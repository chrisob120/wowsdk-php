<?php

/**
 * Character Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class CharacterServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\CharacterService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->characterService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetCharacter() {
        $character = $this->_access->getCharacter('Hyjal', 'Ardeel');
        $this->assertInstanceOf('\WowApi\Components\Characters\Character', $character);

        // check default field
        $this->assertNotNull($character->lastModified);
        // check non default field as not set
        $this->assertFalse(isset($character->achievements), 'Field has been set when it should be unset.');
    }

    public function testGetCharacterWithAchievements() {
        $character = $this->_access->getCharacter('Hyjal', 'Ardeel', ['achievements']);
        $this->assertNotNull($character->achievements, 'Achievements is null.');
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testCharacterNotFound() {
        $this->_access->getCharacter('FakeRealm', 'FakeChar');
    }

}