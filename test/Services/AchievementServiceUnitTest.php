<?php

/**
 * Achievement Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class AchievementServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\AchievementService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->achievementService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetAchievement() {
        $achievement = $this->_access->getAchievement(150);
        $this->assertInstanceOf('\WowApi\Components\Achievements\Achievement', $achievement);

        // check the fields
        $this->assertNotNull($achievement->id);
        $this->assertNotNull($achievement->title);
        $this->assertNotNull($achievement->points);
        $this->assertNotNull($achievement->description);
        $this->assertNotNull($achievement->reward);
        $this->assertNotNull($achievement->rewardItems);
        $this->assertNotNull($achievement->icon);
        $this->assertNotNull($achievement->criteria);
        $this->assertNotNull($achievement->accountWide);
        $this->assertNotNull($achievement->factionId);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testAchievementNotFound() {
        $this->_access->getAchievement(1);
    }

}