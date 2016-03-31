<?php namespace WowApi\Components\Pets;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Pet
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Pet extends BaseComponent {

    /**
     * @var bool $canBattle
     */
    public $canBattle;

    /**
     * @var int $creatureId
     */
    public $creatureId;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $family
     */
    public $family;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var int $qualityId
     */
    public $qualityId;

    /**
     * @var PetSpeciesStats $stats
     */
    public $stats;

    /**
     * @var array $strongAgainst
     */
    public $strongAgainst;

    /**
     * @var int $typeId
     */
    public $typeId;

    /**
     * @var array $weakAgainst
     */
    public $weakAgainst;
    
    /**
     * Boss constructor - creates the Boss object based on the returned service data
     *
     * @param string $jsonData
     * @return Pet
     */
    public function __construct($jsonData) {
        $petObj = parent::assignValues($this, json_decode($jsonData));
        $petObj->stats = $this->getPetStats($petObj->stats);

        return $petObj;
    }

    /**
     * @param object $petStatsObj
     * @return PetSpeciesStats
     */
    private function getPetStats($petStatsObj) {
        return new PetSpeciesStats(json_encode($petStatsObj));
    }

    /**
     * Gets an array of Pet items
     *
     * @param string $jsonData
     * @return array
     */
    public static function getPets($jsonData) {
        $returnArr = [];
        $pets = json_decode($jsonData)->pets;

        foreach ($pets as $pet) {
            $returnArr[] = new Pet(json_encode($pet));
        }

        return $returnArr;
    }

}