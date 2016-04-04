<?php

/**
 * Item Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\ItemService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->itemService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetItem() {
        $item = $this->_access->getItem(71033);
        $this->assertInstanceOf('\WowApi\Components\Items\Item', $item);
        $this->assertInstanceOf('\WowApi\Components\Items\ItemSource', $item->itemSource);
        $this->assertInstanceOf('\WowApi\Components\Items\ItemSource', $item->itemSource);
        $this->assertInstanceOf('\WowApi\Components\Items\BonusSummary', $item->bonusSummary);

        if (count($item->itemSpells)) {
            $this->assertInstanceOf('\WowApi\Components\Items\ItemSpell', $item->itemSpells[0]);
            $this->assertInstanceOf('\WowApi\Components\Spells\Spell', $item->itemSpells[0]->spell);
        }

        $this->assertEquals(71033, $item->id);
    }

    public function testGetItemSet() {
        $itemSet = $this->_access->getItemSet(1060);
        $this->assertInstanceOf('\WowApi\Components\Items\ItemSet', $itemSet);

        if (count($itemSet->items)) {
            $this->assertInstanceOf('\WowApi\Components\Items\Item', $itemSet->items[0]);
        }

        $this->assertEquals(1060, $itemSet->id);
    }

    public function testGetItemClasses() {
        $itemClasses = $this->_access->getItemClasses();
        $this->assertInstanceOf('\WowApi\Components\Items\ItemClass', $itemClasses[0]);

        if (count($itemClasses[0]->subclasses)) {
            $this->assertInstanceOf('\WowApi\Components\Items\ItemSubClass', $itemClasses[0]->subclasses[0]);
        }
    }

    /**
     * @expectedException \WowApi\Exceptions\WowApiException
     * @expectedExceptionMessage Not Found
     */
    public function testItemNotFound() {
        $this->_access->getItem(0);
    }

}