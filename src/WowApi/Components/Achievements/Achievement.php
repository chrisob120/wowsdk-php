<?php namespace WowApi\Components\Achievements;

use WowApi\Components\BaseComponent;
use WowApi\Components\Items\Item;

/**
 * Represents a single Achievement
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Achievement extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $title
     */
    public $title;

    /**
     * @var int $points
     */
    public $points;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var string $reward
     */
    public $reward;

    /**
     * @var array $rewardItems
     */
    public $rewardItems;

    /**
     * @var string $icon
     */
    public $icon;

    /**
     * @var array $criteria
     */
    public $criteria;

    /**
     * @var bool $accountWide
     */
    public $accountWide;

    /**
     * @var int $factionId
     */
    public $factionId;

    /**
     * Achievement constructor - creates the Achievement object based on the returned service data
     *
     * @param object $jsonData
     * @return Achievement
     */
    public function __construct($jsonData) {
        $achievement = parent::assignValues($this, $jsonData);
        $achievement->rewardItems = $this->getAchievementItems($achievement->rewardItems);
        if (isset($achievement->criteria)) $achievement->criteria = $this->getAchievementCriteria($achievement->criteria);

        return $achievement;
    }

    /**
     * Get array of Items
     *
     * @param array $itemArr
     * @return array
     */
    private function getAchievementItems($itemArr = []) {
        $returnArr = [];

        foreach ($itemArr as $itemObj) {
            $returnArr[] = new Item($itemObj);
        }

        return $returnArr;
    }

    /**
     * Get array of criteria (Criterion)
     *
     * @param array $itemArr
     * @return array
     */
    private function getAchievementCriteria($itemArr = []) {
        $returnArr = [];

        foreach ($itemArr as $itemObj) {
            $returnArr[] = new AchievementCriterion($itemObj);
        }

        return $returnArr;
    }

}