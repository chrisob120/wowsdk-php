<?php namespace WowApi\Components\Characters;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Character
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class CharacterRace extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var int $mask
     */
    public $mask;

    /**
     * @var string $side
     */
    public $side;

    /**
     * @var string $name
     */
    public $name;

    /**
     * CharacterRace constructor - creates the CharacterRace object based on the returned service data
     *
     * @param object $jsonData
     * @return CharacterRace
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

    /**
     * Gets an array of CharacterRace items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getCharacterRaces($jsonData) {
        $returnArr = [];
        $characterRaces = $jsonData->races;

        foreach ($characterRaces as $race) {
            $returnArr[] = new CharacterRace($race);
        }

        return $returnArr;
    }

}