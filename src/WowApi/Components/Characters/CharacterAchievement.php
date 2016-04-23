<?php namespace WowApi\Components\Characters;

use WowApi\Components\BaseComponent;
use WowApi\Components\Achievements\Achievement;

/**
 * Represents a single CharacterAchievement
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class CharacterAchievement extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var array $achievements
     */
    public $achievements;

    /**
     * @var string $name;
     */
    public $name;

    /**
     * CharacterAchievement constructor - creates the CharacterAchievement object based on the returned service data
     *
     * @param object $jsonData
     * @return CharacterAchievement
     */
    public function __construct($jsonData) {
        $characterAchievement = parent::assignValues($this, $jsonData);

        // add if statement to account for some CharacterAchievements not having an achievement
        if (isset($characterAchievement->achievements)) $characterAchievement->achievements = $this->getAchievements($characterAchievement->achievements);

        return $characterAchievement;
    }

    /**
     * @param object $achieveArr
     * @return array
     */
    private function getAchievements($achieveArr) {
        $returnArr = [];

        foreach ($achieveArr as $achieveObj) {
            $returnArr[] = new Achievement($achieveObj);
        }

        return $returnArr;

    }

    /**
     * Gets an array of CharacterAchievement items
     *
     * @param object $jsonData
     * @return array
     */
    public static function getCharacterAchievements($jsonData) {
        $returnArr = [];
        $characterAchievements = $jsonData->achievements;

        foreach ($characterAchievements as $achievement) {
            $returnArr[] = new CharacterAchievement($achievement);
        }

        return $returnArr;
    }

}