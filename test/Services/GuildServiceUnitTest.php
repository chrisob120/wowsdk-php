<?php

/**
 * Guild Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class GuildServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\GuildService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->guildService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetGuild() {
        $guild = $this->_access->getGuild('Hyjal', 'TF');
        $this->assertInstanceOf('\WowApi\Components\Guilds\Guild', $guild);
        $this->assertInstanceOf('\WowApi\Components\Guilds\GuildEmblem', $guild->emblem);
        $this->assertEquals('Hyjal', $guild->realm);
        $this->assertEquals('TF', $guild->name);

        // check non default field as not set
        $this->assertFalse(isset($guild->members), 'Field has been set when it should not be.');
    }

    public function testGetGuildRewards() {
        $guildObj = $this->_access->getGuildRewards()[0];
        $this->assertInstanceOf('\WowApi\Components\Guilds\GuildReward', $guildObj);
    }

    public function testGetGuildPerks() {
        $guildObj = $this->_access->getGuildPerks()[0];
        $this->assertInstanceOf('\WowApi\Components\Guilds\GuildPerk', $guildObj);
    }

    public function testGetGuildAchievements() {
        $guildObj = $this->_access->getGuildAchievements()[0];
        $this->assertInstanceOf('\WowApi\Components\Guilds\GuildAchievement', $guildObj);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testGuildNotFound() {
        $this->_access->getGuild('Hyjal', 'FakeGuild');
    }

}