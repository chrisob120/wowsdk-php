<?php

/**
 * Zone Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ZoneServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\ZoneService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->zoneService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetZone() {
        $zone = $this->_access->getZone(4131);
        $this->assertInstanceOf('\WowApi\Components\Zones\Zone', $zone);
        $this->assertInstanceOf('\WowApi\Components\Zones\ZoneLocation', $zone->location);

        if (count($zone->bosses)) {
            $this->assertInstanceOf('\WowApi\Components\Bosses\Boss', $zone->bosses[0]);
        }

        $this->assertEquals(4131, $zone->id);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testZoneNotFound() {
        $this->_access->getZone(0);
    }

}