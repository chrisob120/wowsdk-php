<?php

/**
 * Realm Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class RealmServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\RealmService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->realmService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetRealm() {
        $realm = $this->_access->getRealm('Hyjal');
        $this->assertInstanceOf('\WowApi\Components\Realms\Realm', $realm);

        // check the fields
        $this->assertNotNull($realm->type);
        $this->assertNotNull($realm->population);
        $this->assertNotNull($realm->queue);
        $this->assertNotNull($realm->wintergrasp);
        $this->assertNotNull($realm->tol_barad);
        $this->assertNotNull($realm->status);
        $this->assertNotNull($realm->name);
        $this->assertNotNull($realm->slug);
        $this->assertNotNull($realm->battlegroup);
        $this->assertNotNull($realm->locale);
        $this->assertNotNull($realm->timezone);
        $this->assertNotNull($realm->connected_realms);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Realm Not Found
     */
    public function testRealmNotFound() {
        $this->_access->getRealm('FakeRealm');
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage The realms parameter must be an array with at least one value or null.
     */
    public function testRealmsMultipleEmpty() {
        $this->_access->getRealms([]);
    }

    /**
     * @expectedException \WowApi\Exceptions\IllegalArgumentException
     * @expectedExceptionMessage You may only choose the following sort keys
     */
    public function testSortRealmsKeyNotAllowed() {
        $this->_access->sortRealms('cat', 'dog');
    }

}