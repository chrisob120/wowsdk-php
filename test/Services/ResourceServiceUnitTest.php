<?php

/**
 * Resource Unit Tests
 *
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ResourceServiceUnitTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \WowApi\Services\ResourceService $_access
     */
    private $_access;

    protected function setUp() {
        $this->_access = API::getClient()->resourceService;
    }

    protected function tearDown() {
        $this->_access = null;
    }

    public function testGetBattlegroup() {
        $battlegroups = $this->_access->getBattlegroups();
        $this->assertInstanceOf('\WowApi\Components\Resources\Battlegroup', $battlegroups[0]);
        $this->assertNotNull($battlegroups[0]->name);
    }

    public function testGetTalentTree() {
        $talentTree = $this->_access->getTalentTree();
        $branch = $talentTree->tree[0];
        $this->assertInstanceOf('\WowApi\Components\Resources\Talents\TalentTree', $talentTree);
        $this->assertInstanceOf('\WowApi\Components\Resources\Talents\Branch', $branch);

        if (count($branch->glyphs)) {
            $this->assertInstanceOf('\WowApi\Components\Resources\Talents\Glyph', $branch->glyphs[0]);
        }
    }

}