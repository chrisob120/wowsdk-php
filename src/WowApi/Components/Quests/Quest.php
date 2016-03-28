<?php namespace WowApi\Components\Quests;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Quest
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Quest extends BaseComponent {

    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $title
     */
    public $title;

    /**
     * @var int $reqLevel
     */
    public $reqLevel;

    /**
     * @var int $suggestedPartyMembers
     */
    public $suggestedPartyMembers;

    /**
     * @var string $category
     */
    public $category;

    /**
     * @var int $level
     */
    public $level;

    /**
     * Quest constructor - creates the Quest object based on the returned service data
     *
     * @param string $jsonData
     * @return Quest
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}