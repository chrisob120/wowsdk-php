<?php namespace WowApi\Components\Resources\Talents;

use WowApi\Components\BaseComponent;
use WowApi\Components\Spells\Spell;

/**
 * Represents the Talent
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Talent extends BaseComponent {

    /**
     * @var int $tier
     */
    public $tier;

    /**
     * @var int $column
     */
    public $column;

    /**
     * @var Spell $spell
     */
    public $spell;

    /**
     * @var Spec $spec
     */
    public $spec;

    /**
     * Talent constructor - creates the Talent object based on the returned service data
     *
     * @param object $jsonData
     * @return Talent
     */
    public function __construct($jsonData) {
        $talent = parent::assignValues($this, json_decode($jsonData));
        $talent->spell = $this->getSpell($talent->spell);
        if (isset($talent->spec)) $talent->spec = $this->getSpec($talent->spec);

        return $talent;
    }

    /**
     * @param object $spellObj
     * @return Spec
     */
    private function getSpell($spellObj) {
        return new Spell(json_encode($spellObj));
    }

    /**
     * @param object $specObj
     * @return Spec
     */
    private function getSpec($specObj) {
        return new Spec(json_encode($specObj));
    }

}