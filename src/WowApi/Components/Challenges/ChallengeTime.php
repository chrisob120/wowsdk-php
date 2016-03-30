<?php namespace WowApi\Components\Challenges;

use WowApi\Components\BaseComponent;

/**
 * Represents a single ChallengeTime
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ChallengeTime extends BaseComponent {

    /**
     * @var int $time
     */
    public $time;

    /**
     * @var int $hours
     */
    public $hours;

    /**
     * @var int $minutes
     */
    public $minutes;

    /**
     * @var int $seconds
     */
    public $seconds;

    /**
     * @var int $milliseconds
     */
    public $milliseconds;

    /**
     * @var bool $isPositive
     */
    public $isPositive;

    /**
     * ChallengeTime constructor - creates the ChallengeTime object based on the returned service data
     *
     * @param object $jsonData
     * @return ChallengeTime
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}