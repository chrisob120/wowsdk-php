<?php namespace WowApi\Components\Bosses;

use WowApi\Components\BaseComponent;

/**
 * Represents a single NPC
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class NPC extends BaseComponent {

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
     * NPC constructor - creates the NPC object based on the returned service data
     *
     * @param string $jsonData
     * @return NPC
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}