<?php namespace WowApi\Components\Guilds;

use WowApi\Components\BaseComponent;

/**
 * Represents a single Guild
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class Guild extends BaseComponent {

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
     * @var int $level
     */
    public $level;

    /**
     * @var int $achievementPoints
     */
    public $achievementPoints;

    /**
     * @var object $emblem
     */
    public $emblem;

    /**
     * @var array $members
     */
    public $members;

    /**
     * @var object $achievements
     */
    public $achievements;

    /**
     * @var array $news
     */
    public $news;

    /**
     * @var array $challenge
     */
    public $challenge;

    /**
     *  Guild constructor - creates the Guild object based on the returned service data
     *
     * @param object $jsonData
     * @return Guild
     */
    public function __construct($jsonData) {
        $guild = parent::assignValues($this, $jsonData, null, $default = 'remove');
        $guild->emblem = $this->getEmblem($guild->emblem);

        return $guild;
    }

    /**
     * @param object $emblem
     * @return GuildEmblem
     */
    private function getEmblem($emblem) {
        return new GuildEmblem($emblem);
    }

}