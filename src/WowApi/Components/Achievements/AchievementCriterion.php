<?php namespace WowApi\Components\Achievements;

use WowApi\Components\BaseComponent;

/**
 * Represents a single AchievementCriterion
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class AchievementCriterion extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var int $orderIndex
     */
    public $orderIndex;

    /**
     * @var int $max
     */
    public $max;

    /**
     * AchievementCriterion constructor - creates the AchievementCriterion object based on the returned service data
     *
     * @param object $jsonData
     * @return AchievementCriterion
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, $jsonData);
    }

}