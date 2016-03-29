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

        // check default fields
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

        // check non default field as not set
        $this->assertFalse(isset($character->achievements), 'Field has been set when it should not be.');
    }

    public function testGetCharacterClass() {
        $charObj = $this->_access->getCharacterClasses()[0];
        $this->assertInstanceOf('\WowApi\Components\Characters\CharacterClass', $charObj);
    }

    public function testGetCharacterRace() {
        $charObj = $this->_access->getCharacterRaces()[0];
        $this->assertInstanceOf('\WowApi\Components\Characters\CharacterRace', $charObj);
    }

    public function testGetCharacterAchievement() {
        $charObj = $this->_access->getCharacterAchievements()[0];
        $this->assertInstanceOf('\WowApi\Components\Characters\CharacterAchievement', $charObj);
    }

    public function testGetCharacterWithAchievements() {
        $character = $this->_access->getCharacter('Hyjal', 'Ardeel', ['achievements']);
        $this->assertNotNull($character->achievements);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testCharacterNotFound() {
        $this->_access->getCharacter('FakeRealm', 'FakeChar');
    }

}