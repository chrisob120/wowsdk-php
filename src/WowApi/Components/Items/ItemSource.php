<?php namespace WowApi\Components\Items;

use WowApi\Components\BaseComponent;

/**
 * Represents a single ItemSource
 *
 * @package     Components
 * @author      Chris O'Brien
 * @version     1.0.0
 */
class ItemSource extends BaseComponent {

    /**
     * @var int $sourceId
     */
    public $sourceId;

    /**
     * @var string $sourceType
     */
    public $sourceType;

    /**
     * ItemSource constructor - creates the ItemSource object based on the returned service data
     *
     * @param string $jsonData
     * @return ItemSource
     */
    public function __construct($jsonData) {
        return parent::assignValues($this, json_decode($jsonData));
    }

}