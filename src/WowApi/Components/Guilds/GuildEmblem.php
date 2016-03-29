<?php namespace WowApi\Components\Guilds;

use WowApi\Components\BaseComponent;

/**
 * Represents a single GuildEmblem
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class GuildEmblem extends BaseComponent {

    /**
     * @var int $icon
     */
    public $icon;

    /**
     * @var string $iconColor
     */
    public $iconColor;

    /**
     * @var int $border
     */
    public $border;

    /**
     * @var string $borderColor
     */
    public $borderColor;

    /**
     * @var string $backgroundColor
     */
    public $backgroundColor;

    /**
     *  GuildEmblem constructor - creates the GuildEmblem object based on the returned service data
     *
     * @param object $jsonData
     * @return GuildEmblem
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}