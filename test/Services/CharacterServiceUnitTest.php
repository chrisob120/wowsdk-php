<?php

/**
 * Character Unit Tests
 *
 * @author		Chris O'Brien <chris@diobie.com>
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
        $this->assertInstanceOf('\WowApi\Components\Character', $character);

        // check the default fields
        $this->assertNotNull($character->lastModified);
        $this->assertNotNull($character->name);
        $this->assertNotNull($character->realm);
        $this->assertNotNull($character->battlegroup);
        $this->assertNotNull($character->class);
        $this->assertNotNull($character->race);
        $this->assertNotNull($character->gender);
        $this->assertNotNull($character->level);
        $this->assertNotNull($character->achievementPoints);
        $this->assertNotNull($character->thumbnail);
        $this->assertNotNull($character->calcClass);
        $this->assertNotNull($character->faction);
        $this->assertNotNull($character->totalHonorableKills);
    }

    public function testGetCharacterWithAchievements() {
        $character = $this->_access->getCharacter('Hyjal', 'Ardeel', ['achievements']);
        $this->assertNotNull($character->achievements, 'Achievements is null.');
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     */
    public function testCharacterNotFound() {
        $this->_access->getCharacter('FakeRealm', 'FakeChar');
    }

}