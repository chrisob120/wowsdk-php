<?php namespace WowApi\Components\Guilds;

use WowApi\Components\BaseComponent;
use WowApi\Components\Achievements\Achievement;

/**
 * Represents a single GuildAchievement
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class GuildAchievement extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var array $achievements
     */
    public $achievements;

    /**
     * @var string $name
     */
    public $name;

    /**
     *  GuildReward constructor - creates the GuildReward object based on the returned service data
     *
     * @param object $jsonData
     * @return GuildAchievement
     */
    public function __construct($jsonData) {
        $guildAchievement = parent::assignValues($this, $jsonData);

        // add if statement to account for some GuildAchievements not having an achievement
        if (isset($guildAchievement->achievements)) $guildAchievement->achievements = $this->getAchievements($guildAchievement->achievements);

        return $guildAchievement;
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
     * Gets an array of GuildAchievement items
     *
     * @param string $jsonData
     * @return array
     */
    public static function getGuildAchievements($jsonData) {
        $returnArr = [];
        $guildAchievements = $jsonData->achievements;

        foreach ($guildAchievements as $achievement) {
            $returnArr[] = new GuildAchievement($achievement);
        }

        return $returnArr;
    }

}