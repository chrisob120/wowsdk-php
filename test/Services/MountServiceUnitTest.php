<?php

/**
 * Mount Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class MountServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\MountService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->mountService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetMounts() {
        $mounts = $this->_access->getMounts();
        $this->assertInstanceOf('\WowApi\Components\mounts\mount', $mounts[0]);
        $this->assertNotNull($mounts[0]->name);
    }

}