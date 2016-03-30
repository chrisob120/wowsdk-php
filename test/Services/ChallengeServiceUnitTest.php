<?php

/**
 * Boss Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ChallengeServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\ChallengeService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->challengeService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetChallenge() {
        $challenge = $this->_access->getLadder('Hyjal');
        $this->assertInstanceOf('\WowApi\Components\Challenges\Challenge', $challenge[0]);

        // check a field
        //$this->assertNotNull($boss->id);
    }

}