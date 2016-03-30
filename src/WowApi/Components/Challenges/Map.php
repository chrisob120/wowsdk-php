<?php namespace WowApi\Components\Challenges;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Map
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Map extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $slug
     */
    public $slug;

    /**
     * @var bool $hasChallengeMode
     */
    public $hasChallengeMode;

    /**
     * @var object $bronzeCriteria
     */
    public $bronzeCriteria;

    /**
     * @var object $silverCriteria
     */
    public $silverCriteria;

    /**
     * @var object $goldCriteria
     */
    public $goldCriteria;

    /**
     * Map constructor - creates the Map object based on the returned service data
     *
     * @param object $jsonData
     * @return Map
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}