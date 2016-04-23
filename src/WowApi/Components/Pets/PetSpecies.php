<?php namespace WowApi\Components\Pets;

use WowApi\Components\BaseComponent;

/**
 * Represents a single PetSpecies
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class PetSpecies extends BaseComponent {

    /**
     * @var int $speciesId
     */
    public $speciesId;

    /**
     * @var int $petTypeId
     */
    public $petTypeId;

    /**
     * @var int $creatureId
     */
    public $creatureId;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var bool $canBattle
     */
    public $canBattle;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var string $source
     */
    public $source;

    /**
     * @var array $abilities
     */
    public $abilities;
    
    /**
     * PetSpecies constructor - creates the PetSpecies object based on the returned service data
     *
     * @param object $jsonData
     * @return PetSpecies
     */
    public function __construct($jsonData) {
        $speciesObj = parent::assignValues($this, $jsonData);
        if (count($speciesObj->abilities)) $speciesObj->abilities = $this->getAbilities($speciesObj->abilities);

        return $speciesObj;
    }

    /**
     * Get the an array of PetAbility objects
     *
     * @param array $abilityArr
     * @return array
     */
    private function getAbilities($abilityArr = []) {
        $returnArr = [];

        foreach ($abilityArr as $ability) {
            $returnArr[] = new PetAbility($ability);
        }

        return $returnArr;
    }

}