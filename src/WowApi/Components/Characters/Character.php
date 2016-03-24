<?php namespace WowApi\Components\Characters;

use WowApi\Components\BaseComponent;
use WowApi\Util\Utilities;

/**
 * Represents a single Character
 *
 * @package     Components
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class Character extends BaseComponent {

    /**
     * @var string $lastModified
     */
    public $lastModified;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $realm
     */
    public $realm;

    /**
     * @var string $battlegroup
     */
    public $battlegroup;

    /**
     * @var int $class
     */
    public $class;

    /**
     * @var int $race
     */
    public $race;

    /**
     * @var int $gender
     */
    public $gender;

    /**
     * @var int $level
     */
    public $level;

    /**
     * @var int $achievementPoints
     */
    public $achievementPoints;

    /**
     * @var string $thumbnail
     */
    public $thumbnail;

    /**
     * @var string $calcClass
     */
    public $calcClass;

    /**
     * @var int $faction
     */
    public $faction;

    /**
     * @var string $achievements
     */
    public $achievements;

    /**
     * @var object $appearance
     */
    public $appearance;

    /**
     * @var object $feed
     */
    public $feed;

    /**
     * @var array $hunterPets
     */
    public $hunterPets;

    /**
     * @var object $items
     */
    public $items;

    /**
     * @var object $mounts
     */
    public $mounts;

    /**
     * @var object $pets
     */
    public $pets;

    /**
     * @var array $petSlots
     */
    public $petSlots;

    /**
     * @var object $progression
     */
    public $progression;

    /**
     * @var object $pvp
     */
    public $pvp;

    /**
     * @var array $quests
     */
    public $quests;

    /**
     * @var array $reputation
     */
    public $reputation;

    /**
     * @var object $statistics
     */
    public $statistics;

    /**
     * @var object $stats
     */
    public $stats;

    /**
     * @var array $talents
     */
    public $talents;

    /**
     * @var array $titles
     */
    public $titles;

    /**
     * @var object $audit
     */
    public $audit;



    /**
     * @var
     */
    public $totalHonorableKills;

    public function __construct($data) {
        return parent::assignValues($this, json_decode($data));
    }

}