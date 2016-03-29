<?php namespace WowApi\Components\Guilds;

use WowApi\Components\BaseComponent;
use WowApi\Components\Achievements\Achievement;
use WowApi\Components\Items\Item;
use WowApi\Util\Helper;

/**
 * Represents a single GuildReward
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class GuildReward extends BaseComponent {

    /**
     * @var int $minGuildLevel
     */
    public $minGuildLevel;

    /**
     * @var int $minGuildRepLevel
     */
    public $minGuildRepLevel;

    /**
     * @var Achievement $achievement
     */
    public $achievement;

    /**
     * @var Item $item
     */
    public $item;

    /**
     *  GuildReward constructor - creates the GuildReward object based on the returned service data
     *
     * @param object $jsonData
     * @return GuildReward
     */
    public function __construct($jsonData) {
        $guildReward = parent::assignValues($this, json_decode($jsonData));

        // add if statement to account for some GuildRewards not having an achievement
        if (isset($guildReward->achievement)) $guildReward->achievement = $this->getAchievement($guildReward->achievement);
        $guildReward->item = $this->getItem($guildReward->item);

        return $guildReward;
    }

    /**
     * @param object $achieveObj
     * @return Achievement
     */
    private function getAchievement($achieveObj) {
        return new Achievement(json_encode($achieveObj));
    }

    /**
     * @param object $itemObj
     * @return Item
     */
    private function getItem($itemObj) {
        return new Item(json_encode($itemObj));
    }

    /**
     * Gets an array of GuildReward items
     *
     * @param string $jsonData
     * @return array
     */
    public static function getGuildRewards($jsonData) {
        $returnArr = [];
        $guildRewards = json_decode($jsonData)->rewards;

        foreach ($guildRewards as $reward) {
            $returnArr[] = new GuildReward(json_encode($reward));
        }

        return $returnArr;
    }

}