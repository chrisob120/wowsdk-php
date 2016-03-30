<?php

/**
 * Boss Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class BossServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\BossService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->bossService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetBoss() {
        $boss = $this->_access->getBoss(24723);
        $this->assertInstanceOf('\WowApi\Components\Bosses\Boss', $boss);
        $this->assertInstanceOf('\WowApi\Components\Bosses\NPC', $boss->npcs[0]);

        // check a field
        $this->assertNotNull($boss->id);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testBossNotFound() {
        $this->_access->getBoss(0);
    }

}