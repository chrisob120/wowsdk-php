<?php namespace WowApi\Components\Pets;

use WowApi\Components\BaseComponent;

/**
 * Represents a single PetAbility
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class PetAbility extends BaseComponent {

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
     * @var int $cooldown
     */
    public $cooldown;

    /**
     * @var int $petTypeId
     */
    public $petTypeId;

    /**
     * @var bool $isPassive
     */
    public $isPassive;

    /**
     * @var bool $hideHints
     */
    public $hideHints;
    
    /**
     * PetAbility constructor - creates the PetAbility object based on the returned service data
     *
     * @param string $jsonData
     * @return PetAbility
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}