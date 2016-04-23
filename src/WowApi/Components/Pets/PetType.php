<?php namespace WowApi\Components\Pets;

use WowApi\Components\BaseComponent;

/**
 * Represents a single PetType
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class PetType extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $key
     */
    public $key;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var int $typeAbilityId
     */
    public $typeAbilityId;

    /**
     * @var int $strongAgainstId
     */
    public $strongAgainstId;

    /**
     * @var int $weakAgainstId
     */
    public $weakAgainstId;
    
    /**
     * PetAbility constructor - creates the PetAbility object based on the returned service data
     *
     * @param object $jsonData
     * @return PetType
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

    /**
     * Gets an array of PetType items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getPetTypes($jsonData) {
        $returnArr = [];
        $petTypes = $jsonData->petTypes;

        foreach ($petTypes as $petType) {
            $returnArr[] = new PetType($petType);
        }

        return $returnArr;
    }

}