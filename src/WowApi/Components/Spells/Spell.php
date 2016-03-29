<?php namespace WowApi\Components\Spells;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Spell
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Spell extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var string $range
     */
    public $range;

    /**
     * @var string $powerCost
     */
    public $powerCost;

    /**
     * @var string $castTime
     */
    public $castTime;

    /**
     * @var string $cooldown
     */
    public $cooldown;

    /**
     * Spell constructor - creates the Spell object based on the returned service data
     *
     * @param string $jsonData
     * @return Spell
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData), null, $default = 'remove');
    }

}