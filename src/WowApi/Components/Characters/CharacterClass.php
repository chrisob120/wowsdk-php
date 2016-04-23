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
     * @param object $jsonData
     * @return CharacterClass
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

    /**
     * Gets an array of CharacterClass items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getCharacterClasses($jsonData) {
        $returnArr = [];
        $characterClasses = $jsonData->classes;

        foreach ($characterClasses as $class) {
            $returnArr[] = new CharacterClass($class);
        }

        return $returnArr;
    }

}