<?php namespace WowApi\Components\Leaderboard;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Row
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Row extends BaseComponent {

    /**
     * @var int $ranking
     */
    public $ranking;

    /**
     * @var int $rating
     */
    public $rating;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var int $realmId
     */
    public $realmId;

    /**
     * @var string $realmName
     */
    public $realmName;

    /**
     * @var string $realmSlug
     */
    public $realmSlug;

    /**
     * @var int $raceId
     */
    public $raceId;

    /**
     * @var int $classId
     */
    public $classId;

    /**
     * @var int $specId
     */
    public $specId;

    /**
     * @var int $factionId
     */
    public $factionId;

    /**
     * @var int $genderId
     */
    public $genderId;

    /**
     * @var int $seasonWins
     */
    public $seasonWins;

    /**
     * @var int $seasonLosses
     */
    public $seasonLosses;

    /**
     * @var int $weeklyWins
     */
    public $weeklyWins;

    /**
     * @var int $weeklyLosses
     */
    public $weeklyLosses;

    /**
     * Row constructor - creates the Row object based on the returned service data
     *
     * @param string $jsonData
     * @return Row
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}