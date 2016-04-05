<?php

/**
 * User Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class UserServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\UserService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient(null, null, $token = 'good')->userService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetProfile() {
        $profile = $this->_access->getProfile();

        if (count($profile)) {
            $this->assertInstanceOf('\WowApi\Components\Characters\Character', $profile[0]);
        }
    }

    public function testGetAccountId() {
        $this->assertTrue(is_integer($this->_access->getUserAccountId()));
    }

    public function testGetBattletag() {
        $this->assertTrue(is_string($this->_access->getUserBattletag()));
    }

    public function testGetTokenInfo() {
        $tokenObj = $this->_access->getTokenInfo();
        $this->assertNotNull($tokenObj->exp);
    }

}