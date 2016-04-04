<?php

/**
 * Auction Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class AuctionServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\AuctionService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->auctionService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetAuction() {
        $auction = $this->_access->getAuction('Hyjal');
        $this->assertInstanceOf('\WowApi\Components\Auctions\Auction', $auction);
    }

}