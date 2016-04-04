<?php

/**
 * Quest Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class QuestServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\QuestService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->questService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetQuest() {
        $quest = $this->_access->getQuest(13146);
        $this->assertInstanceOf('\WowApi\Components\Quests\Quest', $quest);
        $this->assertEquals(13146, $quest->id);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testQuestNotFound() {
        $this->_access->getQuest(0);
    }

}