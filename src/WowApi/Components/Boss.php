<?php namespace WowApi\Components;

/**
 * Represents a single Boss
 *
 * @package     Components
 * @author      Chris O'Brien <chris@diobie.com>
 * @version     1.0.0
 */
class Boss extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $urlSlug
     */
    public $urlSlug;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var bool $availableInNormalMode
     */
    public $availableInNormalMode;

    /**
     * @var bool $availableInHeroicMode
     */
    public $availableInHeroicMode;

    /**
     * @var int $health
     */
    public $health;

    /**
     * @var int $heroicHealth
     */
    public $heroicHealth;

    /**
     * @var int $level
     */
    public $level;

    /**
     * @var int $heroicLevel
     */
    public $heroicLevel;

    /**
     * @var int $journalId
     */
    public $journalId;

    /**
     * @var array $npcs
     */
    public $npcs;

    /**
     * Boss constructor - creates the Boss object based on the returned service data
     *
     * @param string $jsonData
     * @return Boss
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}