<?php namespace WowApi\Components\Achievements;

use WowApi\Components\BaseComponent;

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
     * @param string $jsonData
     * @return Achievement
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}