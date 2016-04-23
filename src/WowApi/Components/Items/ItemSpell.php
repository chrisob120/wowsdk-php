<?php namespace WowApi\Components\Items;

use WowApi\Components\BaseComponent;
use WowApi\Components\Spells\Spell;

/**
 * Represents a single ItemSpell
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemSpell extends BaseComponent {

    /**
     * @var int $spellId
     */
    public $spellId;

    /**
     * @var Spell $spell
     */
    public $spell;

    /**
     * @var int $nCharges
     */
    public $nCharges;

    /**
     * @var bool $consumable
     */
    public $consumable;

    /**
     * @var int $categoryId
     */
    public $categoryId;

    /**
     * @var string $trigger
     */
    public $trigger;

    /**
     * ItemSpell constructor - creates the ItemSpell object based on the returned service data
     *
     * @param object $jsonData
     * @return ItemSpell
     */
    public function __construct($jsonData) {
        $itemSpellObj = parent::assignValues($this, $jsonData);
        $itemSpellObj->spell = $this->getSpell($itemSpellObj->spell);

        return $itemSpellObj;
    }

    /**
     * @param object $spellObj
     * @return Spell
     */
    private function getSpell($spellObj) {
        return new Spell($spellObj);
    }

}