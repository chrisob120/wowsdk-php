<?php namespace WowApi\Components\Characters;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Character
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class CharacterClass extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var int $mask
     */
    public $mask;

    /**
     * @var string $powerType
     */
    public $powerType;

    /**
     * @var string $name
     */
    public $name;

    /**
     * CharacterClass constructor - creates the CharacterClass object based on the returned service data
     *
     * @param string $jsonData
     * @return CharacterClass
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

    /**
     * Gets an array of CharacterClass items
     *
     * @param string $jsonData
     * @return array
     */
    public static function getCharacterClasses($jsonData) {
        $returnArr = [];
        $characterClasses = json_decode($jsonData)->classes;

        foreach ($characterClasses as $class) {
            $returnArr[] = new CharacterClass(json_encode($class));
        }

        return $returnArr;
    }

}