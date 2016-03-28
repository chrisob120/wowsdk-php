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

        // check the a default field
        $this->assertNotNull($character->lastModified);
        // check an unassigned (should be null) field
        $this->assertNull($character->achievements);
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