<?php namespace WowApi\Components\Pets;

use WowApi\Components\BaseComponent;

/**
 * Represents a single PetSpeciesStats
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class PetSpeciesStats extends BaseComponent {

    /**
     * @var int $speciesId
     */
    public $speciesId;

    /**
     * @var int $breedId
     */
    public $breedId;

    /**
     * @var int $petQualityId
     */
    public $petQualityId;

    /**
     * @var int $level
     */
    public $level;

    /**
     * @var int $health
     */
    public $health;

    /**
     * @var int $power
     */
    public $power;

    /**
     * @var int $speed
     */
    public $speed;
    
    /**
     * PetSpeciesStats constructor - creates the PetSpeciesStats object based on the returned service data
     *
     * @param object $jsonData
     * @return PetSpeciesStats
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

}