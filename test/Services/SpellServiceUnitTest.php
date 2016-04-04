<?php

/**
 * Spell Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class SpellServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\SpellService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->spellService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetSpell() {
        $spell = $this->_access->getSpell(8056);
        $this->assertInstanceOf('\WowApi\Components\Spells\Spell', $spell);
        $this->assertEquals(8056, $spell->id);
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testSpellNotFound() {
        $this->_access->getSpell(0);
    }

}